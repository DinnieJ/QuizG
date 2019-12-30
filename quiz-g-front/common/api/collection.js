export default {
    /**
     * @returns {Promise}
     */
    getAllCollections() {
        let collection = {
            id: 0,
            name: "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
            user: {
                id: 1,
            name: 'user 1'
            }
        }

        let collections = []

        for(let i = 0; i < 20; i++) {
            let tmp = {}
            Object.assign(tmp, collection)
            tmp.id = i
            collections.push(tmp)
        }

        return new Promise(function(resolve, reject) {
            resolve({
                status: 200,
                data: {
                    collections: collections,
                }
            })
        })
    },
    getCollectionsByUser(userId) {
        let collection = {
            id: 0,
            name: "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
            user: {
                id: 1,
                name: 'user 1'
            }
        }

        let collections = []

        for(let i = 0; i < 20; i++) {
            let tmp = {}
            Object.assign(tmp, collection)
            tmp.id = i
            collections.push(tmp)
        }

        return new Promise(function(resolve, reject) {
            resolve({
                status: 200,
                data: {
                    collections: collections,
                    user: {
                        id: 1,
                        name: 'user 1'
                    }
                }
            })
        })
    },
    getCollectionById(collectionId) {
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
        let collection = {
            id: 0,
            name: "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
            user: {
                id: 1,
                name: 'user 1'
            }
        }
        return new Promise(function(resolve, reject) {
            resolve({
                status: 200,
                data: {
                    collection: collection,
                    quizzes: quizzes,
                    authorize: true
                }
            })
        })
    }
}