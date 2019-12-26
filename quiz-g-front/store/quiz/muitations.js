export default { 
    SET_QUIZZES(state, quizzesList) {
        state.quizzes = quizzesList
    },
    SET_CURRENT_QUIZ(state, quiz) {
        state.currentQuiz = quiz
    },
    RESET_SELECTED_QUIZZES(state) {
        state.selectedQuizzes = []
    },
    ADD_SELECTED_QUIZ(state, quiz) {
        state.selectedQuizzes.push(quiz)
    },
    REMOVE_SELECTED_QUIZ(state, quiz) {
        let quizzesList = state.selectedQuizzes
        let index = -1
        for(let i = 0; i < quizzesList.length; i++) {
            if(quizzesList[i].id == quiz.id) {
                index = i
            }
        }
        if(index != -1) {
            state.selectedQuizzes.splice(index, 1)
        }
    }
}