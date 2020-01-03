<template>
  <div>
    <quiz-form @click-create="clickCreate($event)" />
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
import QuizForm from "~/components/quiz/QuizForm";
import { mapGetters } from "vuex";
import ApiBuilder from "~/common/api/builder";
const QuizzesApi = ApiBuilder.build("quizzes");

export default {
  middleware: "authenticated",
  components: {
    QuizForm,
    AlertDialog
  },
  data() {
    return {
      createPayload: {},
      dialog: {
        type: "edit",
        message: "Do you want to edit this Collection",
        target: ""
      }
    };
  },
  computed: {
    ...mapGetters({
      authenToken: "user/authenToken"
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
    async createHandle() {
      let payload = this.createPayload;
      try {
        let response = await QuizzesApi.create(this.authenToken, payload);
        if (response.status === 200) {
          this.showDialog("successful", "Create new Quiz successfully");
        }
      } catch (error) {
        this.showDialog("error", e);
      }
    },
    clickCreate(payload) {
      this.createPayload = payload;
      this.showDialog("create", "Do you want to create new Quiz ?");
    },
    async dialogConfirm(confirm) {
      if (confirm) {
        switch (this.dialog.type) {
          case "create":
            await this.createHandle();
            return;
        }
      } else {
        switch (this.dialog.type) {
          case "successful":
            this.$router.go(-1);
            return;
        }
      }
    }
  }
};
</script>
