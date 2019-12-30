<template>
<div class="container">
    <user-nav 
        :user="user"
        home
        active-tab="History"
    />
    <history-table :histories="histories"/>
</div>
</template>

<script>
import HistoryTable from '~/components/history/HistoryTable'
import UserNav from '~/components/user/UserNav'
// import HistoryApi from '~/common/api/history'
import { mapGetters } from 'vuex'
import ApiBuilder from '~/common/api/builder'
const HistoryApi = ApiBuilder.build('history') 

export default {
    middleware: 'authenticated',
    async asyncData({isDev, route, store, env, params, query, req, res, redirect, error}) {
        let user = store.getters['user/currentUser']
        let authToken = store.getters['user/authToken']
        try{
            let response = await HistoryApi.getAll(authToken)
            if(response.status == 200) {
                let histories = response.data.histories
                store.commit('history/SET_HISTORIES', histories)
                store.commit('user/ACTIVE_PAGE', 'home')
            }
            
        } catch(e) {
            console.log('getAllCollections error', e)
        }
        return {
            user
        }
    },
    components: {
        UserNav,
        HistoryTable
    },
    computed: {
        ...mapGetters({
            histories: 'history/histories'
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