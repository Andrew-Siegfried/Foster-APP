<template>
  <div class="Dashboard">
    <NavSignedIn v-on:logout="$emit('logout')" v-bind:user="user" />
    <div class="uk-padding">
      <DashboardPage class = "uk-container uk-align-center"  v-bind:user="user" v-bind:invoice_info="invoice_info"/>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import NavSignedIn from '@/components/NavSignedIn.vue';
import DashboardPage from '@/components/DashboardPage.vue';
import UIkit from 'uikit';
import axios from 'axios';

export default {
  name: 'Dashboard',
  components: {
    NavSignedIn,
    DashboardPage
  },
  props: {
    authenticated: Boolean,
    user: Object,
  },
  mounted() {
    this.$emit('check-auth-page');
  },
  data() {
    return {
      invoice_info: []
    }
  },
  created() {
    if(typeof this.user.user_id !== "undefined"){
        axios.get('http://www.fizzlab.xyz:86/api/api.php/records/invoice_history?filter=fp_id,eq,'+this.user.user_id+'&order=id,desc')
            .then(res => this.invoice_info = res.data)
            .catch(err => console.log(err));
    }else{
        console.log("waiting")
        setTimeout(this.waitForUser, 250)
    }
    },
  methods: {
    waitForUser(){
        if(typeof this.user.user_id !== "undefined"){
        axios.get('http://www.fizzlab.xyz:86/api/api.php/records/invoice_history?filter=fp_id,eq,'+this.user.user_id+'&order=id,desc')
            .then(res => this.invoice_info = res.data)
            .catch(err => console.log(err));
        }else{
        console.log("waiting")
            setTimeout(this.waitForUser, 250)
        }
    }
    }
}
</script>

<style scoped>

</style>
