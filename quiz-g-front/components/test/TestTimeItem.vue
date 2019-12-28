<template>
<div class="test-countdown-block">
    <p class="test-countdown-digit">{{ value }}</p>
    <p class="test-countdown-text">{{ title }}</p>
</div>
</template>

<script>
export default {
    props: {
        title: String,
        value: Number
    }
}
</script>