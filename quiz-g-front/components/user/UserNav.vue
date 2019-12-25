<template>
<ul class="nav nav-pills mb-3 user-nav">
  <li class="nav-item">
    <div class="nav-link font-pacifico user-nav-name">{{ user.name }}</div>
  </li>
  <li class="nav-item">
    <a :class="activeTab == 'collections' ? 'nav-link text-uppercase active' : 'nav-link text-uppercase'" :href="home ? '/home/collections' : ('/creator/' + user.id + '/collections')" >collections</a>
  </li>
  <li class="nav-item">
    <a :class="activeTab == 'quizzes' ? 'nav-link text-uppercase active' : 'nav-link text-uppercase'" :href="home ? '/home/quizzes' : ('/creator/' + user.id + '/quizzes')" >quizzes</a>
  </li>
  <li class="nav-item" v-if="home">
    <a :class="activeTab == 'history' ? 'nav-link text-uppercase active' : 'nav-link text-uppercase'" href="/home/history" >history</a>
  </li>
</ul>
</template>

<script>
export default {
    props:{
        home: {
            type: Boolean,
            default: false
        },
        user: Object,
        activeTab: String
    },
    data() {
        return {
        }
    }
}
</script>