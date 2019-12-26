<template>
<div class="container">
    <user-nav 
        :user="user"
        add-quiz
    />
    <collections-group 
        :collections="collections"
        add-quiz
    />
    <quizzes-group :quizzes="quizzes"/>
</div>
</template>

<script>
import CollectionApi from '~/common/api/collection'
import CollectionsGroup from '~/components/collection/CollectionsGroup'
import QuizzesGroup from '~/components/quiz/QuizzesGroup'
import UserNav from '~/components/user/UserNav'

export default {
    // middleware: 'authenticated',
    async asyncData({isDev, route, store, env, params, query, req, res, redirect, error}) {
        let user = store.getters['user/currentUser']
        try{
            let response = await CollectionApi.getCollectionsByUser(user.id)
            if(response.status == 200) {
                let collectionsList = response.data.collections
                store.commit('collection/SET_COLLECTIONS', collectionsList)
                store.commit('user/ACTIVE_PAGE', 'home')
            }
            
        } catch(e) {
            console.log('getAllCollections error', e)
            redirect('/500')
        }
        return {
            user
        }
    },
    components: {
        CollectionsGroup,
        QuizzesGroup,
        UserNav
    },
    computed: {
        collections() {
            let collections = this.$store.getters['collection/collections']
            return collections;
        },
        quizzes() {
            let quizzes = this.$store.getters['quiz/selectedQuizzes']
            return quizzes
        }
    },
    data() {
        return {
        }
    },
    created() {

    }
}
</script>