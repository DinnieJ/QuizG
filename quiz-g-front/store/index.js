const cookieparser = process.server ? require('cookieparser') : undefined

export const state = () => {
    const data = {
    }
    return data
}

export const actions = {
    nuxtServerInit ({ commit }, { req }) {
        let authenToken = null
        let currentUser = null
        if(req.headers.cookie) {
            try {
                const parsed = cookieparser.parse(req.headers.cookie)
                authenToken = parsed.authenToken
                currentUser = parsed.currentUser
            }catch(e) {

            }
            commit('user/AUTHENTICATE', authenToken)
            commit('user/SET_CURRENT_USER', currentUser)
        }
    }
}