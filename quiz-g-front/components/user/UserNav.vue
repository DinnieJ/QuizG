<template>
<div class="container mb-3">
    <div class="row discover-nav py-2">
        <div class="col-6 d-flex flex-row">
            <div class="mr-4">
              <h3 class="font-lobster creator-name">
                User 1
              </h3>
            </div>
            <button 
                :class="activeTab == 'Collections' ? 'btn mr-2 btn-primary' : 'btn mr-2 btn-outline-primary'"
                @click="clickLink('collections')"
            >Collections</button>
            <button 
                :class="activeTab == 'Quizzes' ? 'btn mr-2 btn-primary' : 'btn mr-2 btn-outline-primary'"
                @click="clickLink('quizzes')"
            >Quizzes</button>
            <button 
                v-if="home"
                :class="activeTab == 'History' ? 'btn btn-primary' : 'btn btn-outline-primary'"
                @click="clickLink('history')"
            >History</button>
        </div>
        <div class="col-6 d-flex flex-row-reverse">
            <button class="btn btn-outline-warning" v-if="activeTab == 'Quizzes'">Add Quiz</button>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props:{
        home: {
            type: Boolean,
            default: false
        },
        user: Object,
        activeTab: String
    },
    data() {
        return {
          clickLink(activeTab) {
            let url = ""
            if(this.home) {
              url = '/home/'
            } else {
              url = `/creator/${this.user.id}/`
            }
            this.$router.push({
                path: url + activeTab
            })
          }
        }
    }
}
</script>