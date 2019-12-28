<template>
<div class="full-screen-height">
    <countdown-action
        v-if="!start"
        @start-action="startTest()"
    />
    <test-quizzes-group 
        v-show="start"
        :start="start"
        :quizzes="quizzes"
    />
</div>
</template>

<script>
import CountdownAction from '~/components/common/CountdownAction'
import TestQuizzesGroup from '~/components/test/TestQuizzesGroup'
import TestApi from '~/common/api/test'

export default {
    layout: 'empty',
    async asyncData({isDev, route, store, env, params, query, req, res, redirect, error}) {
        let quizzes = []
        let collectionId = params.collectionId
        try {
            let response = await TestApi.getQuizzesByTest(collectionId)
            quizzes = response.data.quizzes
        } catch(e) {

        }
        return {
            quizzes
        }
    },
    components: {
        CountdownAction,
        TestQuizzesGroup
    },
    data() {
        return {
            start: false
        }
    },
    methods: {
        startTest() {
            this.start = true
        }
    }
}
</script>