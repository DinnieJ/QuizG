<template>
<div class="container p-3 quiz-form">
    <b-form-textarea
      v-model="content"
      placeholder="Enter content..."
      rows="5"
      max-rows="8"
      size="lg"
    ></b-form-textarea>
    <hr class="hor-divider" />
    <div class="row mb-2">
        <div class="col-sm-6">
            <div class="row px-2 mb-2">
                <div class="col-1" @click="choiceAnswer(0)" >
                    <div :class="'col-1 answer-index ' + (correct == 0 ? 'answer-active-0' : 'answer-0')">
                        A
                    </div>
                </div>
                <div class="col-11">
                    <b-form-textarea
                        v-model="answersContent[0]"
                        placeholder="Enter answer..."
                        rows="2"
                        max-rows="5"
                    ></b-form-textarea>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="row px-2 mb-2">
                <div class="col-1" @click="choiceAnswer(1)">
                    <div :class="'col-1 answer-index ' + (correct == 1 ? 'answer-active-1' : 'answer-1')">
                        B
                    </div>
                </div>
                <div class="col-11">
                    <b-form-textarea
                        v-model="answersContent[1]"
                        placeholder="Enter answer..."
                        rows="2"
                        max-rows="5"
                    ></b-form-textarea>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="row px-2">
                <div class="col-1" @click="choiceAnswer(2)">
                    <div :class="'col-1 answer-index ' + (correct == 2 ? 'answer-active-2' : 'answer-2')">
                        C
                    </div>
                </div>
                <div class="col-11">
                    <b-form-textarea
                        v-model="answersContent[2]"
                        placeholder="Enter answer..."
                        rows="2"
                        max-rows="5"
                    ></b-form-textarea>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="row px-2">
                <div class="col-1" @click="choiceAnswer(3)">
                    <div :class="'col-1 answer-index ' + (correct == 3 ? 'answer-active-3' : 'answer-3')">
                        D
                    </div>
                </div>
                <div class="col-11">
                    <b-form-textarea
                        v-model="answersContent[3]"
                        placeholder="Enter answer..."
                        rows="2"
                        max-rows="5"
                    ></b-form-textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex">
        <button class="btn btn-primary mr-2" v-if="edit" >Edit</button>
        <button class="btn btn-primary mr-2" v-else >Create</button>
        <button class="btn btn-warning" @click="clickCancel()">Cancel</button>
    </div>
</div>
</template>

<script>
export default {
    props: {
        quiz: {
            type: [Boolean, Object],
            default: false
        },
        edit: {
            type: [Boolean],
            default: false
        }
    },
    data() {
        return {
            content: "",
            correct: -1,
            answersContent: [
                "", "", "", ""
            ],
            error: {
                status: false,
                message: ""
            }
        }
    },
    methods:{
        choiceAnswer(index) {
            this.correct = index
        },
        clickCancel() {
            this.$router.go(-1)
        }
    },
    created() {
        if(this.edit) {
            this.content = this.quiz.content
            let answersList = this.quiz.answers
            for(let i = 0; i < answersList.length; i++) {
                this.answersContent[i] = answersList[i].content
                if(answersList[i].correct) {
                    this.correct = i
                }
            }
        }
    }
}
</script>