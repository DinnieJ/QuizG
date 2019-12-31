import Caller from './caller'

let buidler = {
    /**
     * @param {String} model : name of model that api used for
     */
    build(model) {
        let api = {
            getAll(token) {
                return Caller({token}).get(`/${model}`)
            },
            getByUser(token, userId = '') {
                return Caller({token}).get(`/${model}/user/${userId}`)
            },
            getById(token, id) {
                return Caller({token}).get(`/${model}/${id}`)
            },
            getById(token, id) {
                return Caller({token}).get(`/${model}/${id}`)
            },
            create(token, payload) {
                return Caller({token}).post(`/${model}/add`, payload)
            },
            update(token, id, payload) {
                return Caller({token}).put(`/${model}/${id}`, payload)
            },
            delete(token, id) {
                return Caller({token}).delete(`/${model}/${id}`)
            }
        }

        if(model === 'auth') {
            api.login = function(payload) {
                return Caller().post('/auth/login', payload)
            }
            api.register = function(payload) {
                return Caller().post('/auth/register', payload)
            }
            api.logout = function(token) {
                return Caller({token}).post('/auth/logout')
            }
        }

        if(model === 'collections') {
            api.addQuizzes = function(token, id, payload) {
                return Caller({token}).put(`/collections/${id}/add`, payload)
            }
            api.removeQuizzes = function(token, id, payload) {
                return Caller({token}).put(`/collections/${id}/remove`, payload)
            }
        }

        if(model === 'test') {
            api.submit = function(token, payload) {
                return Caller({token}).post(`/test/submit`, payload)
            }
        }

        if(model === 'game') {
            api.grading = function(token, payload) {
                return Caller({token}).post(`/game/grading`, payload)
            }
        }

        return api
    }
}

export default buidler