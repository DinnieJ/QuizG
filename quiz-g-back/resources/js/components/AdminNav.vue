<template>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">QuizG</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li :class="`nav-item ${(active === 'users' ? 'active' : '')}`">
        <a class="nav-link" href="/users">
            Users
        </a>
      </li>
      <li :class="`nav-item ${(active === 'collections' ? 'active' : '')}`">
        <a class="nav-link" href="/collections">
            Collections
        </a>
      </li>
      <li :class="`nav-item ${(active === 'quizzes' ? 'active' : '')}`">
        <a class="nav-link" href="/quizzes">
            Quizzes
        </a>
      </li>
      <li :class="`nav-item ${(active === 'history' ? 'active' : '')}`">
        <a class="nav-link" href="/history">
            History
        </a>
      </li>
      <li :class="`nav-item ${(active === 'logout' ? 'active' : '')}`">
        <a class="nav-link" href="#" @click="logout()">
            Logout
        </a>
      </li>
    </ul>
    <form id="logout-form" action="/logout" method="POST" style="display: none;">
      <input type="hidden" name="_token" :value="csrf">
    </form>
  </div>
</nav>
</template>

<script>
export default {
    data() {
        return {
            active: 'users',
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    },
    methods:{
      logout(){
        console.log('logged out');
        document.getElementById('logout-form').submit()
      }
    }
}
</script>