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
import CollectionApi from '~/common/api/collection'
import CollectionsGroup from '~/components/collection/CollectionsGroup'
import DiscoverNav from '~/components/common/DiscoverNav'
import { mapGetters } from 'vuex'
import ApiBuilder from '~/common/api/builder'
const ColletionsApi = ApiBuilder.build('colletions') 

export default {
    middleware: 'authenticated',
    async asyncData({isDev, route, store, env, params, query, req, res, redirect, error}) {
        let authToken = store.getters['user/authToken']
        try{
            let response = await ColletionsApi.getAll(authToken)
            if(response.status == 200) {
                let collectionsList = response.data.collections
                store.commit('collection/SET_COLLECTIONS', collectionsList)
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