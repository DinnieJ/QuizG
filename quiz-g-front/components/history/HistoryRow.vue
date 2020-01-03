<template>
<tr>
    <th scope="row">
        <a>
            <span>
                {{ history.collection.name }}
            </span>
        </a>
    </th>
    <td class="">{{ history.correct }}/{{history.total}} ({{percent}}%)</td>
    <td class="">{{hour}}:{{minute}}:{{second}}</td>
    <td class="">{{ createdAt }}</td>
    <td class="text-uppercase">{{ history.type }}</td>
</tr>
</template>

<script>
export default {
    props: {
        history: Object
    },
    data() {
        return {
            hour: 0,
            minute: 0,
            second: 0,
            percent: 0,
            createdAt: {}
        }
    },
    created() {
        this.percent = parseInt(this.history.correct/this.history.total*100)
        let time = this.history.total_time
        this.hour = parseInt(time/3600)
        this.minute = parseInt((time - this.hour*3600)/60)
        this.second = time - this.hour*3600 - this.minute*60
        // this.createdString = this.history.created_at.split(/[- :]/);
        let date = new Date(this.history.created_at)
        this.createdAt = `${date.getDate()}/${date.getMonth() + 1}/${date.getUTCFullYear()}`
        console.log('history', this.createdAt)
    }
}
</script>