<template>
  <div class="InvoiceView">
    <NavSignedIn v-on:logout="$emit('logout')" v-bind:user="user" />
    <div class="uk-padding">
      <InvoiceViewPage class = "uk-container uk-align-center"  v-bind:user="user" v-bind:child_info="child_info" v-bind:invoice_info="invoice_info.records" v-bind:object="invoice_object"/>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import NavSignedIn from '@/components/NavSignedIn.vue';
import InvoiceViewPage from '@/components/InvoiceViewPage.vue';
import UIkit from 'uikit';
import axios from 'axios';

export default {
  name: 'InvoiceView',
  components: {
    NavSignedIn,
    InvoiceViewPage
  },
  props: {
    authenticated: Boolean,
    user: Object,
    invoice_object: Object
  },
  mounted() {
    this.$emit('check-auth-page');
  },
  data() {
    return {
      child_info: Object,
      invoice_info: Object
    }
  },
  created() {

    axios.get('http://www.fizzlab.xyz:86/api/api.php/records/child_information?filter=fp_id,eq,'+this.user.user_id)
    .then(res => {
      this.child_info = res.data;   
      })
    .catch(err => console.log(err));

    axios.get('http://www.fizzlab.xyz:86/api/api.php/records/invoice_information?filter=invoice_id,eq,'+this.invoice_object.id)
    .then(res => {
      this.invoice_info = res.data;   
      })
    .catch(err => console.log(err));
  }
}
</script>

<style scoped>

</style>
