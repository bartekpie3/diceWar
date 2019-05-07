<template>
    <div>
        test
    </div>
</template>

<script>
    export default {
        name: "location",
        transition: 'bounce',
        validate ({ params }) {
            return /^\d+$/.test(params.id)
        },
        data () {
            return {
                id : this.$route.params.id
            }
        },
        methods: {
            getMap (id) {
                return require('~/static/img/location/location_' + id + '.jpg');
            }
        }
    }
</script>

<style scoped>

</style>
