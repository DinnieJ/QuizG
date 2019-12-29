<template>
<div class="container game-quiz">
    <div class="h-50 game-quiz-content">
         <b-card class="h-100">
            <b-card-body >
                <b-card-text>
                    {{ quiz.content }}
                </b-card-text>
            </b-card-body>
        </b-card>
    </div>
    <div class="h-50 mt-1 row">
        <template v-for="(item, i) in quiz.answers">
            <game-answer-card 
                :key="i"
                :index="i"
                :answer="item"
                @click-answer="clickAnswer($event)"
            />
        </template>
    </div>  
</div>
</template>

<script>
import GameAnswerCard from './GameAnswerCard'

export default {
    components: {
        GameAnswerCard
    },
    props: {
        quiz: Object
    },
    data() {
        return {
        }
    },
    methods: {
        clickAnswer(answerId) {
            this.$emit('click-answer', answerId)
        }
    }
}
</script>