<template>
<div>
    <login-form 
        v-model="error.status"
        :error-message="error.message"
        @click-login="clickLogin($event)"
    />
</div>
</template>

<script>
import UserApi from '~/common/api/user'
import LoginForm from '~/components/user/LoginForm'

export default {
    layout: 'authLayout',
    components: {
        LoginForm
    },
    data() {
        return {
            error: {
                status: false,
                message: ""
            }
        }
    },
    methods: {
        async clickLogin(payload) {
            try {
                let response = await UserApi.login(payload)
                let authen = response.data.authen
                this.$store.commit('user/AUTHENTICATE', authen)
                this.$router.push({
                    path: '/home/collections'
                })
            } catch(e) {
                this.error.status = true
                this.error.message = e.data.error
            }
        }
    },
    created() {
    }
}
</script>