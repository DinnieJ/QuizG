<template>
<div class="test-quizzes-group">
    <div class="test-quizzes-group-header mb-2">
        <test-time :time="time"/>
    </div>
    <div class="test-quizzes-group-quizzes mb-1">
        <div class="row h-100">
            <div class="col-1 d-flex align-items-center">
                <div class="mx-auto">
                    <div class="btn-circle text-center" v-if="currentQuiz > 0" @click="clickMove(-1)">
                        &#60;
                    </div>
                </div>
            </div>
            <div class="col-10">
                <test-quiz-card 
                    :quiz="quizzes[currentQuiz]" 
                    :index="currentQuiz"
                    @unanswer-quiz="unanswerQuiz($event)"
                    @answer-quiz="answerQuiz($event)"
                />
            </div>
            <div class="col-1 d-flex align-items-center">
                <div class="mx-auto">
                    <div class="btn-circle text-center" v-if="currentQuiz < (noQuizzes - 1)" @click="clickMove(1)">
                        &#62;
                    </div>
                </div>
            </div>
        </div>
    </div>
  <div class="test-quizzes-group-footer">
        <div class="row px-2">
            <template v-for="(item, i) in quizzesLink">
                <div :key="'link-' + i" class="col mb-1">
                    <div 
                        :class="'text-center test-quiz-link ' + (item.answer ? 'answer ' : '') + (item.active ? 'active' : '')"
                        @click="clickLink(i)"
                    >{{ i + 1 }}</div>
                </div>
            </template>
        </div>
        <div class="container">
            <button class="btn btn-sm btn-info" @click="clickSubmit()">Submit</button>
        </div>  
        
    </div>
</div>
</template>

<script>
import TestTime from './TestTime'
import TestQuizCard from './TestQuizCard'

export default {
    components: {
        TestTime,
        TestQuizCard
    },
    props: {
        quizzes: Array,
        start: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            time: 0,
            clock: {},
            hours: 1,
            minutes: 1,
            seconds: 1,
            quizzesLink: [],
            currentQuiz: 0,
            noQuizzes: 0,
            clock: {}
        }
    },
    watch:{
        start: {
            deep: true,
            handler(value) {
                if(value) {
                    this.startClock()
                }
            }
        }
    }, 
    methods: {
        clickLink(index) {
            this.quizzesLink[this.currentQuiz].active = false
            this.currentQuiz = index
            this.quizzesLink[this.currentQuiz].active = true
        },
        clickMove(step) {
            this.quizzesLink[this.currentQuiz].active = false
            if(step === -1) {
                this.currentQuiz--
            } else {
                this.currentQuiz++
            }
            this.quizzesLink[this.currentQuiz].active = true
        },
        unanswerQuiz(i) {
            this.quizzesLink[this.currentQuiz].answer = false
        },
        answerQuiz(i) {
            this.quizzesLink[this.currentQuiz].answer = true
        },
         startClock() {
            var context = this
            context.clock = setInterval(function () {
                if(context.time == 1) {
                    context.clickSubmit()
                }
                context.time--;
            }, 1000)
        },
        stopClock() {
            clearInterval(this.clock)
        },
        clickSubmit() {
            this.stopClock()
        }
    },
    created() {
        this.noQuizzes = this.quizzes.length
        for(let i = 0; i < this.noQuizzes; i++) {
            this.quizzes[i].choice = -1
            this.time += this.quizzes[i].time
            this.quizzesLink.push({
                answer: false,
                active: false
            })
        }
        this.quizzesLink[0].active = true
    }
}
</script>