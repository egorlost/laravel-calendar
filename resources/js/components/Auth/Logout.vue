<template>
  <span></span>
</template>

<script>
import auth from '../../api/auth'

export default {
  methods: {
    logout () {
      auth.logout()
    }
  },
  mounted () {
    this.logout()
  }
}
</script>

<style scoped lang="scss">
</style>
