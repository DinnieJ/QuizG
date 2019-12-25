import Api from './index'

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
                    collections: collections
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
            collection.id = i
            collections.push(collection)
        }

        return new Promise(function(resolve, reject) {
            resolve({
                status: 200,
                data: {
                    collections: collections
                }
            })
        })
    },
    getCollectionById(payload) {
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
                    collection: collection
                }
            })
        })
    }
}