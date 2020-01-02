<template>
<tr>
    <th scope="row">
        {{ collection.id }}
    </th>
    <td class="">
        <a :href="`/collections/${collection.id}`">
            {{ collection.name }}
        </a>
        
    </td>
    <td class="">
        <a :href="`/users/${collection.user.id}`">
            {{ collection.user.name }}
        </a>
    </td>
</tr>
</template>

<script>
export default {
    props: {
        collection: Object
    }
}
</script>