<template>
<div class="container mb-3">
    <div class="row discover-nav py-2">
        <div class="col-6 d-flex flex-row">
            <b-input-group>
                <b-form-input v-model="name" :disabled="!authorize && !createNew"/>
                <b-input-group-append v-if="authorize">
                    <b-button variant="primary" @click="clickEdit()">Edit</b-button>
                </b-input-group-append>
                <b-input-group-append v-if="createNew">
                    <b-button variant="success" @click="clickCreate()">Create</b-button>
                </b-input-group-append>
            </b-input-group>
        </div>
        <div class="col-6 d-flex flex-row-reverse">
            <button class="btn btn-sm btn-danger" v-if="createNew" @click="clickCancel()">Cancel</button>
            <b-dropdown size="sm" variant="link" toggle-class="text-decoration-none" no-caret dropleft v-else>
                <template v-slot:button-content>
                    &#9947;<span class="sr-only">Action</span>
                </template>
                <b-dropdown-group header="Actions">
                    <b-dropdown-item-button v-if="authorize" @click="clickDelete()">Delete</b-dropdown-item-button>
                    <b-dropdown-item-button v-if="authorize" @click="clickNewQuiz()">New Quiz</b-dropdown-item-button>
                    <b-dropdown-item-button v-if="authorize" @click="clickAddQuiz()">Add Quiz to Another Collection</b-dropdown-item-button>
                    <b-dropdown-item-button v-if="!authorize && !createNew" @click="clickAddQuiz()">Add Quiz</b-dropdown-item-button>
                </b-dropdown-group>
                <b-dropdown-divider></b-dropdown-divider>
                <b-dropdown-group header="Challenges">
                    <b-dropdown-item-button @click="clickTest()">Test</b-dropdown-item-button>
                    <b-dropdown-item-button @click="clickPlay()">Play</b-dropdown-item-button>
                </b-dropdown-group>
            </b-dropdown>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: {
        collection: {
            type: [Object, Boolean],
            default: false
        },
        authorize: {
            type: Boolean,
            default: false
        },
        createNew: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            name: ''
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
        clickNewQuiz() {
            this.$router.push({
                path: `/collection/${this.collection.id}/quizzes/create`
            })
        },
        clickTest() {
            this.$router.push({
                path: `/test/${this.collection.id}`
            })
        },
        clickPlay() {
            this.$router.push({
                path: `/game/${this.collection.id}`
            })
        },
        clickEdit() {
            this.$emit('click-edit', {
                id: this.collection.id,
                name: this.name
            })
        },
        clickCreate() {
            this.$emit('click-create', {
                name: this.name
            })
        },
        clickDelete() {
            this.$emit('click-delete', {
                id: this.collection.id,
            })
        }
    },
    created() {
        if(this.collection) {
            this.name = this.collection.name
        }
    }
}
</script>