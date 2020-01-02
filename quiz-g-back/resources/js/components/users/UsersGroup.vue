<template>
<table class="table">
    <thead class="thead-light">
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
    </tr>
    </thead>
    <tbody>
        <template v-for="(item, i) in users">
            <user-row :user="item" :key="`user-${i}`" />
        </template>
    </tbody>
</table>
</template>

<script>
import UserRow from './UserRow'
export default {
    components:{
        UserRow
    },
    props:{
    },
    data() {
        return {
            users: []
        }
    },
    methods: {

    },
    created() {
        let user = {
            id: -1,
            name: "User ",
            email: "user@abc."
        }

        for(let i = 0; i < 10; i++) {
            let tmp = {}
            Object.assign(tmp, user)
            tmp.id = i,
            tmp.name += i
            tmp.email += i
            this.users.push(tmp)
        }
    }
}
</script>