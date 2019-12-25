<template>
<div class="container">
    <user-nav 
        :user="user"
        home
        active-tab="quizzes"
    />
    this is quizzes page
</div>
</template>

<script>

import UserNav from '~/components/user/UserNav'

export default {
    // middleware: 'authenticated',
    async asyncData({isDev, route, store, env, params, query, req, res, redirect, error}) {
        return {

        }
    },
    components: {
        UserNav
    },
    computed: {
    },
    data() {
        return {
            user: {
                id: 1,
                name: "User 1"
            }
        }
    },
    created() {

    }
}
</script>