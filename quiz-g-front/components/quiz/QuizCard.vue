<template>
<b-card class="quiz-card mb-3 col-sm-6">
    <b-card-body>
        <div class="d-flex justify-content-between">
            <div class="d-flex" v-if="selectable">
                <b-form-checkbox
                    v-model="select"
                    @change="clickCheckbox()"
                >
                    #{{ index }} - Time : {{ timeString }}
                </b-form-checkbox>
    
                <a :href="`/creator/${quiz.user.id}/quizzes`" class="ml-2" v-if="creatorShow">
                    {{ quiz.user.name }}
                </a>
            </div>
            <b-card-sub-title v-else>
                <span>#{{ index }}  - Time : {{ timeString }}</span>
                <a :href="`/creator/${quiz.user.id}/quizzes`" class="ml-2" v-if="creatorShow">
                    Creator : {{quiz.user.name }}
                </a>
            </b-card-sub-title>
            <div class="d-flex" v-if="authorize" >
                <button class="btn btn-sm btn-primary mr-2" @click="clickEdit()">Edit</button>
                <button class="btn btn-sm btn-danger"  @click="clickDelete()">Delete</button>
            </div>
            
        </div>
        
        
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
        },
        authorize: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            select: false
        }
    },
    computed: {
        timeString() {
            let minutes = parseInt(this.quiz.time/60)
            let seconds = this.quiz.time - minutes*60
            let result = ''
            if(minutes > 0) {
                result = minutes + 'm'
            }
            result += seconds + 's'
            return result
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
        },
        clickCheckbox() {
            if(!this.select) {
                this.$store.commit('quiz/ADD_SELECTED_QUIZ', this.quiz)
            } else {
                this.$store.commit('quiz/REMOVE_SELECTED_QUIZ', this.quiz)
            }
        },
        clickEdit() {
            this.$store.commit('quiz/SET_CURRENT_QUIZ', this.quiz)
            this.$router.push({
                path: `/quiz/${this.quiz.id}/edit`
            })
        },
        clickDelete() {
            this.$emit('click-delete', {
                id: this.quiz.id
            })
        }
    }
}
</script>