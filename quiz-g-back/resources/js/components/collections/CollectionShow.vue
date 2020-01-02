<template>
<div>
    <div class="my-3 p-2 item-nav">
        {{ collection.name }}
    </div>
    <quizzes-group />
</div>
</template>

<script>
export default {
    data() {
        return {
            collection: {
                name: "Collection 1"
            }
        }
    }
}
</script>