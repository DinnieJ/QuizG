<template>
<div>
    <b-card>
        <b-card-body>
            <b-card-title>
                #{{ index + 1 }}
            </b-card-title>
            <b-card-text>
                {{ quiz.content }}
            </b-card-text>
        </b-card-body>
    </b-card>
    <div>
        <template v-for="(item, i) in quiz.answers">
            <test-answer-card 
                :answer="item" 
                :key="'answer-' + i" 
                :index="i"
                :choice="quiz.choice === i"
                @select-answer="selectAnswer($event)"
            />
        </template>
    </div>
</div>

</template>

<script>
import TestAnswerCard from './TestAnswerCard'

export default {
    components: {
        TestAnswerCard
    },
    props: {
        quiz: Object,
        index: Number
    },
    data() {
        return {
        }
    },
    computed: {
    },
    methods: {
        selectAnswer(index) {
            if(this.quiz.answer == index) {
                this.quiz.choice = -1
                this.$emit('unanswer-quiz')
            } else {
                this.quiz.choice = index
                this.$emit('answer-quiz', index)
            }
        }
    }
}
</script>