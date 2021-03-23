<template>
    <div class="CountyLoginPage" uk-height-viewport="expand: true">   
        <div class="uk-panel uk-panel-box uk-form">
            <div class="uk-form-row uk-margin">
                <input class="uk-width-1-1 uk-form-large " v-bind:class="{'form-danger': this.hasError }" type="text" placeholder="Username" name="username" v-model="username" @keyup.enter="login()">
            </div>
            <div class="uk-form-row">
                <input class="uk-width-1-1 uk-form-large " v-bind:class="{'form-danger': this.hasError }" type="password" placeholder="Password" name="password" v-model="password" @keyup.enter="login()">
            </div>
            <div class="uk-form-row uk-margin">
                <button class="uk-width-1-1 uk-button uk-button-primary uk-button-large login-text-form" v-on:click="login()">Login</button>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import UIkit from 'uikit'

export default {
  name: 'CountyLoginPage',
  props: {
    msg: String
  },
  data: {
    hasError: false
  },
  methods: {
    login(){
        //var string = this.username+":"+this.password
        //var encodedString = btoa(string);

        //console.log(string);
        //console.log(encodedString);

        var jsonToken = JSON.stringify({ username: this.username, password: this.password });

        console.log(jsonToken);

        
        axios({
            method: 'post',
            url: 'http://www.fizzlab.xyz:86/api/login.php',
            data: jsonToken,
            config: { headers: {'Content-Type': 'multipart/form-data' }}
        })
        .then()
        .catch(err => this.formError());

        this.$emit('user-login', jsonToken)
    },
    formError() {
        this.hasError=true;
        UIkit.notification("Login Error.", {
            status: "danger"
        });
        console.log("login hasError: "+this.hasError)
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.form-danger {
    border: 1px solid salmon !important;
    background-color: blanchedalmond !important;
}
</style>
