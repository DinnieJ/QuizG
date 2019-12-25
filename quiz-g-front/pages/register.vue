<template>
<div class="form form-user">
    <h2 class="text-center form-header">Create Account</h2>
    <div>
        <div class="form-group">
            <label for="inputEmail" class="text-uppercase">Name</label>
            <input type="text" name="name" class="form-control" placeholder="" required v-model="name">
            <error-alert :show="error.status" :message="error.message" />
        </div>
        <div class="form-group">
            <label for="inputEmail" class="text-uppercase">Email</label>
            <input type="email" name="email" class="form-control " placeholder="" required v-model="email">
            <error-alert :show="error.status" :message="error.message" />
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1" class="text-uppercase">Password</label>
            <input type="password" name="password" class="form-control" placeholder="" required v-model="password">
            <error-alert :show="error.status" :message="error.message" />
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
            error: {
                status: false,
                message: ''
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
                context.error.message = e.data.error
            })
        }
    }
}
</script>