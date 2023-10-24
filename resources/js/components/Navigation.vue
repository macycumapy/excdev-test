<template>
  <div>
    <template v-if="isAuthenticated">
      <router-link to="/">Главная</router-link>
      <router-link to="/operation-list">Операции</router-link>
      <a @click="logout" href="javascript:void(0);">Выйти</a>
    </template>
  </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex';

export default {
  name: 'Navigation',
  computed: {
    ...mapGetters(['isAuthenticated']),
  },
  methods: {
    ...mapActions(['logout']),
  },
}
</script>
