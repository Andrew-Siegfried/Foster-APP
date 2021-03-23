<template>
  <div class="Dashboard">
    <NavSignedIn v-on:logout="$emit('logout')" v-bind:user="user" />
    <div class="uk-padding">
      <InvoiceManagePage class = "uk-container uk-align-center"  v-bind:user="user" v-bind:fp="fp" v-bind:fp_info="fp_info" v-bind:child_info="child_info" v-bind:invoice_info="invoice_info.records" v-bind:object="invoice_object"/>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import NavSignedIn from '@/components/NavSignedIn.vue';
import InvoiceManagePage from '@/components/InvoiceManagePage.vue';
import UIkit from 'uikit';
import axios from 'axios';

export default {
  name: 'Dashboard',
  components: {
    NavSignedIn,
    InvoiceManagePage
  },
  props: {
    authenticated: Boolean,
    user: Object,
    invoice_object: Object
  },
  mounted() {
    this.$emit('check-cw-auth-page');
  },
  data() {
    return {
      child_info: Object,
      invoice_info: Object,
      fp: Object,
      fp_info: Object
    }
  },
  created() {

    axios.get('http://www.fizzlab.xyz:86/api/api.php/records/child_information?filter=fp_id,eq,'+this.invoice_object.fp_id)
    .then(res => {
      this.child_info = res.data;   
      })
    .catch(err => console.log(err));

    axios.get('http://www.fizzlab.xyz:86/api/api.php/records/invoice_information?filter=invoice_id,eq,'+this.invoice_object.id)
    .then(res => {
      this.invoice_info = res.data;   
      })
    .catch(err => console.log(err));

    axios.get('http://www.fizzlab.xyz:86/api/api.php/records/users?filter=user_id,eq,'+this.invoice_object.fp_id)
    .then(res => {
      this.fp = res.data; 
      
      axios.get('http://www.fizzlab.xyz:86/api/api.php/records/user_information?filter=id,eq,'+this.fp.records[0].info_id)
    .then(res => {
      this.fp_info = res.data;   
      })
    .catch(err => console.log(err));
      })
    .catch(err => console.log(err));
  }
}
</script>

<style scoped>

</style>
