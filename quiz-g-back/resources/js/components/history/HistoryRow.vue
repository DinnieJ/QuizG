<template>
<tr>
    <th scope="row" v-if="(history.collection !== null)">
        <a :href="`/collections/${history.collection.id}`">
            {{ history.collection.name }}
        </a>
        
    </th>
    <th scope="row" v-else>
        <p>Collection deleted</p>
    </th>
    <td class="">
        <a :href="`/users/${history.user.id}`">
            {{ history.user.name }}
        </a>
        
    </td>
    <td class="">
         {{ history.correct }}
    </td>
    <td class="">
         {{ history.total }}
    </td>
    <td class="">
         {{ history.type }}
    </td>
</tr>
</template>

<script>
export default {
    props: {
        history: Object
    }
}
</script>