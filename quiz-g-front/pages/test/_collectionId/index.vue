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
        :correct="correct"
        @submit-test="submitTest($event)"
    />
</div>
</template>

<script>
import CountdownAction from '~/components/common/CountdownAction'
import TestQuizzesGroup from '~/components/test/TestQuizzesGroup'
import { mapGetters } from 'vuex'
import ApiBuilder from '~/common/api/builder'
const TestApi = ApiBuilder.build('test') 

export default {
    layout: 'empty',
    async asyncData({isDev, route, store, env, params, query, req, res, redirect, error}) {
        let quizzes = []
        let collectionId = params.collectionId
        let authenToken = store.getters['user/authenToken']
        try {
            let response = await TestApi.getById(authenToken, collectionId)
            let collection = response.data.collection
            console.log('test page', response)
            quizzes = collection.quizzes
            quizzes.forEach(item => {
                item.answer_id = undefined
            })  
            store.commit('collection/SET_CURRENT_COLLECTION', {
                id: collection.id,
                name: collection.name,
                user_id: collection.user_id
            })
        } catch(e) {
            console.error('test page error', e)
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
            start: false,
            correct: -1
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
        async submitTest(payload) {
            try {
                console.log('submitTest', payload)
                let response = await TestApi.submit(this.authenToken, payload)
                console.log('test submit', response)
                if(response.status === 200) {
                    this.correct = response.data.correct
                }
            } catch(e) {
                console.error('test submit', e)
            }
        }
    }
}
</script>