<template>
<div class="container">
    <quizzes-group :quizzes="quizzes" />
</div>
</template>

<script>
import QuizApi from '~/common/api/quiz'
import QuizzesGroup from '~/components/quiz/QuizzesGroup'

export default {
    // middleware: 'authenticated',
    async asyncData({isDev, route, store, env, params, query, req, res, redirect, error}) {
        try{
            let response = await QuizApi.getAllQuizzes()
            if(response.status == 200) {
                 /**
                 * @type {Array}
                 */
                let quizzesSource = response.data.quizzes

                var temp = 0

                let quizzesList = quizzesSource.map(quiz => {
                    // quiz.select = false
                    temp = quiz.correct_answer_id
                    quiz.answers.forEach(answer => {
                        if(answer.id == temp) {
                            answer.correct = true
                        } else {
                            answer.correct = false
                        }
                    })
                   
                    return quiz;
                })
               
                store.commit('quiz/SET_QUIZZES', quizzesList)
                store.commit('user/ACTIVE_PAGE', 'discover')
            }
            
        } catch(e) {
            console.log('getAllCollections error', e)
            redirect('/500')
        }
        return {
        }
    },
    components: {
        QuizzesGroup
    },
    computed: {
        quizzes() {
            let quizzes = this.$store.getters['quiz/quizzes']
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