<template>
<div class="container">
    <discover-nav 
        active-tab="Collections"
        @enter-search="enterSearch($event)"
    />
    <collections-group 
        :collections="collections"
        creator-show
    />
</div>
</template>

<script>
import CollectionsGroup from '~/components/collection/CollectionsGroup'
import DiscoverNav from '~/components/common/DiscoverNav'
import { mapGetters } from 'vuex'
import ApiBuilder from '~/common/api/builder'
const CollectionsApi = ApiBuilder.build('collections')

export default {
    middleware: 'authenticated',
    async asyncData({isDev, route, store, env, params, query, req, res, redirect, error}) {
        let authenToken = store.getters['user/authenToken']
        let collections = []
        try{
            let response = await CollectionsApi.getAll(authenToken)
            if(response.status == 200) {
                let collectionsList = response.data.collections.data
                if(collectionsList && collectionsList.length > 0) {
                    collections = collectionsList
                }
                
                store.commit('collection/SET_COLLECTIONS', collections)
                store.commit('user/ACTIVE_PAGE', 'discover')
            }
            
        } catch(e) {
            console.log('getAllCollections error', e)
        }
        return {
            
        }
    },
     components: {
        CollectionsGroup,
        DiscoverNav
    },
    computed: {
        ...mapGetters({
            collectionsSource: 'collection/collections'
        }),
        collections() {
            let collections = this.collectionsSource
            return collections.filter(item => {
                if(this.searchType == 1) {
                    return item.name.toLowerCase().includes(this.searchContent.toLowerCase())
                }
                if(this.searchType == 2) {
                    return item.user.name.toLowerCase().includes(this.searchContent.toLowerCase())
                }
                return true
            });
        },
    },
    data() {
        return {
            searchContent: "",
            searchType: 0
        }
    },
    methods:{
        enterSearch(search) {
            this.searchContent = search.content
            this.searchType = search.type
        }
    }
}
</script>