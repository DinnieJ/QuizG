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
export default {
  computed: {
    activePage() {
      let page = this.$store.getters['user/activePage']
      return page
    }
  },
  methods: {
    clickLogout() {
      var dispatch = this.$store.dispatch('user/logout')
      if(dispatch) {
        this.$router.push(
          {
            path: '/login'
          }
        )
      }
    }
  },
  created() {

  }
}
</script>
