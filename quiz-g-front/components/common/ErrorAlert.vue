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
        show: {
            type: Boolean,
            default: false
        },
        message: String
    }
}
</script>