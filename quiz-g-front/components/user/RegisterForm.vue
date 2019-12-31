<template>
<div class="form form-user">
    <h2 class="text-center form-header">Create Account</h2>
    <div>
        <div class="form-group">
            <label for="inputEmail" class="text-uppercase">Name</label>
            <input type="text" name="name" class="form-control" placeholder="" required v-model="name">
            <error-alert v-model="errorStatus" :message="errorMessage" />
        </div>
        <div class="form-group">
            <label for="inputEmail" class="text-uppercase">Email</label>
            <input type="email" name="email" class="form-control " placeholder="" required v-model="email">
            <error-alert v-model="errorStatus" :message="errorMessage" />
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1" class="text-uppercase">Password</label>
            <input type="password" name="password" class="form-control" placeholder="" required v-model="password">
            <error-alert v-model="errorStatus" :message="errorMessage" />
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
import ErrorAlert from '../common/ErrorAlert'

export default {
    layout: 'authLayout',
    components: {
        ErrorAlert
    },
    props: {
        value: {
            type: Boolean,
            default: false
        },
        errorMessage: String
    },
    data() {
        return {
            name: "",
            email: "",
            password: "",
            confirmPass: ""
        }
    },
     computed: {
        errorStatus: {
            get() {
                return this.value
            },
            set(value) {
                this.$emit('input', value)
            }
        }
    },
    methods: {
        clickCreate() {
            let payload = {
                name: this.name,
                email : this.email,
                password: this.password,
                password_confirmation: this.confirmPass
            }

            this.$emit('click-create', payload)
        }
    }
}
</script>