<template>
<nav class="navbar navbar-expand-lg navbar-light my-4">
  <a class="navbar-brand" href="#">{{ user.name }}</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li :class="`nav-item ${(active === 'collections' ? 'active' : '')}`">
        <a class="nav-link" @click="clickTab('collections')">
            Collections
        </a>
      </li>
      <li :class="`nav-item ${(active === 'quizzes' ? 'active' : '')}`">
        <a class="nav-link"  @click="clickTab('quizzes')">
            Quizzes
        </a>
      </li>
      <li :class="`nav-item ${(active === 'history' ? 'active' : '')}`">
        <a class="nav-link" @click="clickTab('history')">
            History
        </a>
      </li>
    </ul>
  </div>
</nav>
</template>

<script>
export default {
    props: {
        active: String,
        user: Object
    }, 
    data() {
        return {
        }
    },
    methods: {
        clickTab(tab) {
            this.$emit('click-tab', tab)
        }
    }
}
</script>