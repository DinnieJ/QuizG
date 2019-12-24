import axios from '@nuxtjs/axios'

export const state = () => {
    const data = {
        demo : 1
    }
    return data
}

export const actions = {
    DEMO_ACTION() {
        console.log('axios', axios)
    }
}