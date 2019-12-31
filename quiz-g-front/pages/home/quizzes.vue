<template>
<div class="container">
    <user-nav 
        :user="user"
        home
        active-tab="Quizzes"
    />
    <quizzes-group 
        :quizzes="quizzes" 
        selectable
        authorize
        @click-delete="clickDelete($event)"
    />
</div>
</template>

<script>
import UserNav from '~/components/user/UserNav'
import QuizzesGroup from '~/components/quiz/QuizzesGroup'
import { mapGetters } from 'vuex'
import ApiBuilder from '~/common/api/builder'
const QuizzesApi = ApiBuilder.build('quizzes') 

export default {
    middleware: 'authenticated',
    async asyncData({isDev, route, store, env, params, query, req, res, redirect, error}) {
        let user = store.getters['user/currentUser']
        let authenToken = store.getters['user/authenToken']
        try{
            let response = await QuizzesApi.getByUser(authenToken,user.id)
            if(response.status == 200) {
                 /**
                 * @type {Array}
                 */
                let quizzesSource = response.data.quizzes

                var temp = 0

                let quizzesList = quizzesSource.map(quiz => {
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
        UserNav,
        QuizzesGroup
    },
    computed: {
        ...mapGetters({
            quizzes: 'quiz/quizzes',
            authenToken: 'user/authenToken'
        })
    },
    data() {
        return {
        }
    },
    methods: {
        async clickDelete(payload) {
            try {
                let response = await QuizzesApi.delete(this.authenToken, payload.id)
                if(response.status === 200) {
                    this.$router.go(0)
                }
            } catch (error) {
                
            }
        }
    },
    created() {

    }
}
</script>