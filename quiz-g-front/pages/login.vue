<template>
<div class="form form-user">
    <h2 class="text-center form-header">Login QuizG</h2>
    <div>
        <div class="form-group">
            <label for="inputEmail" class="text-uppercase">Email</label>
            <input type="email" name="email" class="form-control" placeholder="" required v-model="email">
            <error-alert :show="error.status" :message="error.message" />
            
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1" class="text-uppercase">Password</label>
            <input type="password" name="password" class="form-control" placeholder="" required v-model="password">
        </div>
        <div>
            <button class="btn text-uppercase btn-login" @click="clickLogin()">Login</button>
            <a class="float-right" href="/register">Signup</a>
        </div>
    </div>
</div>
</template>

<script>
import UserApi from '~/common/api/user'
import ErrorMap from '~/common/error_code'
import ErrorAlert from '~/components/common/ErrorAlert'

export default {
    layout: 'authLayout',
    components: {
        ErrorAlert
    },
    data() {
        return {
            email: "",
            password: "",
            error: {
                status: false,
                message: ""
            }
        }
    },
    methods: {
        clickLogin() {
            let payload = {
                email : this.email,
                password: this.password
            }

            let context = this
            /**
             * @type {Promise}
             */
            let api = UserApi.login(payload)
            api.then(response => {
                if(response && response.status == 200) {
                    let authen = response.data.authen
                    context.$store.commit('user/AUTHENTICATE', authen)
                    context.$router.push({
                        path: '/home/collections'
                    })
                }
            })
            api.catch(e => {
                context.error.status = true
                setTimeout(function() {
                    context.error.status = false
                }, 2000)
                let code = e.data.error
                if(ErrorMap.has(code)) {
                    context.error.message = ErrorMap.get(code)
                } else {
                    context.error.message = "Has error"
                }
            })
        }
    },
    created() {
    }
}
</script>