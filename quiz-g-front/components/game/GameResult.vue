<template>
<div class="h-100 game-result" v-if="finish" >
    <div class="d-flex align-items-center h-100 container">
        <div class="w-100 p-4 game-result-table">
            <div class="row">
                <h1 class="w-100 text-uppercase text-center my-4 font-pacifico game-result-header">
                    congratulations
                </h1>
                <div class="col-4 text-center">
                    <div class="mb-2 game-result-number">{{ result.correct }}</div>
                    <div class="text-uppercase game-result-title">correct</div>
                </div>
                <div class="col-4 text-center">
                    <div class="mb-2 game-result-number">{{ result.total }}</div>
                    <div class="text-uppercase game-result-title">total</div>
                </div>
                <div class="col-4 text-center"> 
                    <div class="mb-2 game-result-number">{{ percent }}</div>
                    <div class="text-uppercase game-result-title">percent</div>
                </div>
            </div>
            <div class="row">
                <div class="col-4 text-center">
                    <div class="mb-2 game-result-number">{{ hours }}</div>
                    <div class="text-uppercase game-result-title">Hours</div>
                </div>
                <div class="col-4 text-center">
                    <div class="mb-2 game-result-number">{{ minutes }}</div>
                    <div class="text-uppercase game-result-title">Minutes</div>
                </div>
                <div class="col-4 text-center"> 
                    <div class="mb-2 game-result-number">{{ seconds }}</div>
                    <div class="text-uppercase game-result-title">Seconds</div>
                </div>
            </div>
        </div>
    </div>
    
</div>
</template>

<script>
export default {
    props: {
        finish: {
            type: Boolean,
            default: false
        },
        result: Object
    },
    computed: {
        percent() {
            let percent = parseInt(this.result.correct/this.result.total*100)
            return percent
        },
        hours() {
            let hours = parseInt(this.result.total_time/3600)
            return hours
        },
        minutes() {
            let minutes = parseInt((this.result.total_time - this.hours*3600)/60)
            return minutes
        },
        seconds() {
            let seconds = this.result.total_time - this.hours*3600 - this.minutes*60
            return seconds
        }
    }
}
</script>