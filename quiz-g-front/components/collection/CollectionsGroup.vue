<template>
    <b-card-group columns>
        <template v-for="(item, i) in collections">
             <collection-card 
                :key="'demo' + i" 
                :collection="item" 
                :creator-show="creatorShow" 
                :add-quiz="addQuiz"
                @click-add-quiz="clickAddQuiz"
            />
        </template>
    </b-card-group>
</template>

<script>
import CollectionCard from './CollectionCard'

export default {
    components: {
        CollectionCard
    },
    props: {
        collections: Array,
        creatorShow: {
            type: Boolean,
            default: false
        },
        addQuiz: {
            type: Boolean,
            default: false
        }
    },
    methods: {
        clickAddQuiz(payload) {
            this.$emit('click-add-quiz', payload)
        }
    }
}
</script>