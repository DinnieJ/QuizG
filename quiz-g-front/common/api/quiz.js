import Api from './index'

export default {
    /**
     * @returns {Promise}
     */
    getAllQuizzes() {
        let quiz = {
            id: 0,
            content: "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
            user: {
                id: 1,
                name: 'user 1'
            },
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
                    id: 3,
                    content: "Answer 3"
                },
                {
                    id: 4,
                    content: "Answer 4"
                },
            ]
        }

        let quizzes = []

        for(let i = 0; i < 20; i++) {
            let tmp = {}
            Object.assign(tmp, quiz)
            tmp.id = i
            quizzes.push(tmp)
        }

        return new Promise(function(resolve, reject) {
            resolve({
                status: 200,
                data: {
                    quizzes: quizzes,
                }
            })
        })
    },
    getQuizzesByUser(userId) {
        let quiz = {
            id: 0,
            content: "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
            user: {
                id: 1,
                name: 'user 1'
            },
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
                    id: 3,
                    content: "Answer 3"
                },
                {
                    id: 4,
                    content: "Answer 4"
                },
            ]
        }

        let quizzes = []

        for(let i = 0; i < 20; i++) {
            let tmp = {}
            Object.assign(tmp, quiz)
            tmp.id = i
            quizzes.push(tmp)
        }

        return new Promise(function(resolve, reject) {
            resolve({
                status: 200,
                data: {
                    quizzes: quizzes,
                    user: {
                        id: 1,
                        name: 'User 1'
                    },
                }
            })
        })
    },
    getQuizzesByCollections(collectionId) {
        let quiz = {
            id: 0,
            content: "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
            user: {
                id: 1,
                name: 'user 1'
            },
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
                    id: 3,
                    content: "Answer 3"
                },
                {
                    id: 4,
                    content: "Answer 4"
                },
            ]
        }

        let quizzes = []

        for(let i = 0; i < 20; i++) {
            let tmp = {}
            Object.assign(tmp, quiz)
            tmp.id = i
            quizzes.push(tmp)
        }

        return new Promise(function(resolve, reject) {
            resolve({
                status: 200,
                data: {
                    quizzes: quizzes,
                    user: {
                        id: 1,
                        name: 'User 1'
                    },
                }
            })
        })
    },
    getQuizById(payload) {
        let quiz = {
            id: 0,
            content: "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
            user: {
                id: 1,
                name: 'user 1'
            },
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
                    id: 3,
                    content: "Answer 3"
                },
                {
                    id: 4,
                    content: "Answer 4"
                },
            ]
        }
        return new Promise(function(resolve, reject) {
            resolve({
                status: 200,
                data: {
                    quiz: quiz
                }
            })
        })
    }
}