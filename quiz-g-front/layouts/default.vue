<template>
<div>
  <div class="d-flex justify-content-between px-5 py-1 mb-4" id="header">
      <div class="row header-left">
        <a class="navbar-brand" href="/home/collections">
          <div class="ml-3 header-title font-pacifico">QuizG</div>
        </a>
        <a class="navbar-brand" href="/home/collections">
          <div :class=" activePage == 'home' ? 'ml-3 mt-1 header-item font-lobster active' : 'ml-3 mt-1 header-item font-lobster'">Home</div>
        </a>
        <a class="navbar-brand" href="/discover/collections">
          <div :class=" activePage == 'discover' ? 'ml-3 mt-1 header-item font-lobster active' : 'ml-3 mt-1 header-item font-lobster'">Discover</div>
        </a>
      </div>
      <div class="row">
        <button class="btn logout-btn text-uppercase" @click="clickLogout()">Logout</button>
      </div>
  </div>
  <nuxt />
</div>
</template>

<script>
import { mapGetters } from 'vuex'
import ApiBuilder from '~/common/api/builder'
const AuthApi = ApiBuilder.build('auth')
const Cookie = process.client ? require('js-cookie') : undefined

export default {
  computed: {
    ...mapGetters({
      activePage: 'user/activePage',
      authenToken: 'user/authenToken'
    })
  },
  methods: {
    async clickLogout() {
      try {
        let response = await AuthApi.logout(this.authenToken)
        if(response.status === 200) {
            this.$store.commit('user/LOGOUT')
            Cookie.remove('authenToken')
            this.$router.push({
                path: '/login'
            })
        }
      } catch(e) {
        console.log('error', e)
      }
    }
  },
  created() {

  }
}
</script>
