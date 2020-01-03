<template>
  <div>
    <login-form
      v-model="error.status"
      :error-message="error.message"
      @click-login="clickLogin($event)"
    />
  </div>
</template>

<script>
import LoginForm from "~/components/user/LoginForm";
import ApiBuilder from "~/common/api/builder";
const AuthApi = ApiBuilder.build("auth");
const Cookie = process.client ? require("js-cookie") : undefined;

import axios from "axios";

export default {
  layout: "authLayout",
  loading: {
    color: "blue",
    height: "5px"
  },
  components: {
    LoginForm
  },
  data() {
    return {
      error: {
        status: false,
        message: ""
      }
    };
  },
  methods: {
    async clickLogin(payload) {
      try {
        let loginResonse = await AuthApi.login(payload);
        let authenToken = loginResonse.data.token;
        this.$store.commit("user/AUTHENTICATE", authenToken);
        Cookie.set("authenToken", authenToken);

        let getUserResponse = await AuthApi.getByUser(authenToken);
        let user = getUserResponse.data.user;
        this.$store.commit("user/SET_CURRENT_USER", user);
        Cookie.set("currentUser", user);

        console.log("finish clickLogin", user, authenToken);
        this.$router.push({
          path: "/home/collections"
        });
      } catch (e) {
        this.error.status = true;
        this.error.message = e.data.error;
      }
    }
  },
  created() {}
};
</script>
