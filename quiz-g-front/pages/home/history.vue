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
import HistoryApi from '~/common/api/history'

export default {
    // middleware: 'authenticated',
    async asyncData({isDev, route, store, env, params, query, req, res, redirect, error}) {
        let user = store.getters['user/currentUser']
        try{
            let response = await HistoryApi.getHistoryByUser(user.id)
            if(response.status == 200) {
                let histories = response.data.histories
                store.commit('history/SET_HISTORIES', histories)
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
        UserNav,
        HistoryTable
    },
    computed: {
        histories() {
            let histories = this.$store.getters['history/histories']
            return histories
        }
    },
    data() {
        return {
        }
    },
    created() {

    }
}
</script>