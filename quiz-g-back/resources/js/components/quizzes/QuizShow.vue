<template>
<div>
    <div class="my-3 p-2 item-nav">
        {{ quiz.content }}
    </div>
    <div>
        <table class="table">
            <thead class="thead-light">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Content</th>
                <th scope="col">Correct</th>
            </tr>
            </thead>
            <tbody>
                <template v-for="(item, i) in quiz.answers">
                    <answer-row 
                        :answer="item" 
                        :correct="(quiz.correct_answer_id === item.id)"
                        :key="i" 
                    />
                </template>
            </tbody>
        </table>
    </div>
</div>
</template>

<script>
import AnswerRow from './AnswerRow'

export default {
    components: {
        AnswerRow
    },
    data() {
        return {
            quiz: {
                content: "Conafafneaifnaeifhaehfaehfahfhaefhahchac",
                correct_answer_id: 1,
                answers: [
                    {
                        id: 1,
                        content: "Answer 1"
                    },
                    {
                        id: 2,
                        content: "Answer 2"
                    },
                    {
                        id: 2,
                        content: "Answer 3"
                    },
                ]
            }
        }
    }
}
</script>