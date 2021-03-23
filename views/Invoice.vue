<template>
  <div class="Dashboard">
    <NavSignedIn v-on:logout="$emit('logout')" v-bind:user="user" />
    <div class="uk-padding">
      <InvoiceNewPage class = "uk-container uk-align-center"  v-bind:user="user" v-bind:child_info="child_info" v-bind:dateInfo="dateInfo" v-bind:monthNames="monthNames" v-bind:invoice_info="invoice_info" v-bind:invoice_num="invoice_num"/>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import NavSignedIn from '@/components/NavSignedIn.vue';
import InvoiceNewPage from '@/components/InvoiceNewPage.vue';
import UIkit from 'uikit';
import axios from 'axios';

export default {
  name: 'Dashboard',
  components: {
    NavSignedIn,
    InvoiceNewPage
  },
  props: {
    authenticated: Boolean,
    user: Object
  },
  mounted() {
    this.$emit('check-auth-page');
  },
  data() {
    return {
      child_info: [],
      dateInfo: Date,
      monthNames: [],
      invoice_info: [],
      invoice_num: Number
    }
  },
  created() {
      let dateInfo = new Date(); 
      let monthNames = ["January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
      ];
  
      this.dateInfo = dateInfo;
      this.monthNames = monthNames;
      this.invoice_num = 0;
      
        axios.get('http://www.fizzlab.xyz:86/api/api.php/records/child_information?filter=fp_id,eq,'+this.user.user_id)
        .then(res => {
          this.child_info = res.data; 
          let len = this.child_info.records.length;
          if(len > 0) 
          {
            let info = [];
            let i = 0;
            for (i = 0; i < len; i++) {
                let obj = {
                    invoice_id: 0,
                    client_id: this.child_info.records[i].id,
                    service_num: 430,
                    disc: "Child Foster Care",
                    date_from: "",
                    date_to: "",
                    units: 0,
                    rates: 0.0
                };
                info.push(obj);

                obj = {
                    invoice_id: 0,
                    client_id: this.child_info.records[i].id,
                    service_num: 746,
                    disc: "MAPCY",
                    date_from: "",
                    date_to: "",
                    units: 0,
                    rates: 0.0
                };
                info.push(obj);
            }
            this.invoice_info = info; 
          }
          else
          {
            UIkit.notification("No Assigned Foster Kids.", {
                status: "danger"
            });
            this.$router.replace({ name: "dashboard" });
          } 
          })
        .catch(err => console.log(err));
  }
}
</script>

<style scoped>

</style>
