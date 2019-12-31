<template>
<div class="game-nav">
    <div class="row pa-2">
        <div class="col-10 d-flex flex-row">
            <div class="progress w-100 mt-2 ml-1">
                <div 
                    :class="`progress-bar bg-${progressColor}`" 
                    role="progressbar" 
                    :style="`width: ${percent}%;`" 
                    :aria-valuenow="percent" 
                    aria-valuemin="0" 
                    aria-valuemax="100"
                >{{time}}s</div>
            </div>
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
        totalTime: Number,
        
    },
    data() {
        return {
            percent: 0
        }
    },
    computed: {
        progressColor() {
            let percent = parseInt(this.time/this.totalTime*100)
            this.percent = percent
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