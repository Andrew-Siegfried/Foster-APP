<template>
  <div class="Address">
    <NavSignedIn v-on:logout="$emit('logout')" v-bind:user="user" />
    <div class="uk-padding-small">
      <div class="SettingsPage uk-grid">
        <SettingsSideBar/>
        <SettingsEditAddress  
          v-bind:user_info="user_info" 
          v-bind:user="user"
          v-on:update-user="updateUser" />
      </div>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import NavSignedIn from '@/components/NavSignedIn.vue';
import SettingsSideBar from '@/components/SettingsSideBar.vue';
import SettingsEditAddress from '@/components/SettingsEditAddress.vue';
import axios from 'axios';
import UIkit from 'uikit'

export default {
  name: 'Settings',
  components: {
    NavSignedIn,
    SettingsSideBar,
    SettingsEditAddress
  },
  data() {
    return {
      user_info: []
    }
  },
  props: {
    auth: Boolean,
    user: Object,
  },
  created() {
        axios.get('http://www.fizzlab.xyz:86/api/api.php/records/user_information/'+this.user.info_id)
        .then(res => this.user_info = res.data)
        .catch(err => console.log(err));
  },
  mounted() {
    this.$emit('check-auth-page')
  },
  methods: {
    updateUser(formData) {
        console.log("updating user_info");
        console.log(formData);
        axios.put(
                "http://www.fizzlab.xyz:86/api/api.php/records/user_information/"+this.user.info_id, 
                formData, 
                {headers: {"Content-Type": "text/plain"}}
            )
            .then(res => this.user_info = res.data)
            .catch(e => console.log(err));
        UIkit.notification("Updated Information", {
            status: 'success'
        });
        this.$router.replace({ name: "settings" })
    }
  }
}
</script>
