export default {
    getHistoryByUser(userId) {
        let history = {
            id: 1,
            collection: {
                id: 1,
                name: "collection 1"
            },
            total: 11,
            correct: 5,
            type: 'test',
            time: 10000,
            created_at: new Date().toISOString()
        }
        

        let histories = []

        for(let i = 0; i < 20; i++) {
            let tmp = {}
            Object.assign(tmp, history)
            tmp.id = i
            histories.push(tmp)
        }

        return new Promise(function(resolve, reject) {
            resolve({
                status: 200,
                data: {
                    histories: histories
                }
            })
        })
    }
}