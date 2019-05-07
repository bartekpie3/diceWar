<template>
    <div class="dialog-window">
        <h3>Hello John</h3>
    </div>
</template>

<script>
    export default {
        name: "dialog-window"
    }
</script>

<style scoped>
    .dialog-window {
        position: absolute;
        bottom: 0;
        left: 10%;
        box-sizing: border-box;
        width: 80%;
        height: 25%;
        border-top: 1px solid rgba(255, 255, 255, 0.2);
        border-left: 1px solid rgba(255, 255, 255, 0.2);
        border-right: 1px solid rgba(255, 255, 255, 0.2);
        background: rgba(0, 0, 0, 0.6);
        color: white;
        padding: 15px;
    }
</style>
