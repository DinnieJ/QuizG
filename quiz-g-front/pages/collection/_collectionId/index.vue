<template>
  <div class="container">
    <collection-nav
      :collection="collection"
      :authorize="authorize"
      @click-edit="clickEdit($event)"
      @click-delete="clickDelete($event)"
      @click-remove-quiz="clickRemoveQuiz($event)"
    />
    <quizzes-group
      :quizzes="quizzes"
      selectable
      :authorize="authorize"
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
import QuizzesGroup from "~/components/quiz/QuizzesGroup";
import CollectionNav from "~/components/collection/CollectionNav";
import { mapGetters } from "vuex";
import ApiBuilder from "~/common/api/builder";
const CollectionsApi = ApiBuilder.build("collections");
const QuizzesApi = ApiBuilder.build("quizzes");

export default {
  loading: {
    color: "blue",
    height: "5px"
  },
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
    let collectionId = params.collectionId;
    let authenToken = store.getters["user/authenToken"];
    let collection = {};
    let authorize = false;
    try {
      let response = await CollectionsApi.getById(authenToken, collectionId);
      if (response.status == 200) {
        /**
         * @type {Array}
         */

        collection = response.data.collection;
        authorize = collection.authorize;
        let quizzesSource = collection.quizzes.data;

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

        store.commit("collection/SET_CURRENT_COLLECTION", collection);
        store.commit("quiz/SET_QUIZZES", quizzesList);
        if (authorize) {
          store.commit("user/ACTIVE_PAGE", "home");
        } else {
          store.commit("user/ACTIVE_PAGE", "discover");
        }
      }
    } catch (e) {
      console.log("getAllCollections error", e);
    }

    return {
      collection,
      authorize
    };
  },
  components: {
    QuizzesGroup,
    CollectionNav,
    AlertDialog
  },
  data() {
    return {
      dialog: {
        type: "edit",
        message: "Do you want to edit this Collection",
        target: ""
      },
      editCollectionPayload: {},
      deleteCollectionPayload: {},
      removeQuizPayload: {},
      deleteQuizPayload: {}
    };
  },
  computed: {
    ...mapGetters({
      quizzes: "quiz/quizzes",
      authenToken: "user/authenToken",
      selectedQuizzes: "quiz/selectedQuizzes"
    })
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
    async editHandle() {
      let payload = this.editCollectionPayload;
      try {
        let response = await CollectionsApi.update(
          this.authenToken,
          payload.id,
          payload
        );
        if (response.status === 200) {
          this.showDialog(
            "successful",
            "Edit this Collection Successfully",
            "edit-collection"
          );
        }
      } catch (e) {
        this.showDialog("error", e);
      }
    },
    clickEdit(payload) {
      this.showDialog("edit", "Do you want to edit this Collection ?");
      this.editCollectionPayload = payload;
    },
    async deleteHandle() {
      let payload = this.deleteCollectionPayload;
      try {
        let response = await CollectionsApi.delete(
          this.authenToken,
          payload.id
        );
        console.log("delete collection", response);
        if (response.status === 200) {
          this.showDialog(
            "successful",
            "Delete this Collection Successfully",
            "delete-collection"
          );
        }
      } catch (e) {
        this.showDialog("error", e);
      }
    },
    clickDelete(payload) {
      this.showDialog(
        "delete",
        "Do you want to delete this Collection ?",
        "delete-collection"
      );
      this.deleteCollectionPayload = payload;
    },
    async removeQuizHandle() {
      let payload = this.removeQuizPayload;
      let collectionId = payload.id;
      let quizzesPayload = this.selectedQuizzes.map(item => {
        return item.id;
      });

      let apiPayload = {
        quizzes_id: quizzesPayload
      };

      try {
        let response = await CollectionsApi.removeQuizzes(
          this.authenToken,
          collectionId,
          apiPayload
        );
        if (response.status === 200) {
          this.showDialog(
            "successful",
            "Remove quizzes from this Collection Successfully",
            "remove-quiz"
          );
        }
      } catch (e) {
        this.showDialog("error", e);
      }
    },
    clickRemoveQuiz(payload) {
      this.showDialog(
        "confirm",
        "Do you want to quizzes from this Collection ?"
      );
      this.removeQuizPayload = payload;
    },
    async deleteQuizHandle() {
      let payload = this.deleteQuizPayload;
      try {
        let response = await QuizzesApi.delete(this.authenToken, payload.id);
        if (response.status === 200) {
          this.showDialog(
            "successful",
            "Delete quiz Successfully",
            "delete-quiz"
          );
        }
      } catch (e) {
        this.showDialog("error", e);
      }
    },
    clickDeleteQuiz(payload) {
      this.deleteQuizPayload = payload;
      this.showDialog(
        "delete",
        "Do you want to quizzes from this Collection ?",
        "delete-quiz"
      );
    },
    async dialogConfirm(confirm) {
      if (confirm) {
        switch (this.dialog.type) {
          case "edit":
            await this.editHandle();
            return;
          case "delete":
            switch (this.dialog.target) {
              case "delete-collection":
                await this.deleteHandle();
                return;
              case "delete-quiz":
                await this.deleteQuizHandle();
                return;
            }

            return;
          case "confirm":
            await this.removeQuizHandle();
            return;
        }
      } else {
        switch (this.dialog.type) {
          case "successful":
            switch (this.dialog.target) {
              case "delete-collection":
                this.$router.push({
                  path: "/home/collections"
                });
                return;
              case "remove-quiz":
                this.$router.go(0);
                return;
              case "delete-quiz":
                this.$router.go(0);
                return;
            }
            return;
          case "edit":
            this.$router.go(0);
            return;
        }
      }
    }
  },
  created() {}
};
</script>
