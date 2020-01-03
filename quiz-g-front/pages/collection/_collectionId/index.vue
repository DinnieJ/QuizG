<template>
  <div class="container">
    <collection-nav
      :collection="collection"
      :authorize="authorize"
      @click-edit="clickEdit($event)"
      @click-delete="clickDelete($event)"
      @click-remove-quiz="clickRemoveQuiz($event)"
    />
    <quizzes-group :quizzes="quizzes" selectable :authorize="authorize" />
  </div>
</template>

<script>
import QuizzesGroup from "~/components/quiz/QuizzesGroup";
import CollectionNav from "~/components/collection/CollectionNav";
import { mapGetters } from "vuex";
import ApiBuilder from "~/common/api/builder";
const CollectionsApi = ApiBuilder.build("collections");

export default {
  validate({ params }) {
    // Must be a number
    return /\d+$/.test(params.id);
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
        let quizzesSource = collection.quizzes.data;
        authorize = collection.authored;

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
    CollectionNav
  },
  computed: {
    ...mapGetters({
      quizzes: "quiz/quizzes",
      authenToken: "user/authenToken",
      selectedQuizzes: "quiz/selectedQuizzes"
    })
  },
  data() {
    return {};
  },
  methods: {
    async clickEdit(payload) {
      try {
        let response = await CollectionsApi.update(
          this.authenToken,
          payload.id,
          payload
        );
        console.log("edit collection", response);
      } catch (e) {
        console.log("edit collection error", e);
      }
    },
    async clickDelete(payload) {
      try {
        let response = await CollectionsApi.delete(
          this.authenToken,
          payload.id
        );
        console.log("delete collection", response);
        if (response.status === 200) {
          this.$router.push({
            path: "/home/collections"
          });
        }
      } catch (e) {
        console.log("delete collection error", e);
      }
    },
    async clickRemoveQuiz(payload) {
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
          this.$router.go(-1);
        }
      } catch (error) {}
    }
  },
  created() {}
};
</script>
