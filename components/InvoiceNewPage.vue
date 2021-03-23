<template>
        <div class = "uk-width-expand" uk-height-viewport="expand: true">
            <div class="uk-grid">
                <div class = "uk-width-1-2 uk-margin-medium-top">
                    <h4><img style="width:32px;height:32px;" src="../assets/images/invoice-icon.svg" alt=""> {{monthNames[dateInfo.getMonth()]}} {{dateInfo.getFullYear()}} Invoice</h4>
                </div>
            </div>
            <h1 class="uk-width-expand uk-heading-divider uk-margin-small"></h1>
            <div class = "uk-width-expand">
                <table class="uk-table uk-table-striped">
                    <thead style="padding: 0px;">
                        <tr >
                            <th>Child Name</th>
                            <th>Description</th>
                            <th colspan="2">Service Dates</th>
                            <th>Units</th>
                            <th>Rates</th>
                            <th>Total</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>From</th>
                            <th>To</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class = "uk-width-1-1" style="width:100%;">
                        <template v-for="(object, index) in child_info.records" style="width:100%;">
                            <tr  :key="index" style="width:100%;">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr  :key="index">
                                <td><b>{{object.fname}} {{object.lname}}</b></td>
                                <td>{{invoice_info[(index*2)].disc}}</td>
                                <td><datepicker input-class="uk-form-small uk-input" format="MM/dd/yyyy" v-model="invoice_info[(index*2)].date_from" name="date_from" style="border: 1px solid #ddd !important;"></datepicker></td>
                                <td><datepicker input-class="uk-form-small uk-input" format="MM/dd/yyyy" v-model="invoice_info[(index*2)].date_to" name="date_to" style="border: 1px solid #ddd !important;"></datepicker></td>
                                <td><input class="uk-input uk-form-small" type="text" name="units" v-model="invoice_info[(index*2)].units"></td>
                                <td><img style="width:16px;height:16px;" src="../assets/images/Dollar_Sign.svg" alt=""><input class="uk-input uk-form-small" type="text" name="rates" v-model="invoice_info[(index*2)].rates"></td>
                                <td><img style="width:16px;height:16px;" src="../assets/images/Dollar_Sign.svg" alt=""><b>{{(invoice_info[(index*2)].units)*(invoice_info[(index*2)].rates)}}</b></td>
                            </tr>
                            <tr  :key="index">
                                <td><b>{{object.fname}} {{object.lname}}</b></td>
                                <td>{{invoice_info[(index*2)+1].disc}}</td>
                                <td><datepicker input-class="uk-form-small uk-input" format="MM/dd/yyyy" v-model="invoice_info[(index*2)+1].date_from" name="date_from" style="border: 1px solid #ddd !important;"></datepicker></td>
                                <td><datepicker input-class="uk-form-small uk-input" format="MM/dd/yyyy" v-model="invoice_info[(index*2)+1].date_to" name="date_to" style="border: 1px solid #ddd !important;"></datepicker></td>
                                <td><input class="uk-input uk-form-small" type="text" name="units" v-model="invoice_info[(index*2)+1].units"></td>
                                <td><img style="width:16px;height:16px;" src="../assets/images/Dollar_Sign.svg" alt=""><input class="uk-input uk-form-small" type="text" name="rates" v-model="invoice_info[(index*2)+1].rates"></td>
                                <td><img style="width:16px;height:16px;" src="../assets/images/Dollar_Sign.svg" alt=""><b>{{(invoice_info[(index*2)+1].units)*(invoice_info[(index*2)+1].rates)}}</b></td>
                            </tr>
                        </template>
                    </tbody>
                </table>
                <div class="uk-grid">
                    <div class = "uk-width-1-2 uk-margin-medium-top">
                        <router-link to="/dashboard"><button class="uk-button uk-button-secondary">Cancel</button></router-link>
                    </div>
                    <div class = "uk-width-1-2 uk-margin-medium-top">
                        <button style="float: right;" class="uk-button uk-button-primary" @click="createInvoice()">Submit Invoice For Approval</button>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
import UIkit from 'uikit';
import axios from 'axios';
import Datepicker from 'vuejs-datepicker';

export default {
    name: 'InvoiceNewPage',
    //props: ["user","child_info","dateInfo","monthNames","invoice_info"],
    props: {
        user: Object,
        child_info: Object,
        dateInfo: Date,
        monthNames: Array,
        invoice_info: Array,
        invoice_num: Number
    },
    components: {
        Datepicker
    },
    methods: {
    createInvoice(invoice_info) {
        console.log("Creating New Invoice");
        console.log("invoice_info"+ this.invoice_info);
        
        axios.post
        (
            "http://www.fizzlab.xyz:86/api/api.php/records/invoice_history", 
            {
                "fp_id": this.user.user_id,
                "c_id": 0,
                "state": 1,
                "flagged": 0,
                "month": (this.monthNames[this.dateInfo.getMonth()]),
                "year": this.dateInfo.getFullYear()
            }, 
            {headers: {"Content-Type": "text/plain"}}
        )
            
        .then(res => 
        { 
            this.invoice_num = res.data;
            console.log(this.invoice_num);
            console.log(res.data);
            this.$router.replace({ name: "dashboard" })  
          
            let len = this.child_info.records.length;
            let i = 0;
            for (i = 0; i < len; i++) 
            {
                axios.post(
                    "http://www.fizzlab.xyz:86/api/api.php/records/invoice_information",
                    {
                        "invoice_id": this.invoice_num,
                        "client_id": this.child_info.records[i].id,
                        "service_num": this.invoice_info[i*2].service_num,
                        "disc": this.invoice_info[i*2].disc,
                        "date_from": this.invoice_info[i*2].date_from,
                        "date_to": this.invoice_info[i*2].date_to,
                        "units": this.invoice_info[i*2].units,
                        "rates": this.invoice_info[i*2].rates
                    },
                    {headers: {"Content-Type": "text/plain"}}
                )
                .then(res => {})
                .catch(e => console.log(e));
                axios.post(
                    "http://www.fizzlab.xyz:86/api/api.php/records/invoice_information",
                    {
                        "invoice_id": this.invoice_num,
                        "client_id": this.child_info.records[i].id,
                        "service_num": this.invoice_info[(i*2)+1].service_num,
                        "disc": this.invoice_info[(i*2)+1].disc,
                        "date_from": this.invoice_info[(i*2)+1].date_from,
                        "date_to": this.invoice_info[(i*2)+1].date_to,
                        "units": this.invoice_info[(i*2)+1].units,
                        "rates": this.invoice_info[(i*2)+1].rates
                    }, 
                    {headers: {"Content-Type": "text/plain"}}
                )
                .then(res => {})
                .catch(e => console.log(e));
            }
        })
        .catch(e => console.log(e));
    }
  }
}


</script>

<!-- Add "scoped" attribute to limit CSS to this component only style="background: #D3D3D3" -->
<style scoped>

table, th, td {
  border: 1px solid rgb(224, 224, 224);
}

th {
  padding: 0px;
  text-align: center;
  background: #113C66 !important;
  border: 1px solid rgb(56, 56, 56);
  color: #B3CDF9;
}

.uk-form-small {
    width: 50px;
}

.uk-input{
    border: 1px solid #ddd !important;
}

</style>
