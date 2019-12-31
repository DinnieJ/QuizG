export const state = function () {
    return {
        authenToken : '',
        activePage: 'home',
        currentUser: {
        }
    }
}

export const getters = {
    // authenToken : state => {
    //     let auth = state.authenToken
    //     return auth
    // },
    authenToken: state => state.authenToken,
    activePage: state => state.activePage,
    currentUser: state => state.currentUser
}

export const mutations = { 
    AUTHENTICATE(state, authen) {
        state.authenToken = authen
    },
    LOGOUT(state) {
        state.authenToken = ''
    },
    ACTIVE_PAGE(state, page) {
        state.activePage = page
    },
    SET_CURRENT_USER(state, user) {
        state.currentUser = user
    }
}

export const actions = {
    
}