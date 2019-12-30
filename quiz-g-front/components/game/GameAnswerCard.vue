<template>
<div class="col-6 mb-2">
    <div 
        :class="'row h-100 m-2 game-answer game-answer-' + index"
        @click="clickAnswer()"
    >
        <div class="col-2">
            <div class="text-center w-100 game-answer-index">
                {{ String.fromCharCode(index + 65) }}.
            </div>
        </div>
        <div class="col-10 p-2">
            {{ answer.content }}
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: {
        answer: Object,
        index: Number
    },
    data() {
        return {
        }
    },
    computed: {
    },
    methods: {
        clickAnswer() {
            this.$emit('click-answer', this.index)
        }
    }
}
</script>