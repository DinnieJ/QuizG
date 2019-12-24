export default { 
    AUTHENTICATE(state, authen) {
        state.authenToken = authen
    },
    LOGOUT(state) {
        state.authenToken = ''
    }
}