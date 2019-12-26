<template>
<div class="row">
    <template v-for="(item, i) in quizzes">
        <quiz-card :quiz="item" :index="i + 1" :key="'quiz-' + i" :selectable="selectable" :creator-show="creatorShow" :authorize="authorize" />
    </template>
</div>
</template>

<script>
import QuizCard from './QuizCard'
export default {
    components: {
        QuizCard
    },
    props: {
        quizzes: Array,
        selectable: {
            type: Boolean,
            default: false
        },
        creatorShow: {
            type: Boolean,
            default: false
        },
        authorize: {
            type: Boolean,
            default: false
        }
    },
    created() {
        if(this.selectable) {
            this.$store.commit('quiz/RESET_SELECTED_QUIZZES')
        }
    }
}
</script>