<template>
<table class="table">
    <thead class="thead-light">
    <tr>
        <th scope="col">Collection</th>
        <th scope="col">Correct</th>
        <th scope="col">Test time</th>
        <th scope="col">Submitted at</th>
        <th scope="col">Type</th>
    </tr>
    </thead>
    <tbody>
        <HistoryRow v-for="(item, i) in histories" :key="i" :history="item" />
    </tbody>
</table> 
</template>

<script>
import HistoryRow from './HistoryRow'

export default {
    components: {
        HistoryRow
    },
    props: {
        histories: Array
    }
}
</script>