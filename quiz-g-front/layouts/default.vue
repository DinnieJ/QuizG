<template>
  <div>
    <div id="header">
       this is header
       <b-button pill variant="primary" @click="clickLogout()">Logout</b-button>
    </div>
   
    <nuxt />
  </div>
</template>

<script>
export default {
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
}
</script>
