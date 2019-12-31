<template>
<div class="container">
    <user-nav 
        :user="user"
        add-quiz
    />
    <collections-group 
        :collections="collections"
        add-quiz
        @click-add-quiz="clickAddQuiz($event)"
    />
    <quizzes-group :quizzes="quizzes"/>
</div>
</template>

<script>
import CollectionsGroup from '~/components/collection/CollectionsGroup'
import QuizzesGroup from '~/components/quiz/QuizzesGroup'
import UserNav from '~/components/user/UserNav'
import { mapGetters } from 'vuex'
import ApiBuilder from '~/common/api/builder'
const CollectionsApi = ApiBuilder.build('collections') 

export default {
    middleware: 'authenticated',
    async asyncData({isDev, route, store, env, params, query, req, res, redirect, error}) {
        let user = store.getters['user/currentUser']
        let authenToken = store.getters['user/authenToken']
        try{
            let response = await CollectionsApi.getByUser(authenToken, user.id)
            if(response.status == 200) {
                let collectionsList = response.data.collections
                store.commit('collection/SET_COLLECTIONS', collectionsList)
                store.commit('user/ACTIVE_PAGE', 'home')
            }
            
        } catch(e) {
            console.log('getAllCollections error', e)
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
        ...mapGetters({
            collections: 'collection/collections',
            quizzes: 'quiz/selectedQuizzes',
            authenToken: 'user/authenToken'
        })
    },
    data() {
        return {
        }
    },
    methods: {
        async clickAddQuiz(payload) {
            let collectionId = payload.id
            let quizzesPayload = this.quizzes.map(item => {
                return item.id
            })

            let apiPayload = {
                quizzes_id: quizzesPayload,
            }

            try {
                let response = await CollectionsApi.addQuizzes(this.authenToken, collectionId, apiPayload)
                if(response.status === 200) {
                    this.$router.go(-1)
                }
            } catch (error) {
                
            }
        }
    },
    created() {

    }
}
</script>