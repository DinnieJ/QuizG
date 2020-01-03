<template>
  <div>
    <b-modal
      :id="dialogId"
      :header-bg-variant="colorMap.get(type)"
      footer-bg-variant="light"
      @hide="dialogConfirm(false)"
    >
      <template v-slot:modal-header>
        <div class="text-capitalize w-100 h-100 alert-dialog-header">
          {{ type }}
        </div>
      </template>

      <template v-slot:default>
        <div class="alert-dialog-body">
          {{ message }}
        </div>
      </template>

      <template v-slot:modal-footer>
        <div class="alert-dialog-footer">
          <button
            class="btn btn-outline-info text-capitalize"
            @click="clickConfirm()"
            v-if="
              ['confirm', 'edit', 'delete', 'add', 'create', 'submit'].includes(
                type
              )
            "
          >
            {{ type }}
          </button>
          <button class="btn btn-outline-warning" @click="hideDialog()">
            Cancel
          </button>
        </div>
      </template>
    </b-modal>
  </div>
</template>

<script>
export default {
  props: {
    dialogId: {
      type: String,
      default: "alert-dialog"
    },
    type: {
      type: String,
      default: "confirm"
    },
    message: {
      type: String,
      default: "Alert"
    }
  },
  data() {
    return {
      colorMap: {}
    };
  },
  methods: {
    hideDialog() {
      this.dialogConfirm(false);
      this.$bvModal.hide(this.dialogId);
    },
    dialogConfirm(confirm) {
      // console.log("dialog confirm", confirm);
      this.$emit("dialog-confirm", confirm);
    },
    clickConfirm() {
      this.dialogConfirm(true);
      this.$bvModal.hide(this.dialogId);
    }
  },
  created() {
    let kvArray = [
      ["successful", "success"],
      ["create", "success"],
      ["error", "danger"],
      ["delete", "danger"],
      ["confirm", "info"],
      ["submit", "info"],
      ["edit", "info"]
    ];
    this.colorMap = new Map(kvArray);
  }
};
</script>
