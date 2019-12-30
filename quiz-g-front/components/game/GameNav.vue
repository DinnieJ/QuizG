<template>
<div class="game-nav">
    <div class="row pa-2">
        <div class="col-10 d-flex flex-row">
            <b-progress 
                class="ml-1 mt-2 game-time-process" 
                :max="totalTime" 
                height="35px"
                striped 
                animated
                :value="time"
                
            >
                <b-progress-bar :variant="progressColor" :value="time">
                    Time: 
                    <strong>{{time}}s</strong>
                </b-progress-bar>
                
            </b-progress>
        </div>
        <div class="col-2 d-flex flex-row-reverse">
            <button class="btn mr-2 mt-2 btn-skip" @click="clickSkip()">
                Skip
            </button>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: {
        time: Number,
        totalTime: Number
    },
    computed: {
        progressColor() {
            let percent = parseInt(this.time/this.totalTime*100)
            if(percent > 75) {
                return 'success'
            } else if (percent > 50) {
                return 'info'
            } else if (percent > 25) {
                return 'warning'
            }
            return 'danger'
        }
    },
    methods: {
        clickSkip() {
            this.$emit('click-skip')
        }
    }
}
</script>