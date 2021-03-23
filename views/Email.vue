<template>
  <div class="users">
    <NavSignedIn v-on:logout="$emit('logout')" v-bind:user="user" />
    <div class="uk-padding-small">
      <div class="SettingsPage uk-grid">
        <SettingsSideBar/>
        <SettingsEditEmail 
          v-bind:user="user"
          v-on:update-email="updateEmail" />
      </div>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import NavSignedIn from '@/components/NavSignedIn.vue';
import SettingsSideBar from '@/components/SettingsSideBar.vue';
import SettingsEditEmail from '@/components/SettingsEditEmail.vue';
import axios from 'axios';

export default {
  name: 'Settings',
  components: {
    NavSignedIn,
    SettingsSideBar,
    SettingsEditEmail
  },
  props: {
    auth: Boolean,
    user: Object,
  },
  mounted() {
    this.$emit('check-auth-page')
  },
  methods: {
    updateEmail(newEmail) {
        console.log("updating user email");
        console.log(newEmail);
        let obj = {email: newEmail}
        let newEmailJson = JSON.stringify(obj)
        let resCode = 0;
        axios.put(
                "http://www.fizzlab.xyz:86/api/api.php/records/users/"+this.user.user_id, 
                newEmailJson, 
                {headers: {"Content-Type": "text/plain"}}
            )
            .then(res => console.log(res.data))
            .catch(e => console.log(err));
        this.user.email = newEmail;
        this.$router.replace({ name: "settings" })
    }
  }
}
</script>
