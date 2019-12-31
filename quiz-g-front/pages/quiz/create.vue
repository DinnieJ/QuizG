<template>
<div>
    <quiz-form 
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
    middleware: 'authenticated',
    components: {
        QuizForm
    },
    computed: {
        ...mapGetters({
            authenToken: 'user/authenToken'
        })
    },
    methods: {
        async clickCreate(payload) {
            try {
                let response = await QuizzesApi.create(this.authenToken, payload)
                console.log('create quiz', response)
                 this.$router.go(-1)
            } catch (error) {
                console.log('create quiz error', error)
            }
        }
    }
}
</script>