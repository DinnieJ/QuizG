<template>
<div class="container">
    <discover-nav 
        active-tab="Quizzes"
        @enter-search="enterSearch($event)"
    />
    <quizzes-group 
        :quizzes="quizzes"
        selectable 
        creator-show
    />
</div>
</template>

<script>
import QuizApi from '~/common/api/quiz'
import QuizzesGroup from '~/components/quiz/QuizzesGroup'
import DiscoverNav from '~/components/common/DiscoverNav'
import { mapGetters } from 'vuex'
import ApiBuilder from '~/common/api/builder'
const QuizzesApi = ApiBuilder.build('quizzes') 

export default {
    middleware: 'authenticated',
    async asyncData({isDev, route, store, env, params, query, req, res, redirect, error}) {
        let authenToken = store.getters['user/authenToken']
        try{
            let response = await QuizzesApi.getAll(authenToken)
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
                store.commit('user/ACTIVE_PAGE', 'discover')
            }
            
        } catch(e) {
            console.log('getAllCollections error', e)
        }
        return {
        }
    },
    components: {
        QuizzesGroup,
        DiscoverNav
    },
    computed: {
        ...mapGetters({
            quizzesSource: 'quiz/quizzes'
        }),
        quizzes() {
            let quizzes = this.quizzesSource
            return quizzes.filter(item => {
                if(this.searchType == 1) {
                    return item.content.toLowerCase().includes(this.searchContent.toLowerCase())
                }
                if(this.searchType == 2) {
                    return item.user.name.toLowerCase().includes(this.searchContent.toLowerCase())
                }
                return true
            })
        }
    },
    data() {
        return {
            searchContent: "",
            searchType: 0
        }
    },
    methods:{
        enterSearch(search) {
            this.searchContent = search.content
            this.searchType = search.type
        }
    },
    created() {

    }
}
</script>