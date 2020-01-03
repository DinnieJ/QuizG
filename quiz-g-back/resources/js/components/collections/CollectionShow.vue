<template>
<div>
    <div class="my-3 p-2 item-nav">
        {{ collection.name }}
    </div>
    <quizzes-group :quizzes="collection.quizzes" />
</div>
</template>

<script>
export default {
    props:{
        collection:Object
    },
    data() {
        return {
            collection: {
                name: "Collection 1"
            }
        }
    }
}
</script>