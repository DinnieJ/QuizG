<template>
<b-card class="quiz-card mb-3 col-sm-6">
    <b-card-body>
        <div class="d-flex" v-if="selectable">
             <b-form-checkbox
                v-model="select"
            >
                #{{ index }}
            </b-form-checkbox>
   
            <a :href="`/creator/${quiz.user.id}/quizzes`" class="ml-2" v-if="creatorShow">
                {{ quiz.user.name }}
            </a>
        </div>
        <b-card-sub-title v-else>
            <span>#{{ index }}</span>
            <a :href="`/creator/${quiz.user.id}/quizzes`" class="ml-2" v-if="creatorShow">
                {{ quiz.user.name }}
            </a>
        </b-card-sub-title>
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
        },
        creatorShow: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            select: false
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