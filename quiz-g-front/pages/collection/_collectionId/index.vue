<template>
<div class="container">
    <collection-nav
        :collection="collection"
        :authorize="authorize"
    />
    <quizzes-group 
        :quizzes="quizzes"
        selectable
        :authorize="authorize"
    />
</div>
</template>

<script>
import CollectionApi from '~/common/api/collection'
import QuizzesGroup from '~/components/quiz/QuizzesGroup'
import CollectionNav from '~/components/collection/CollectionNav'

export default {
    // middleware: 'authenticated',
    async asyncData({isDev, route, store, env, params, query, req, res, redirect, error}) {
        let collectionId = params.collectionId
        let collection = {}
        let authorize = false
        try{
            let response = await CollectionApi.getCollectionById(collectionId)
            if(response.status == 200) {
                 /**
                 * @type {Array}
                 */
                let quizzesSource = response.data.quizzes
                collection = response.data.collection
                authorize = response.data.authorize

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
               
                store.commit('collection/SET_CURRENT_COLLECTION', collection)
                store.commit('quiz/SET_QUIZZES', quizzesList)
                if(authorize) {
                    store.commit('user/ACTIVE_PAGE', 'home')
                } else {
                    store.commit('user/ACTIVE_PAGE', 'discover')
                }
                
            }
            
        } catch(e) {
            console.log('getAllCollections error', e)
        }

        return {
            collection,
            authorize
        }
    },
    components: {
        QuizzesGroup,
        CollectionNav
    },
    computed: {
        quizzes() {
            let quizzes = this.$store.getters['quiz/quizzes']
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

        }
    },
    methods:{
    },
    created() {

    }
}
</script>