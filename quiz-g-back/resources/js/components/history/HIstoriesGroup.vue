<template>
<table class="table">
    <thead class="thead-light">
    <tr>
        <th scope="col">Collection</th>
        <th scope="col">User</th>
        <th scope="col">Correct</th>
        <th scope="col">Total</th>
        <th scope="col">Type</th>
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
        histories:Array
    },
    methods: {

    },
    created() {
        console.log(this.histories)
    }
}
</script>