export default function ({ store, redirect }) {
    // If the user is not authenticated
    let authenToken = store.getters['user/authenToken']
    let check = Boolean(authenToken && authenToken.length > 0)
    if (!check) {
      return redirect('/login')
    }
  }