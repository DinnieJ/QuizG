<template>
<div class="d-flex justify-content-between mx-auto test-countdown">
    <test-time-item v-if="correct > -1" :value="correct" title="Correct" />
    <test-time-item v-if="correct > -1" :value="percent" title="Percent" />
    <test-time-item :value="hours" title="Hours" />
    <test-time-item :value="minutes" title="Minutes" />
    <test-time-item :value="seconds" title="Seconds" />
</div>
</template>

<script>
import TestTimeItem from './TestTimeItem'

export default {
    components: {
        TestTimeItem
    },
    props: {
        time: Number,
        totalQuizzes: Number,
        correct: {
            type: [Number],
            default: -1
        }
    },
    data() {
        return {
            hours: 0,
            minutes: 0,
            seconds: 0,
        }
    },
    watch: {
        time: {
            deep: true,
            handler(value) {
                this.updateTime(value)
            }
        }
    },
    computed: {
        percent() {
            let percent = 0
            if(this.correct > -1) {
                percent = parseInt(this.correct/this.totalQuizzes*100)
            }
            return percent
        }
    },
    methods: {
        updateTime(time) {
            this.hours = parseInt(time/3600)
            this.minutes = parseInt((time - this.hours*3600)/60)
            this.seconds = time - this.hours*3600 - this.minutes*60
        }
    },
    created() {
        this.updateTime(this.time)
    }
}
</script>