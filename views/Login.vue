<template>
  <div class="Login">
    <Nav v-if="auth === false" />
    <NavSignedIn v-else v-on:logout="$emit('logout')" v-bind:user="user" />
    <div class="uk-padding">
      <div class="uk-padding-remove">
          <div class="uk-vertical-align uk-text-center uk-height-1-1">
              <h3>User Login</h3>
            <div class="uk-vertical-align-middle" style="width: 34%; margin-left: 33%; text-align: center;">
              <LoginPage v-on:user-login="loginValidate" />
            </div>
          </div>
        </div>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import Nav from '@/components/Nav.vue'
import NavSignedIn from '@/components/NavSignedIn.vue'
import LoginPage from '@/components/LoginPage.vue'

export default {
  name: 'Login',
  components: {
    Nav,
    NavSignedIn,
    LoginPage
  },
  props: {
    auth: Boolean,
    user: Object,
  },
  methods: {
    loginValidate(formData){
        this.$emit("login-validate", formData);
    }
  }
}
</script>