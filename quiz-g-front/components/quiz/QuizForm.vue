<template>
<div class="container p-3 quiz-form">
    <div class="row mb-2">
        <div class="col-2 d-flex">
            <h5 class="mr-2 quiz-form-time-title">
                Time
            </h5>
            <select class="custom-select custom-select-sm" v-model="time">
                <option value="20">20s</option>
                <option value="40">40s</option>
                <option value="60">1m</option>
                <option value="80">1m20s</option>
                <option value="100">1m40s</option>
                <option value="120">2m</option>
            </select>
        </div>
    </div>
    <b-form-textarea
      v-model="content"
      placeholder="Enter content..."
      rows="5"
      max-rows="8"
      size="lg"
    ></b-form-textarea>
    <error-alert 
        :show="error.status" 
        :message="error.message" 
    />
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
        <button class="btn btn-primary mr-2" v-if="edit" @click="clickEdit()">Edit</button>
        <button class="btn btn-primary mr-2" v-else @click="clickCreate()">Create</button>
        <button class="btn btn-warning" @click="clickCancel()">Cancel</button>
    </div>
</div>
</template>

<script>
import ErrorAlert from '~/components/common/ErrorAlert'

export default {
    components: {
        ErrorAlert
    },
    props: {
        quiz: {
            type: [Boolean, Object],
            default: false
        },
        edit: {
            type: [Boolean],
            default: false
        },
        collectionId: {
            default: undefined
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
            },
            time: 20
        }
    },
    methods:{
        choiceAnswer(index) {
            this.correct = index
        },
        clickCancel() {
            this.$router.go(-1)
        },
        clickCreate() {
            if(this.correct < 0) {
                return
            }

            let payload = {
                content: this.content,
                time: this.time,
                answers: [],
                collection_id: this.collectionId
            }

            for(let i = 0; i < 4; i++) {
                if(this.answersContent[i].length > 0) {
                    let  answer = {
                        content: this.answersContent[i],
                        correct: Boolean(i === this.correct)
                    }
                    payload.answers.push(answer)
                }
            }
            console.log('click-create', payload)
            this.$emit('click-create', payload)
        },
        clickEdit() {
            if(this.correct < 0) {
                return
            }

            let payload = {
                id: this.quiz.id,
                content: this.content,
                time: this.time,
                answers: [],
            }

            for(let i = 0; i < 4; i++) {
                if(this.answersContent[i].length > 0) {
                    let  answer = {
                        content: this.answersContent[i],
                        correct: Boolean(i === this.correct)
                    }
                    payload.answers.push(answer)
                }
            }
            console.log('click-edit', payload)
            this.$emit('click-edit', payload)
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