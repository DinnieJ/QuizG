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
import UserApi from '~/common/api/user'
import RegisterForm from '~/components/user/RegisterForm'

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
                let response = await UserApi.register(payload)
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
    }
}
</script>