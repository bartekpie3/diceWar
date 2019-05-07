<template>
    <div>
        <img style="position: relative; top: -120px; left: -200px;" src="/img/galaxy-1.jpg"/>

        <nuxt-link
                :to="{ name: 'game-location-id', params: { id: location.id } }"
                v-for="location of locations"
                class="world-map-location"
                v-bind:style="{ top: location.y + 'px', left: location.x + 'px' }"
                v-bind:title="location.name"
        >
        </nuxt-link>
    </div>
</template>

<script>
    export default {
        name: "world-map",
        data () {
            return {
                locations: this.$store.getters['location/getAll']()
            }
        }
    }
</script>

<style scoped>
    .world-map-location {
        position: absolute;
        width: 25px;
        height: 25px;
        border-radius: 100%;
        background: white;
        -webkit-animation: moveUpDown 1s infinite  alternate;
        animation: moveUpDown 1s infinite  alternate;
    }

    @-webkit-keyframes moveUpDown {
        0% { transform: translateY(0); }
        100% { transform: translateY(-10px); }
    }
    @keyframes moveUpDown {
        0% { transform: translateY(0); }
        100% { transform: translateY(-10px); }
    }
</style>
