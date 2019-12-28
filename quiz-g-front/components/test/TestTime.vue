<template>
<div class="d-flex justify-content-between mx-auto test-countdown">
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
        time: Number
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