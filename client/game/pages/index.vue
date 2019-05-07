<template>
  <h1>Hello world! {{ name }}</h1>
</template>

<script>
  export default {
    async asyncData (context) {
      return { name: 'World' }
    }
  }
</script>
