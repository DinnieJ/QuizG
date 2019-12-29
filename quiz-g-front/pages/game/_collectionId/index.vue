<template>
<div class="full-screen-height">
    <countdown-action
        v-if="!start"
        @start-action="startTest()"
    />
    <game-quizzes-group
        v-show="start"
        :start="start"
        :quizzes="quizzes"
        @finish-quiz="finishQuiz($event)"
    />
</div>
</template>

<script>
import CountdownAction from '~/components/common/CountdownAction'
import GameQuizzesGroup from '~/components/game/GameQuizzesGroup'
import GameApi from '~/common/api/game'

export default {
    layout: 'empty',
    async asyncData({isDev, route, store, env, params, query, req, res, redirect, error}) {
        let quizzes = []
        let collectionId = params.collectionId
        try {
            let response = await GameApi.getQuizzesByGame(collectionId)
            quizzes = response.data.quizzes
            quizzes.forEach(item => {
                item.choiceAnswer = ''
            })
        } catch(e) {

        }
        return {
            quizzes
        }
    },
    components: {
        CountdownAction,
        GameQuizzesGroup
    },
    data() {
        return {
            start: false
        }
    },
    methods: {
        startTest() {
            this.start = true
        },
        finishQuiz(quiz) {
        }
    }
}
</script>