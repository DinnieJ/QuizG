<template>
<div>
    <quiz-form 
        :collection-id="collectionId"
        @click-create="clickCreate($event)"
    />
</div>
</template>

<script>
import QuizForm from '~/components/quiz/QuizForm'
import { mapGetters } from 'vuex'
import ApiBuilder from '~/common/api/builder'
const QuizzesApi = ApiBuilder.build('quizzes') 

export default {
    asyncData({isDev, route, store, env, params, query, req, res, redirect, error}) {
        let collectionId = params.collectionId
        return {
            collectionId
        }
    },
    components: {
        QuizForm
    },
    computed: {
        ...mapGetters({
            authenToken: 'user/authenToken'
        })
    },
    methods:{
        async clickCreate(payload) {
            try {
                let response = await QuizzesApi.create(this.authenToken, payload)
                 this.$router.go(-1)
            } catch (error) {
                console.log('create quiz error', error)
            }
        }
    }
}
</script>