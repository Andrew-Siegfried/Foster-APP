<template>
  <div class="CompletedInvoices">
    <NavSignedIn v-on:logout="$emit('logout')" v-bind:user="user" />
    <div class="uk-padding">
      <CompletedInvoicePage class = "uk-container uk-align-center"  v-bind:user="user" v-bind:invoice_info="incomplete_invoice_info"/>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import NavSignedIn from '@/components/NavSignedIn.vue';
import CompletedInvoicePage from '@/components/CompletedInvoicePage.vue';
import UIkit from 'uikit';
import axios from 'axios';

export default {
  name: 'CompletedInvoices',
  components: {
    NavSignedIn,
    CompletedInvoicePage
  },
  props: {
    authenticated: Boolean,
    user: Object,
  },
  mounted() {
    this.$emit('check-cw-auth-page')
  },
  data() {
    return {
      incomplete_invoice_info: []
    }
  },
  created() {
    if(typeof this.user.user_id !== "undefined"){
        axios.get('http://www.fizzlab.xyz:86/api/api.php/records/invoice_history?filter=state,eq,3&order=id,desc')
            .then(res => this.incomplete_invoice_info = res.data)
            .catch(err => console.log(err));
    }else{
        console.log("waiting")
        setTimeout(this.waitForUser, 250)
    }
    },
  methods: {
    waitForUser(){
        if(typeof this.user.user_id !== "undefined"){
        axios.get('http://www.fizzlab.xyz:86/api/api.php/records/invoice_history?filter=state,eq,3&order=id,desc')
            .then(res => this.incomplete_invoice_info = res.data)
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
