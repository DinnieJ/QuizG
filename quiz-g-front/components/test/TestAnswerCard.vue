<template>
<div class="row mt-1" @click="selectAnswer()" >
    <div class="col-1">
        <div :class="indexClass">
            {{ String.fromCharCode(index + 65) }}
        </div>
    </div>
    <div class="col-11">
        <div class="p-2 test-answer-content">
            {{ answer.content }}
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: {
        answer: Object,
        index: Number,
        choice: {
            type: Boolean,
            default: false
        },
        disabled: {
            type: Boolean,
            default: false
        }
    },
    computed: {
        indexClass() {
            let classString = "text-center ml-2 test-answer-index answer-index "
            if(this.choice) {
                classString += "answer-active-" + this.index
            } else {
                classString += "answer-" + this.index
            }
            return classString
        }
    },
    methods: {
        selectAnswer() {
            if(this.disabled) {
                return
            }
            this.$emit('select-answer', this.answer.id)
        }
    }
}
</script>