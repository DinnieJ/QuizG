<template>
  <div class="container">
    <user-nav :user="user" home active-tab="Quizzes" />
    <quizzes-group
      :quizzes="quizzes"
      selectable
      authorize
      @click-delete="clickDeleteQuiz($event)"
    />
    <alert-dialog
      dialog-id="collection-dialog"
      :type="dialog.type"
      :message="dialog.message"
      @dialog-confirm="dialogConfirm($event)"
    />
  </div>
</template>

<script>
import AlertDialog from "~/components/common/AlertDialog";
import UserNav from "~/components/user/UserNav";
import QuizzesGroup from "~/components/quiz/QuizzesGroup";
import { mapGetters } from "vuex";
import ApiBuilder from "~/common/api/builder";
const QuizzesApi = ApiBuilder.build("quizzes");

export default {
  middleware: "authenticated",
  async asyncData({
    isDev,
    route,
    store,
    env,
    params,
    query,
    req,
    res,
    redirect,
    error
  }) {
    let user = store.getters["user/currentUser"];
    let authenToken = store.getters["user/authenToken"];
    try {
      let response = await QuizzesApi.getByUser(authenToken, user.id);
      if (response.status == 200) {
        /**
         * @type {Array}
         */
        let quizzesSource = response.data.quizzes;

        var temp = 0;

        let quizzesList = quizzesSource.map(quiz => {
          temp = quiz.correct_answer_id;
          quiz.answers.forEach(answer => {
            if (answer.id == temp) {
              answer.correct = true;
            } else {
              answer.correct = false;
            }
          });

          return quiz;
        });

        store.commit("quiz/SET_QUIZZES", quizzesList);
        store.commit("user/ACTIVE_PAGE", "home");
      }
    } catch (e) {
      console.log("getAllCollections error", e);
    }
    return {
      user
    };
  },
  components: {
    UserNav,
    QuizzesGroup,
    AlertDialog
  },
  computed: {
    ...mapGetters({
      quizzes: "quiz/quizzes",
      authenToken: "user/authenToken"
    })
  },
  data() {
    return {
      dialog: {
        type: "edit",
        message: "Do you want to edit this Collection",
        target: ""
      },
      deleteQuizPayload: {}
    };
  },
  methods: {
    showDialog(type, message, target = "") {
      this.dialog = {
        type: type,
        message: message,
        target: target
      };
      this.$bvModal.show("collection-dialog");
    },
    async deleteQuizHandle() {
      let payload = this.deleteQuizPayload;
      try {
        let response = await QuizzesApi.delete(this.authenToken, payload.id);
        if (response.status === 200) {
          this.showDialog("successful", "Delete quiz Successfully");
        }
      } catch (e) {
        this.showDialog("error", e);
      }
    },
    clickDeleteQuiz(payload) {
      this.deleteQuizPayload = payload;
      this.showDialog(
        "delete",
        "Do you want to quizzes from this Collection ?"
      );
    },
    async dialogConfirm(confirm) {
      if (confirm) {
        switch (this.dialog.type) {
          case "delete":
            await this.deleteQuizHandle();
            return;
        }
      } else {
        switch (this.dialog.type) {
          case "successful":
            this.$router.go(0);
            return;
        }
      }
    }
  },
  created() {}
};
</script>
