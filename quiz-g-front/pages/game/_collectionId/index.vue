<template>
<div class="full-screen-height">
    <countdown-action
        v-if="!start"
        @start-action="startTest()"
    />
    <game-quizzes-group
        v-show="start && !finish"
        :start="start"
        :quizzes="quizzes"
        @finish-quiz="finishQuiz($event)"
        @finish-game="finishGame()"
    />
    <game-result 
        :result="result"
        :finish="finish"
    />
</div>
</template>

<script>
import CountdownAction from '~/components/common/CountdownAction'
import GameQuizzesGroup from '~/components/game/GameQuizzesGroup'
import GameResult from '~/components/game/GameResult'
import { mapGetters } from 'vuex'
import ApiBuilder from '~/common/api/builder'
const GameApi = ApiBuilder.build('game') 

export default {
    layout: 'empty',
    async asyncData({isDev, route, store, env, params, query, req, res, redirect, error}) {
        let quizzes = []
        let historyId = -1
        let collectionId = params.collectionId
        let authenToken = store.getters['user/authenToken']
        try {
            let response = await GameApi.getById(authenToken, collectionId)
            let collection = response.data.collection
            quizzes = collection.quizzes
            historyId  = response.data.history_id
            quizzes.forEach(item => {
                item.choiceAnswer = ''
            })
            store.commit('collection/SET_CURRENT_COLLECTION', {
                id: collection.id,
                history_id: historyId,
                name: collection.name,
                user_id: collection.user_id
            })
        } catch(e) {
            console.error('game init', e)
        }
        return {
            quizzes,
            historyId
        }
    },
    components: {
        CountdownAction,
        GameQuizzesGroup,
        GameResult
    },
    data() {
        return {
            start: false,
            finish: false,
            result: {
                total: 0,
                correct: 0,
                total_time: 0
            }
        }
    },
    computed: {
        ...mapGetters({
            authenToken: 'user/authenToken',
            currentCollection: 'collection/currentCollection'
        })
    },
    methods: {
        startTest() {
            this.start = true
        },
        async finishQuiz(quiz) {
            console.log('finishQuiz', quiz)
            try {
                let tmp = quiz.choiceAnswer
                let payload = {
                    "id": quiz.id,
                    "answer_id": (tmp ? quiz.answers[tmp].id : -1),
                    "time": quiz.answerTime,
                    "history_id": this.currentCollection.history_id
                }
                let response = await GameApi.grading(this.authenToken, payload)
                console.log('quiz finish', response)
            } catch(e) {
                console.error('quiz finish', e)
            }
        },
        async finishGame() {
            try {
                let payload = {
                    history_id: this.currentCollection.history_id
                }
                let response = await GameApi.submit(this.authenToken, payload)
                console.log('game finish', response)
                if(response.status === 200) {
                    this.result = response.data.detail
                    this.finish = true
                }
            } catch(e) {
                console.error('game finish', e)
            }
        },
    }
}
</script>