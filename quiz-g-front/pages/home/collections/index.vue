<template>
<div class="container">
    <user-nav 
        :user="user"
        home
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
import { mapGetters } from 'vuex'

export default {
    middleware: 'authenticated',
    async asyncData({isDev, route, store, env, params, query, req, res, redirect, error}) {
        let user = store.getters['user/currentUser']
        try{
            let response = await CollectionApi.getCollectionsByUser(user.id)
            if(response.status == 200) {
                let collectionsList = response.data.collections
                store.commit('collection/SET_COLLECTIONS', collectionsList)
                store.commit('user/ACTIVE_PAGE', 'home')
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
        ...mapGetters({
            collections: 'collection/collections'
        })
    },
    data() {
        return {
        }
    },
    created() {
    }
}
</script>