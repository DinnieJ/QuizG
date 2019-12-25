<template>
<div class="row">
    <template v-for="(item, i) in quizzes">
        <quiz-card :quiz="item" :index="i + 1" :key="'quiz-' + i" />
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
        }
    },
   
}
</script>