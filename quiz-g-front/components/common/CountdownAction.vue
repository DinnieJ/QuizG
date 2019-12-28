<template>
<div :class="`countdown-action number-${number}`">
    <div class="h-100 d-flex align-items-center">
        <transition name="fade">
            <template v-if="fade">
                <div v-if="number > 0" class="mx-auto countdown-action-timer text-center">
                    <div class="h-100 d-flex align-items-center">
                        <div :class="`mx-auto countdown-action-number number-${number}`">
                            {{ number }}
                        </div>
                    </div>
                </div>
                <div v-else class="mx-auto font-lobster countdown-action-start">
                    START
                </div>
            </template>
        </transition>
    </div>
    
</div>
</template>

<script>
export default {
    data() {
        return {
            number: 5,
            color: {},
            fade: true
        }
    },
    methods: {
        startClock() {
            var context = this
            context.clock = setInterval(function () {
                context.fade = false
                if(context.number == 0) {
                    context.stopClock()
                }
                context.number--;
                context.fade = true
            }, 1000)
        },
        stopClock() {
            clearInterval(this.clock)
            this.$emit('start-action')
        }
    },
    created(){
        this.startClock()
    }
}
</script>