export default { 
    SET_QUIZZES(state, quizzesList) {
        state.quizzes = quizzesList
    },
    SET_CURRENT_QUIZ(state, quiz) {
        state.currentQuiz = quiz
    }
}