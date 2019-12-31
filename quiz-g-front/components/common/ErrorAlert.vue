<template>
<transition name="slide-fade">
    <div class="error-alert" v-if="show">
        <span>{{ message }}</span>
    </div>
</transition>
</template>

<script>
export default {
    props: {
        message: String,
        value: {
            type: Boolean,
            default: false
        }
    },
    data() {
      return {
          show: false
      }  
    },
    watch: {
        value: {
            deep: true,
            handler(value) {
                if(value) {
                    
                    let context = this
                    context.show = true
                    setTimeout(function() {
                        context.show = false
                        context.$emit('input', false)
                    }, 2000)
                } else {
                    this.show = false
                }
            }
        }
    },
}
</script>