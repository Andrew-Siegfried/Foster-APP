<template>
  <div class="about">
    <Nav v-if="auth === false" />
    <NavSignedIn v-else v-on:logout="$emit('logout')" v-bind:user="user" />
    <div class="uk-padding">
      <div class="AboutPage uk-grid">
        <div class="uk-width-1-6">
        </div>

        <AboutPage/>
        
        <div class="uk-width-1-6">
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import Nav from '@/components/Nav.vue';
import NavSignedIn from '@/components/NavSignedIn.vue';
import ImageSlider from '@/components/ImageSlider.vue';
import AboutPage from '@/components/AboutPage.vue';

export default {
  name: 'about',
  components: {
    Nav,
    NavSignedIn,
    ImageSlider,
    AboutPage
  },
  props: {
    auth: Boolean,
    user: Object,
  }
}
</script>
