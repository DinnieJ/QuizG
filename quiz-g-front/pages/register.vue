<template>
<div>
    <register-form 
        v-model="error.status"
        :error-message="error.message"
        @click-create="clickCreate($event)"
    />
</div>
</template>

<script>
import RegisterForm from '~/components/user/RegisterForm'
import ApiBuilder from '~/common/api/builder'
const AuthApi = ApiBuilder.build('auth')

export default {
    layout: 'authLayout',
    components: {
        RegisterForm
    },
    data() {
        return {
            error: {
                status: false,
                message: ''
            }
        }
    },
    methods: {
        async clickCreate(payload) {
            try {
                let response = await AuthApi.register(payload)
                if(response.status === 200) {
                    this.$router.push({
                        path: '/login'
                    })
                }
            } catch(e) {
                console.log('error', e)
            }
        }
    }
}
</script>