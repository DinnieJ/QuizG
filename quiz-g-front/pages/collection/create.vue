<template>
  <div class="container">
    <collection-nav create-new @click-create="clickCreate($event)" />
    <alert-dialog
      dialog-id="create-collection-dialog"
      :type="dialog.type"
      :message="dialog.message"
      @dialog-confirm="dialogConfirm($event)"
    />
  </div>
</template>

<script>
import AlertDialog from "~/components/common/AlertDialog";
import CollectionNav from "~/components/collection/CollectionNav";
import { mapGetters } from "vuex";
import ApiBuilder from "~/common/api/builder";
const CollectionsApi = ApiBuilder.build("collections");

export default {
  middleware: "authenticated",
  components: {
    CollectionNav,
    AlertDialog
  },
  data() {
    return {
      dialog: {
        type: "create",
        message: "Do you want to create new Collection"
      },
      createPayload: {}
    };
  },
  computed: {
    ...mapGetters({
      authenToken: "user/authenToken"
    })
  },
  methods: {
    clickCreate(payload) {
      this.dialog = {
        type: "create",
        message: "Do you want to create new Collection"
      };
      this.$bvModal.show("create-collection-dialog");
      this.createPayload = payload
    },
    async createHandle() {
      let authenToken = this.authenToken;
      try {
        let response = await CollectionsApi.create(this.authenToken, this.createPayload);

        if (response.status === 200) {
          this.dialog = {
            type: "successful",
            message: "Create new Collection Successfully"
          };
          this.$bvModal.show("create-collection-dialog");
        }
      } catch (error) {
        console.log("error", error);
        this.dialog = {
          type: "error",
          message: error
        };
        this.$bvModal.show("create-collection-dialog");
      }
    },
    async dialogConfirm(confirm) {
      if(confirm) {
        switch(this.dialog.type) {
          case 'create':
            await this.createHandle()
            return
        }
      } else {
        switch(this.dialog.type) {
          case 'successful':
            this.$router.push({
              path: "/home/collections"
            });
            return
        }
      }
    }
  }
};
</script>
