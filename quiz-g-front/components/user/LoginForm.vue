<template>
  <div class="form form-user">
    <h2 class="text-center form-header">Login QuizG</h2>
    <div>
      <div class="form-group">
        <label for="inputEmail" class="text-uppercase">Email</label>
        <input
          type="email"
          name="email"
          class="form-control"
          placeholder=""
          required
          v-model="email"
        />
        <error-alert v-model="errorStatus" :message="errorMessage" />
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1" class="text-uppercase">Password</label>
        <input
          type="password"
          name="password"
          class="form-control"
          placeholder=""
          required
          v-model="password"
        />
      </div>
      <div>
        <button class="btn text-uppercase btn-login" @click="clickLogin()">
          Login
        </button>
        <a class="float-right" href="/register">Signup</a>
      </div>
    </div>
  </div>
</template>

<script>
import ErrorAlert from "../common/ErrorAlert";

export default {
  layout: "authLayout",
  components: {
    ErrorAlert
  },
  props: {
    value: {
      type: Boolean,
      default: false
    },
    errorMessage: String
  },
  data() {
    return {
      email: "",
      password: ""
    };
  },
  computed: {
    errorStatus: {
      get() {
        return this.value;
      },
      set(value) {
        this.$emit("input", value);
      }
    }
  },
  methods: {
    clickLogin() {
      let payload = {
        email: this.email,
        password: this.password
      };
      this.$emit("click-login", payload);
    }
  },
  created() {}
};
</script>
