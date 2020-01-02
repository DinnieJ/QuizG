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
                :choice="checkChoice(item.id)"
                :disabled="disabled"
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
        index: Number,
        disabled: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
        }
    },
    computed: {
    },
    methods: {
        selectAnswer(id) {
            if(this.quiz.answer_id == id) {
                this.quiz.answer_id = undefined
                this.$emit('unanswer-quiz', this.index)
            } else {
                this.quiz.answer_id = id
                this.$emit('answer-quiz', this.index)
            }
        },
        checkChoice(id) {
            let choice = (this.quiz.answer_id === id)
            return choice
        }
    }
}
</script>