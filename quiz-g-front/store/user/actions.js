export default {
    logout(context) {
        context.commit('LOGOUT')
        return true
    }
}