<template>
<b-card class="quiz-card mb-3 col-sm-6">
    <b-card-body>
            <b-form-checkbox
            v-if="selectable"
            v-model="quiz.select"
        >
            #{{ index }}
        </b-form-checkbox>
        <b-card-sub-title v-else :sub-title="'#' + index" />
        <b-card-text title-tag="div">
            <h4>
                {{ quiz.content }}
            </h4>
        </b-card-text>
        <div class="answers-table">
            <template v-for="(item, i) in quiz.answers">
                <answer-row :answer="item" :index="i"  :key="i + '-' + randomId()"/>
            </template>
            
        </div>
    </b-card-body>
</b-card>
</template>

<script>
import AnswerRow from './AnswerRow'

export default {
    components: {
        AnswerRow
    },
    props: {
        index: [Number, String],
        quiz: Object,
        selectable: {
            type: Boolean,
            default: false
        }
    },
    methods: {
        randomId() {
            var length = 6
            var result           = '';
            var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for ( var i = 0; i < length; i++ ) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }
    }
}
</script>