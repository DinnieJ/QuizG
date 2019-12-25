<template>
    <div>
        This is creator page
    </div>
</template>

<script>
export default {
    validate ({ params }) {
        // Must be a number
        return /\d+$/.test(params.id)
    },
    asyncData({isDev, route, store, env, params, query, req, res, redirect, error}) {
        redirect('/creator/' + params.userId + '/collections')
        return {

        }
    },
}
</script>