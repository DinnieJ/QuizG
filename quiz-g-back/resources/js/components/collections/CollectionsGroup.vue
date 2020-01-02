<template>
<table class="table">
    <thead class="thead-light">
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">User</th>
    </tr>
    </thead>
    <tbody>
        <template v-for="(item, i) in collections">
            <collection-row :collection="item" :key="`collection-${i}`" />
        </template>
    </tbody>
</table>
</template>

<script>
import CollectionRow from './CollectionRow'
export default {
    components:{
        CollectionRow
    },
    props:{
    },
    data() {
        return {
            collections: [],
        }
    },
    methods: {

    },
    created() {
        let collection = {
            id: -1,
            name: "Collection ",
            user: {
                id: 0,
                name: "User "
            }
        }

        for(let i = 0; i < 10; i++) {
            let tmp = {}
            Object.assign(tmp, collection)
            tmp.id = i,
            tmp.name += i
            tmp.user.name += i
            this.collections.push(tmp)
        }
    }
}
</script>