<template>
<div class="game-quizzes-group">
    <game-nav 
        :time="time"
        :totalTime="totalTime"
        @click-skip="clickSkip()"
    />
    <game-quiz-card 
        @click-answer="clickAnswer($event)"
        :quiz="quizzes[currentQuiz]"
    />
</div>
</template>

<script>
import GameNav from './GameNav'
import GameQuizCard from './GameQuizCard'

export default {
    components: {
        GameNav,
        GameQuizCard
    },
    props:{
        quizzes: Array,
        start: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            time: 0,
            totalTime: 0,
            clock: {},
            currentQuiz: 0,
            noQuizzes: 0,
            finish: false
        }
    },
    watch: {
        start: {
            deep: true,
            handler(value) {
                if(value) {
                    this.changeQuiz(this.quizzes[this.currentQuiz])
                    this.startClock()
                }
            }
        }
    },
    methods:{
        startClock() {
            var context = this
            context.clock = setInterval(function () {
                if(context.time == 1) {
                    context.clickSkip()
                }
                context.time--;
            }, 1000)
        },
        stopClock() {
            clearInterval(this.clock)
        },
        nextQuiz() {
            let index = this.currentQuiz + 1
            if(index >= this.noQuizzes) {
                this.finish = true
                this.stopClock()
                return
            }
            this.currentQuiz = index
            this.changeQuiz(this.quizzes[this.currentQuiz])            
        },
        clickAnswer(answerId) {
            let quiz = this.quizzes[this.currentQuiz]
            quiz.choiceAnswer = answerId,
            this.$emit('finish-quiz', quiz)
            this.nextQuiz()
        },
        clickSkip() {
            let quiz = this.quizzes[this.currentQuiz]
            this.$emit('finish-quiz', quiz)
            this.nextQuiz()
        },
        changeQuiz(quiz) {
            this.totalTime = quiz.time
            this.time = quiz.time
        }
    },
    created() {
        this.noQuizzes = this.quizzes.length
    }
}
</script>