<template>
  <div class="Settings">
    <NavSignedIn v-on:logout="$emit('logout')" v-bind:user="user" />
    <div class="uk-padding-small">
      <div class="SettingsPage uk-grid">
        <SettingsSideBar/>
        <SettingsAccountInfo 
          v-bind:user_info="user_info"
          v-bind:user="user" />
      </div>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import NavSignedIn from '@/components/NavSignedIn.vue';
import SettingsSideBar from '@/components/SettingsSideBar.vue';
import SettingsAccountInfo from '@/components/SettingsAccountInfo.vue';
import axios from 'axios';

export default {
  name: 'Settings',
  components: {
    NavSignedIn,
    SettingsSideBar,
    SettingsAccountInfo
  },
  props: {
    auth: Boolean,
    user: Object,
  },
  mounted() {
    this.$emit('check-auth-page');
  },
  data() {
    return {
      user_info: []
    }
  },
  created() {
    if(typeof this.user.user_id !== "undefined"){
        axios.get('http://www.fizzlab.xyz:86/api/api.php/records/user_information/'+this.user.info_id)
          .then(res => this.user_info = res.data)
          .catch(err => console.log(err));
        localStorage.setItem('user_info', this.user_info)
    }else{
        console.log("waiting")
        setTimeout(this.waitForUser, 250)
    }
  },
  methods: {
    waitForUser(){
      if(typeof this.user.user_id !== "undefined"){
        axios.get('http://www.fizzlab.xyz:86/api/api.php/records/user_information/'+this.user.info_id)
          .then(res => this.user_info = res.data)
          .catch(err => console.log(err));
      }else{
        console.log("waiting")
          setTimeout(this.waitForElement, 250)
      }
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
