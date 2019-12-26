<template>
<div class="container mb-3">
    <div class="row discover-nav py-2">
        <div class="col-6 d-flex flex-row">
            <b-input-group>
                <b-form-input v-model="name" :disabled="!authorize && !createNew"/>
                <b-input-group-append v-if="authorize">
                    <b-button variant="primary">Edit</b-button>
                </b-input-group-append>
                <b-input-group-append v-if="createNew">
                    <b-button variant="success">Create</b-button>
                </b-input-group-append>
            </b-input-group>
        </div>
        <div class="col-6 d-flex flex-row-reverse">
            <button class="btn btn-outline-danger ml-2" v-if="authorize" >Delete</button>
            <button class="btn btn-outline-success ml-2" v-if="authorize" >New Quiz</button>
            <button class="btn btn-outline-warning" v-if="authorize" >Add Quiz to Another Collection</button>
            <button class="btn btn-outline-warning" v-if="!authorize && !createNew" >Add Quiz</button>
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

    },
    created() {
        if(this.collection) {
            this.name = this.collection.name
        }
    }
}
</script>