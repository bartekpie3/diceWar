<template>
    <div>
        <world-map/>
        <dialog-window/>
    </div>
</template>

<script>
    import WorldMap from '~/components/world-map';
    import DialogWindow from '~/components/dialog-window';

    export default {
        name: "game",
        layout: 'game',
        components: {
            'world-map': WorldMap,
            'dialog-window': DialogWindow
        }
    }
</script>

<style scoped>

</style>
