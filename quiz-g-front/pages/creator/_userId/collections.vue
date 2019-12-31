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
import CollectionsGroup from '~/components/collection/CollectionsGroup'
import UserNav from '~/components/user/UserNav'
import { mapGetters } from 'vuex'
import ApiBuilder from '~/common/api/builder'
const CollectionsApi = ApiBuilder.build('collections')


export default {
    middleware: 'authenticated',
    async asyncData({isDev, route, store, env, params, query, req, res, redirect, error}) {
        let userId = params.userId
        let authenToken = store.getters['user/authenToken']
        let user = {}
        try{
            let response = await CollectionsApi.getByUser(authenToken, userId)
            if(response.status == 200) {
                let collectionsList = response.data.collections
                user = response.data.user
                store.commit('collection/SET_COLLECTIONS', collectionsList)
                store.commit('user/ACTIVE_PAGE', 'discover')
            }
            
        } catch(e) {
            console.log('get collections by user error', e)
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