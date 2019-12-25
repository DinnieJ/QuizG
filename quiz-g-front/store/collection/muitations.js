export default { 
    SET_COLLECTIONS(state, collectionsList) {
        state.collections = collectionsList
    },
    SET_CURRENT_COLLECTION(state, collection) {
        state.currentCollection = collection
    }
}