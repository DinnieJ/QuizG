<template>
<table class="table">
    <thead class="thead-light">
    <tr>
        <th scope="col">Collection</th>
        <th scope="col">User</th>
        <th scope="col">Correct</th>
        <th scope="col">Total</th>
    </tr>
    </thead>
    <tbody>
        <template v-for="(item, i) in histories">
            <history-row :history="item" :key="`history-${i}`" />
        </template>
    </tbody>
</table>
</template>

<script>
import HistoryRow from './HistoryRow'
export default {
    components:{
        HistoryRow
    },
    props:{
    },
    data() {
        return {
            histories: [],
        }
    },
    methods: {

    },
    created() {
        let history = {
            id: -1,
            collection: {
                id: 1,
                name: "Collections"
            },
            user: {
                id: 0,
                name: "User "
            },
            correct: 10,
            total : 20
        }

        for(let i = 0; i < 10; i++) {
            let tmp = {}
            Object.assign(tmp, history)
            tmp.id = i,
            tmp.user.name += i
            this.histories.push(tmp)
        }
    }
}
</script>