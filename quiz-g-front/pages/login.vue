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
import LoginForm from '~/components/user/LoginForm'
import ApiBuilder from '~/common/api/builder'
const AuthApi = ApiBuilder.build('auth')
const Cookie = process.client ? require('js-cookie') : undefined

import axios from 'axios'

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
                let loginResonse = await AuthApi.login(payload)
                let authen = loginResonse.data.token
                this.$store.commit('user/AUTHENTICATE', authen)
                Cookie.set('authenToken', authen)

                let getUserResponse = await AuthApi.getByUser(authen)
                let user = getUserResponse.data.user
                this.$store.commit('user/SET_CURRENT_USER', user)
                Cookie.set('currentUser', user)

                this.$router.push({
                    path: '/home/collections'
                })

                

            } catch(e) {
                console.log('error', e)
                // this.error.status = true
                // this.error.message = e.data.error
            }
        }
    },
    created() {
    }
}
</script>