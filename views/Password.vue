<template>
  <div class="users">
    <NavSignedIn v-on:logout="$emit('logout')" v-bind:user="user" />
    <div class="uk-padding-small">
      <div class="SettingsPage uk-grid">
        <SettingsSideBar/>
        <SettingsEditPassword
          v-bind:user="user"
          v-on:update-password="updatePassword" />
      </div>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import NavSignedIn from '@/components/NavSignedIn.vue';
import SettingsPage from '@/components/SettingsPage.vue';
import SettingsSideBar from '@/components/SettingsSideBar.vue';
import SettingsEditPassword from '@/components/SettingsEditPassword.vue';
import axios from 'axios';

export default {
  name: 'Settings',
  components: {
    NavSignedIn,
    SettingsSideBar,
    SettingsEditPassword
  },
  props: {
    auth: Boolean,
    user: Object,
  },
  mounted() {
    this.$emit('check-auth-page')
  },
  methods: {
    updatePassword(newPass) {
        console.log("updating user password");
        console.log(newPass);
        let obj = {password: newPass}
        let newPassJson = JSON.stringify(obj)
        axios.put(
                "http://www.fizzlab.xyz:86/api/api.php/records/users/"+this.user.user_id, 
                newPassJson, 
                {headers: {"Content-Type": "text/plain"}}
            )
            .then(res => console.log(res.data))
            .catch(e => console.log(err));
        this.user.password = newPass;
        var jsonToken = JSON.stringify({ username: this.user.username, password: newPass });
        localStorage.setItem('user', jsonToken)
        setTimeout(this.$router.replace({ name: "settings" }), 250)
        //this.$emit('login-validate', jsonToken)
        //this.$router.replace({ name: "settings" })
    }
  }
}
</script>
