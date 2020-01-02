<template>
<tr>
    <th scope="row">
        {{ user.id }}
    </th>
    <td class="">
        <a :href="`/users/${user.id}`">
            {{ user.name }}
        </a>
    </td>
    <td class="">{{ user.email }}</td>
</tr>
</template>

<script>
export default {
    props: {
        user: Object
    }
}
</script>