<template>
  <div class="home">
    <Nav v-if="auth === false" />
    <NavSignedIn v-else v-on:logout="$emit('logout')" v-bind:user="user" />
    <ImageSlider />
    <div class="uk-overlay uk-light uk-padding-medium uk-position-center text-over">
        <h1>Help a child, Heal a Family</h1>
    </div>
    <div class="uk-padding">
      <MainPage />
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import Nav from '@/components/Nav.vue'
import NavSignedIn from '@/components/NavSignedIn.vue';
import ImageSlider from '@/components/ImageSlider.vue'
import MainPage from '@/components/MainPage.vue'

export default {
  name: 'home',
  components: {
    Nav,
    NavSignedIn,
    ImageSlider,
    MainPage
  },
  props: {
    auth: Boolean,
    user: Object,
  }
}
</script>

<style scoped>

.text-over {
  background-color: rgba(0,0,0,.4);
  color: #fff !important;
  margin-top: -125px;
}

</style>
