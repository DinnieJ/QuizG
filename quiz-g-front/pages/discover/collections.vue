<template>
    <div>
        Discover collections
    </div>
</template>

<script>
export default {
    // middleware: 'authenticated',
    asyncData({isDev, route, store, env, params, query, req, res, redirect, error}) {
        store.commit('user/ACTIVE_PAGE', 'discover')
        return {
            
        }
    },
}
</script>