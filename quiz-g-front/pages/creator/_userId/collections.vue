<template>
<div class="container">
    <user-nav 
        :user="user"
        active-tab="Collections"
    />
    <collections-group 
        :collections="collections"
    />
</div>
</template>

<script>
import CollectionApi from '~/common/api/collection'
import CollectionsGroup from '~/components/collection/CollectionsGroup'
import UserNav from '~/components/user/UserNav'

export default {
    // middleware: 'authenticated',
    async asyncData({isDev, route, store, env, params, query, req, res, redirect, error}) {
        let userId = params.userId
        let user = {}
        try{
            let response = await CollectionApi.getCollectionsByUser(userId)
            if(response.status == 200) {
                let collectionsList = response.data.collections
                user = response.data.user
                store.commit('collection/SET_COLLECTIONS', collectionsList)
                store.commit('user/ACTIVE_PAGE', 'discover')
            }
            
        } catch(e) {
            console.log('getAllCollections error', e)
            redirect('/500')
        }
        return {
            user
        }
    },
    components: {
        CollectionsGroup,
        UserNav
    },
    computed: {
        collections() {
            let collections = this.$store.getters['collection/collections']
            return collections;
        },
    },
    data() {
        return {
        }
    },
    created() {

    }
}
</script>