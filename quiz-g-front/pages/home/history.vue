<template>
<div class="container">
    <user-nav 
        :user="user"
        home
        active-tab="history"
    />
    <history-table />
</div>
</template>

<script>
import HistoryTable from '~/components/history/HistoryTable'
import UserNav from '~/components/user/UserNav'
import HistoryApi from `~/common/api/history`

export default {
    // middleware: 'authenticated',
    async asyncData({isDev, route, store, env, params, query, req, res, redirect, error}) {
        let user = store.getters['user/currentUser']
        try{
            let response = await HistoryApi.getHistoryByUser(user.id)
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
        UserNav,
        HistoryTable
    },
    computed: {
    },
    data() {
        return {
        }
    },
    created() {

    }
}
</script>