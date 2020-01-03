<template>
<div>
    <div>
        <user-nav 
            :active="active"
            :user="user"
            @click-tab="clickTab($event)"
        />
        <collections-group v-if="active === 'collections'" :collections="collections"/>
        <quizzes-group v-if="active === 'quizzes'" :quizzes="quizzes" />
        <histories-group v-if="active === 'history'" :histories="histories" />
    </div>  
    
</div>
</template>

<script>
import UserNav from './UserNav'

export default {
    components: {
        UserNav
    },

    props:{
        user:Object,
        collections:Array,
        quizzes:Array,
        histories:Array
    },
    data() {
        return {
            active: 'collections',
        }
    },
    methods: {
        clickTab(tab) {
            this.active = tab
        }
    }
}
</script>