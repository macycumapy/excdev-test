<template>
  <form
      @submit.prevent="login"
      class="form-horizontal w-50 m-auto mt-4"
  >
    <div class="form-floating">
      <input v-model="username" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
      <input v-model="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <button class="w-100 btn btn-lg btn-primary mt-4" type="submit">Sign in</button>
  </form>
</template>

<script>
export default {
  name: 'Login',
  data() {
    return {
      username: '',
      password: '',
    };
  },
  methods: {
    login() {
      this.$store.dispatch('login', {
        email: this.username,
        password: this.password,
      });
    },
  },
};
</script>
