<template>
<tr>
    <th scope="row">
        <a :href="`/collections/${history.collection.id}`">
            {{ history.collection.name }}
        </a>
        
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
</tr>
</template>

<script>
export default {
    props: {
        history: Object
    }
}
</script>