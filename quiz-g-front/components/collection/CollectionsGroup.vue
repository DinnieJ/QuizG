<template>
    <b-card-group columns>
        <template v-for="(item, i) in collections">
             <collection-card :key="'demo' + i" :collection="item" :creator-show="creatorShow" />
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
        }
    }
}
</script>