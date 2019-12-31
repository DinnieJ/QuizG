<template>
<div class="container">
    <collection-nav
        create-new
        @click-create="clickCreate($event)"
    />
</div>
</template>

<script>
import CollectionNav from '~/components/collection/CollectionNav'
import { mapGetters } from 'vuex'
import ApiBuilder from '~/common/api/builder'
const CollectionsApi = ApiBuilder.build('collections') 

export default {
    middleware: 'authenticated',
    components: {
        CollectionNav
    },
    computed: {
        ...mapGetters({
            authenToken: 'user/authenToken'
        })
    },
    methods: {
        async clickCreate(payload) {
            let authenToken = this.authenToken
            try {  
                let response = await CollectionsApi.create(this.authenToken, payload)
                this.$router.push({
                    path: '/home/collections'
                })
            } catch (error) {
                console.log('create collections error', error)
            }
        }
    }
}
</script>