<template>
<div>
    <quiz-form 
        edit
        :quiz="quiz"
    />
</div>
</template>

<script>
import QuizForm from '~/components/quiz/QuizForm'

export default {
    components: {
        QuizForm
    },
    computed: {
        quiz() {
            let quiz = this.$store.getters['quiz/currentQuiz']
            return quiz
        }
    }
}
</script>