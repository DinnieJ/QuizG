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
import ApiBuilder from '~/common/api/builder'
const AuthApi = ApiBuilder.build('auth')

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
                // let response = await UserApi.login(payload)
                let demoPayload = {
                    "email":"dat@gmail.com",
                    "password":"12345"
                }
                // let response = await AuthApi.login(demoPayload)
                let response = await axios.get('http://127.0.0.1:8888/api/auth/login', payload)

                console.log('response', response)
                // let authen = response.data.authen
                // this.$store.commit('user/AUTHENTICATE', authen)
                // this.$router.push({
                //     path: '/home/collections'
                // })
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