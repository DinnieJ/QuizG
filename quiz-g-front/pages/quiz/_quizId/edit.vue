<template>
<div>
    <quiz-form 
        edit
        :quiz="quiz"
        @click-edit="clickEdit($event)"
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
            authenToken: 'user/authenToken',
            quiz: 'quiz/currentQuiz'
        })
    },
    methods: {
        async clickEdit(payload) {
            try {
                let response = await QuizzesApi.update(this.authenToken, payload.id, payload)
                console.log('edit quiz', response)
                 this.$router.go(-1)
            } catch (error) {
                console.log('edit quiz error', error)
            }
        }
    }
}
</script>