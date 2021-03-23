<template>
  <div id="app" class="uk-padding-remove uk-container uk-container-medium">
    <div id="top">
      <h2 class="uk-heading uk-padding uk-padding-remove-bottom header-text">Hennepin County Foster Care Invoice System</h2>
    </div>

      <router-view 
        @authenticated="setAuthenticated" 
        v-on:login-validate="loginValidate"
        v-on:check-auth-page="checkForAuth" 
        v-on:check-cw-auth-page="checkForCwAuth" 
        v-on:check-admin-auth-page="checkForAdminAuth" 
        v-on:logout="logout" 
        v-bind:user="user"
        :auth="this.authenticated"
      />

  </div>
</template>

<script>
import UIkit from 'uikit'
import Icons from 'uikit/dist/js/uikit-icons'
import axios from 'axios'

UIkit.use(Icons);
export default {
  name: 'App',
  data() {
        return {
            authenticated: false,
            user: {},
            userData: String
        }
  },
  async mounted() {
    //console.log(this.authenticated)

    if(typeof localStorage.getItem('user') === "string"){
      let userLogin = JSON.parse(localStorage.getItem('user'))
      await axios.get('http://www.fizzlab.xyz:86/api/api.php/records/users?filter=username,eq,'+userLogin.username)
        .then((res) => {
          this.user = res.data.records[0]
          //this.userData = JSON.stringify(res.data.records[0])
        })            
        .catch(err => console.log(err))
    }
  },
  methods: {
        loginValidate(formData){
            console.log("Validating user")

            axios({
                method: 'post',
                url: 'http://www.fizzlab.xyz:86/api/login.php',
                data: formData,
                config: { headers: {'Content-Type': 'multipart/form-data' }}
            })
            .then(res => this.setupTokenStorage(formData, res))
            .catch(err => this.catchLoginError(err))
        },
        setupTokenStorage(userJson, resIn){
          localStorage.setItem('user', userJson)
          this.setAuthenticated(true)
          let userLogin = JSON.parse(userJson)
          axios.get('http://www.fizzlab.xyz:86/api/api.php/records/users?filter=username,eq,'+userLogin.username)
            .then((res) => {
              this.user = res.data.records[0]
              if(this.user.is_admin === 1){
                this.$router.replace({ name: "users" })
              } else if(this.user.is_cw === 1){
                this.$router.replace({ name: "cw-dashboard" })
              } else {
                this.$router.replace({ name: "dashboard" })
              }
              //this.userData = JSON.stringify(res.data.records[0])
            })            
            .catch(err => console.log(err))
        },
        setAuthenticated(status) {
            console.log("User authenticated: "+status)
            this.authenticated = status
        },
        loginRevalidate(formData){
            console.log("Validating user")
            axios({
                method: 'post',
                url: 'http://www.fizzlab.xyz:86/api/login.php',
                data: formData,
                config: { headers: {'Content-Type': 'multipart/form-data' }}
            })
            .then( 
              console.log("persistant login verified."),
              this.setAuthenticated(true),
              localStorage.setItem('user', formData),
              //this.getUserData(formData)
            )
            .catch(err => this.logout())
        },
        checkForAuth() {
            var localToken = localStorage.getItem('user')
            if( localToken != null ){
              this.loginRevalidate(localToken)
            }
            if( this.authenticated ) {
              // new login via authenticated variable
              console.log("logged in using auth variable")
            } else {
              this.$router.replace({ name: "login" })
            }
        },
        checkForCwAuth(){
            this.checkForAuth()
            if(this.user.is_admin === 1){
            } else if(this.user.is_cw === 0 && this.user.is_admin === 0){
              this.$router.replace({ name: "login" })
            }
        },
        checkForAdminAuth(){
            this.checkForAuth()
            if(this.user.is_admin === 0){
              this.$router.replace({ name: "login" })
            }
        },
        catchLoginError(err) {
            console.log(err)
            
        },
        logout() {
            console.log("Logging out user")
            this.setAuthenticated(false)
            localStorage.removeItem('user')
            this.user = {}
            this.$router.replace({ name: "home" })
        }
    }
};
</script>

<style lang="less">
@import "../node_modules/uikit/src/less/uikit.less";
@import "./assets/css/open-fonts.css";

html {
  background-color: #113c66;
  background-image: url("./assets/images/positive.png");
  background-repeat: repeat;
  font-family: "Open Sans", sans-serif !important;
  line-height: 1.5em;
  font-size: 1em;
}

#app {
  background: #fff;
}

.header-text {
  font-size: 1.9em;
  font-family: "Open Sans", sans-serif !important;
}
</style>
