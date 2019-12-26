<template>
<div class="container mb-3">
    <div class="row discover-nav py-2">
        <div class="col-6 d-flex flex-row">
            <div class="mr-4">
              <h3 class="font-lobster creator-name">
                {{ user.name }}
              </h3>
            </div>
            <button 
              v-if="!addQuiz"
              :class="activeTab == 'Collections' ? 'btn mr-2 btn-primary' : 'btn mr-2 btn-outline-primary'"
              @click="clickLink('collections')"
            >Collections</button>
            <button 
              v-if="!addQuiz"
              :class="activeTab == 'Quizzes' ? 'btn mr-2 btn-primary' : 'btn mr-2 btn-outline-primary'"
              @click="clickLink('quizzes')"
            >Quizzes</button>
            <button
                v-if="home || !addQuiz"
                :class="activeTab == 'History' ? 'btn btn-primary' : 'btn btn-outline-primary'"
                @click="clickLink('history')"
            >History</button>
        </div>
        <div class="col-6 d-flex flex-row-reverse">
          <button class="btn btn-outline-danger" v-if="addQuiz" @click="clickCancel()" >Cancel</button>
          <button class="btn btn-outline-warning" v-if="(activeTab == 'Quizzes')" @click="clickAddQuiz()" >Add Quiz</button>
          <button class="btn btn-outline-success mr-2" v-if="(activeTab == 'Quizzes')" @click="clickCreateQuiz()" >Create Quiz</button>
          <button class="btn btn-outline-success" v-if="(activeTab == 'Collections')" @click="clickCreateCollection()" >Create Collection</button>
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
        activeTab: String,
        addQuiz: {
          type: Boolean,
          default: false
        }
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
    },
    methods: {
      clickAddQuiz() {
        this.$router.push({
          path: '/home/collections/add'
        })
      },
      clickCancel() {
        this.$router.go(-1)
      },
      clickCreateQuiz() {
        this.$router.push({
          path: '/quiz/create'
        })
      },
      clickCreateCollection() {
        this.$router.push({
          path: '/collection/create'
        })
      }
    }
}
</script>