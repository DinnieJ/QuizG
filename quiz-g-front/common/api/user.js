export default {
    /**
     * @param {Object} payload : payload for api
     * @param {String} payload.email : email to login
     * @param {String} payload.password : password to login
     * @returns {Promise}
     */
    login(payload) {
        // let api = Api().get
        return new Promise(function(resolve, reject) {
            resolve({
                status: 200,
                data: {
                    authen : "safafneafnafafaenfeanf"
                }
            })
            // reject({
            //     status: 400,
            //     data: {
            //         error : "auth-1"
            //     }
            // })
        })
    },
    register(payload) {
        return new Promise(function(resolve, reject) {
            // resolve({
            //     status: 200,
            //     data: {
            //         authen : "safafneafnafafaenfeanf"
            //     }
            // })
            reject({
                status: 400,
                data: {
                    error : "auth-5"
                }
            })
        })
    },
    getCurrentUser() {
        return new Promise(function(resolve, reject) {
            resolve({
                status: 200,
                data: {
                    user: {
                        id: 1,
                        name: "User 1"
                    }
                }
            })
        })
    }
}