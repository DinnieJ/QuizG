<template>
<table class="table">
    <thead class="thead-light">
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Content</th>
        <th scope="col">User</th>
    </tr>
    </thead>
    <tbody>
        <template v-for="(item, i) in quizzes">
            <quiz-row :quiz="item" :key="`collection-${i}`" />
        </template>
    </tbody>
</table>
</template>

<script>
import QuizRow from './QuizRow'
export default {
    components:{
        QuizRow
    },
    props:{
        quizzes:Array
    },
    methods: {

    },
    created() {
        // let quiz = {
        //     id: -1,
        //     content: "Quiz ",
        //     user: {
        //         id: 0,
        //         name: "User "
        //     }
        // }

        // for(let i = 0; i < 10; i++) {
        //     let tmp = {}
        //     Object.assign(tmp, quiz)
        //     tmp.id = i,
        //     tmp.content += i
        //     tmp.user.name += i
        //     this.quizzes.push(tmp)
        // }
    }
}
</script>