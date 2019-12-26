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

export default {
    // middleware: 'authenticated',
    async asyncData({isDev, route, store, env, params, query, req, res, redirect, error}) {
        try{
            let response = await CollectionApi.getAllCollections()
            if(response.status == 200) {
                let collectionsList = response.data.collections
                store.commit('collection/SET_COLLECTIONS', collectionsList)
                store.commit('user/ACTIVE_PAGE', 'discover')
            }
            
        } catch(e) {
            console.log('getAllCollections error', e)
            redirect('/500')
        }
        return {
            
        }
    },
     components: {
        CollectionsGroup,
        DiscoverNav
    },
    computed: {
        collections() {
            let collections = this.$store.getters['collection/collections']
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