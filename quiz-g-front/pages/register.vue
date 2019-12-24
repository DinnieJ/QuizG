<template>
<div class="form form-user">
    <h2 class="text-center form-header">Create Account</h2>
    <div>
        <div class="form-group">
            <label for="inputEmail" class="text-uppercase">Name</label>
            <input type="text" name="name" class="form-control" placeholder="" required v-model="name">
            <error-alert v-if="['auth-2'].includes(error.code)" :show="error.status" :message="errorMap.has(error.code) ? errorMap.get(error.code) : 'Has error'" />
        </div>
        <div class="form-group">
            <label for="inputEmail" class="text-uppercase">Email</label>
            <input type="email" name="email" class="form-control " placeholder="" required v-model="email">
            <error-alert v-if="['auth-3', 'auth-4'].includes(error.code)" :show="error.status" :message="errorMap.has(error.code) ? errorMap.get(error.code) : 'Has error'" />
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1" class="text-uppercase">Password</label>
            <input type="password" name="password" class="form-control" placeholder="" required v-model="password">
            <error-alert v-if="['auth-5', 'auth-6'].includes(error.code)" :show="error.status" :message="errorMap.has(error.code) ? errorMap.get(error.code) : 'Has error'" />
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1" class="text-uppercase">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="" required v-model="confirmPass">
        </div>
        <div>
            <button type="submit" class="btn btn-block text-uppercase btn-login" @click="clickCreate()">Create</button>
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
            name: "",
            email: "",
            password: "",
            confirmPass: "",
            errorMap : ErrorMap,
            error: {
                status: false,
                code: ''
            }
        }
    },
    methods: {
        clickCreate() {
            let payload = {
                name: this.name,
                email : this.email,
                password: this.password,
                confirmPass: this.confirmPass
            }

            let context = this
            /**
             * @type {Promise}
             */
            let api = UserApi.register(payload)
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
                context.error.code = code
            })
        }
    }
}
</script>