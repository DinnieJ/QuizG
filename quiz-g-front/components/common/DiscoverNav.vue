<template>
<div class="container mb-3">
    <div class="row discover-nav py-2">
        <div class="col-3 d-flex flex-row">
            <button 
                :class="activeTab == 'Collections' ? 'btn mr-2 btn-primary' : 'btn mr-2 btn-outline-primary'"
                @click="clickLink('collections')"
            >Collections</button>
            <button 
                :class="activeTab == 'Quizzes' ? 'btn btn-primary' : 'btn btn-outline-primary'"
                @click="clickLink('quizzes')"
            >Quizzes</button>
        </div>
        <div class="col-7 row">
            <div class="col-1">
                <img src="/search.png" class="search-icon" @click="enterSearch()">
            </div>
            <b-input-group class="col-11">
                <b-form-input v-model="searchContent" @change="enterSearch()"></b-form-input>
                <template v-slot:append>
                    <b-dropdown :text="dropdown" variant="info" class="text-capitalize">
                        <b-dropdown-item @click="choiceDropdown(activeTab)" >{{ activeTab }}</b-dropdown-item>
                        <b-dropdown-item @click="choiceDropdown('Creator')" >Creator</b-dropdown-item>
                    </b-dropdown>
                </template>
            </b-input-group>
        </div>
        <div class="col-2 d-flex flex-row-reverse" v-if="activeTab == 'Quizzes'">
            <button class="btn btn-outline-warning" @click="clickAddQuiz()">Add Quiz</button>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: {
        activeTab: {
            type: String,
            default: "Collections"
        }
    },
    data() {
        return {
            dropdown: "Collections",
            searchContent: ""
        }
    },
    methods: {
        choiceDropdown(dropdown) {
            this.dropdown = dropdown
        },
        clickLink(activeTab) {
            this.$router.push({
                path: '/discover/' + activeTab
            })
        },
        enterSearch() {
            let search = {
                content: this.searchContent,
                type: 1
            }
            if(this.dropdown == 'Creator') {
                search.type = 2
            }
            this.$emit('enter-search', search)
        },
        clickAddQuiz() {
            this.$router.push({
                path: '/home/collections/add'
            })
        },
    },
    created() {
        this.dropdown = this.activeTab
    }
}
</script>