<template>
<div>
    <div>
        <user-nav 
            :active="active"
            :user="user"
            @click-tab="clickTab($event)"
        />
        <collections-group v-if="active === 'collections'"/>
        <quizzes-group v-if="active === 'quizzes'" />
        <histories-group v-if="active === 'history'" />
    </div>  
    
</div>
</template>

<script>
import UserNav from './UserNav'

export default {
    components: {
        UserNav
    },
    data() {
        return {
            active: 'collections',
            user: {
                id: 0,
                name: 'User'
            }
        }
    },
    methods: {
        clickTab(tab) {
            this.active = tab
        }
    }
}
</script>