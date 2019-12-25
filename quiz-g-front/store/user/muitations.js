export default { 
    AUTHENTICATE(state, authen) {
        state.authenToken = authen
    },
    LOGOUT(state) {
        state.authenToken = ''
    },
    ACTIVE_PAGE(state, page) {
        state.activePage = page
    }
}