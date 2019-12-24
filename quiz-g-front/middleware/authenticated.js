export default function ({ store, redirect }) {
    // If the user is not authenticated
    let authenToken = store.getters['user/authenToken']
    console.log('authenToken', authenToken)
    if (!authenToken) {
      return redirect('/login')
    }
  }