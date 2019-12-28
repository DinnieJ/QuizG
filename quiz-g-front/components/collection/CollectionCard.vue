<template>
    <transition mode="in-out">
        <b-card class="collection-card">
            <b-card-header
                header-tag="div"
                header-class="collection-card-header font-lobster"
            >
                <a v-if="!addQuiz" :href="`/collection/${collection.id}`">
                    {{collection.name}}
                </a>
                <a v-else>
                    {{collection.name}}
                </a>
            </b-card-header>
            <b-card-body>
                <b-card-title title-tag="a" :href="`/creator/${collection.user.id}/collections`" v-if="creatorShow" >
                    <h4 class="collection-card-creator">
                        {{ collection.user.name }}
                    </h4>
                </b-card-title>
                <div class="d-flex" v-if="!addQuiz">
                    <button class="btn mr-3 collection-card-btn test" @click="clickTest()">Test</button>
                    <button class="btn collection-card-btn play" @click="clickPlay()">Play</button>
                </div>
                <div class="d-flex" v-else>
                    <button class="btn collection-card-btn add" @click="clickPlay()">Add Quiz</button>
                </div>
            </b-card-body>
        
        </b-card>
    </transition>
 
</template>

<script>
export default {
    props: {
        collection: Object,
        creatorShow: {
            type: Boolean,
            default: false
        },
        addQuiz: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
        }
    },
    methods: {
        clickTest() {
            this.$router.push({
                path: `/test/${this.collection.id}`
            })
        },
        clickPlay() {
            console.log('clickPlay', this.collection)
            // this.$route.push({
            //     path: '/game/' + this.collection.id
            // })
        },
    }
}
</script>