export default {
    getQuizzesByGame(collectionId) {
        let quiz = {
            id: 0,
            content: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
            user: {
                id: 1,
                name: 'user 1'
            },
            correct_answer_id: 1,
            time: 10,
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

        for(let i = 0; i < 3; i++) {
            let tmp = {}
            Object.assign(tmp, quiz)
            tmp.content = i + "-" + tmp.content
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
}