<template>
<tr>
    <th scope="row">
        {{ quiz.id }}
    </th>
    <td class="">
        <a :href="`/quizzes/${quiz.id}`">
            {{ quiz.content }}
        </a>
        
    </td>
    <td class="">
        <a :href="`/users/${quiz.user.id}`">
            {{ quiz.user.name }}
        </a>
    </td>
</tr>
</template>

<script>
export default {
    props: {
        quiz: Object
    }
}
</script>