<template>
<tr>
    
    <th scope="row">
        {{ answer.id }}
    </th>
    <td class="">
        {{ answer.content }}
    </td>
    <td class="">

        {{ correct }}
    </td>
</tr>
</template>

<script>
export default {
    props: {
        answer: Object,
        correct: {
            type: Boolean,
            default: false
        }
    }
}
</script>