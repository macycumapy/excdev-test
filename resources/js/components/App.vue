<template>
  <div>
    <router-view></router-view>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
  name: 'App',
  computed: {
    ...mapGetters(['isAuthenticated']),
  },
}
</script>
