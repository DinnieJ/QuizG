<template>
<div class="row row-answer">
    <div :class="'col-1 text-center answer-index answer-' + index">{{ String.fromCharCode(index + 65) }}</div>
    <div class="col-9">
        {{ answer.content }}
    </div>
    <div v-if="answer.correct" class="col-2">
        <img src="/correct.png" alt="">
    </div>
</div>
</template>

<script>
export default {
    props: {
        answer: Object,
        index: Number
    }
}
</script>