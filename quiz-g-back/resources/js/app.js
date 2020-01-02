/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('admin-nav', require('./components/AdminNav.vue').default);
Vue.component('collections-group', require('./components/collections/CollectionsGroup.vue').default);
Vue.component('collection-show', require('./components/collections/CollectionShow.vue').default);
Vue.component('users-group', require('./components/users/UsersGroup.vue').default);
Vue.component('user-show', require('./components/users/UserShow.vue').default);
Vue.component('quizzes-group', require('./components/quizzes/QuizzesGroup.vue').default);
Vue.component('quiz-show', require('./components/quizzes/QuizShow.vue').default);
Vue.component('histories-group', require('./components/history/HistoriesGroup.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
