<template>
    <div class = "uk-width-expand" uk-height-viewport="expand: true">
        <div class="uk-grid">
            <div class = "uk-width-1-2 uk-margin-medium-top">
                <h4><img style="width:32px;height:32px;" src="../assets/images/invoice-icon.svg" alt=""> {{object.month}} {{object.year}} Invoice</h4>
            </div>
        </div>
        <h1 class="uk-width-expand uk-heading-divider uk-margin-small"></h1>
        <div class = "uk-width-expand">
            <table class="uk-table uk-table-striped">
                <thead style="padding: 0px;">
                    <tr >
                        <th>Child Name</th>
                        <th>Descrirption</th>
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
                    <template v-for="(child, index) in child_info.records" style="width:100%;">
                        <tr v-if="index<(invoice_info.length/2)" :key="index" style="width:100%;">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr v-if="index<(invoice_info.length/2)" :key="index">
                            <td><b>{{child.fname}} {{child.lname}}</b></td>
                            <td>{{invoice_info[(index*2)].disc}}</td>
                            <td>{{formatDate(invoice_info[(index*2)].date_from)}}</td>
                            <td>{{formatDate(invoice_info[(index*2)].date_to)}}</td>
                            <td>{{invoice_info[(index*2)].units}}</td>
                            <td><img style="width:16px;height:16px;" src="../assets/images/Dollar_Sign.svg" alt="">{{invoice_info[(index*2)].rates}}</td>
                            <td><img style="width:16px;height:16px;" src="../assets/images/Dollar_Sign.svg" alt=""><b>{{(invoice_info[(index*2)].units)*(invoice_info[(index*2)].rates)}}</b></td>
                        </tr>
                        <tr v-if="index<(invoice_info.length/2)" :key="index">
                            <td><b>{{child.fname}} {{child.lname}}</b></td>
                            <td>{{invoice_info[(index*2)+1].disc}}</td>
                            <td>{{formatDate(invoice_info[(index*2)+1].date_from)}}</td>
                            <td>{{formatDate(invoice_info[(index*2)+1].date_to)}}</td>
                            <td>{{invoice_info[(index*2)+1].units}}</td>
                            <td><img style="width:16px;height:16px;" src="../assets/images/Dollar_Sign.svg" alt="">{{invoice_info[(index*2)+1].rates}}</td>
                            <td><img style="width:16px;height:16px;" src="../assets/images/Dollar_Sign.svg" alt=""><b>{{(invoice_info[(index*2)+1].units)*(invoice_info[(index*2)+1].rates)}}</b></td>
                        </tr>
                    </template>
                </tbody>
            </table>
            <div v-if="object.state == 3" class="uk-grid">
                <div class = "uk-width-1-1 uk-margin-medium-top">
                    <router-link to="/dashboard"><button style="float: right;" class="uk-button uk-button-primary">Close</button></router-link>
                </div>
            </div>
            <div v-else class="uk-grid">
                <div class = "uk-width-1-2 uk-margin-medium-top">
                    <router-link to="/dashboard"><button class="uk-button uk-button-secondary">Cancel</button></router-link>
                </div>
                <div class = "uk-width-1-2 uk-margin-medium-top">
                    <button style="float: right;" class="uk-button uk-button-primary" @click="editInvoice()">Submit Invoice For Re-Approval</button>
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
    name: 'InvoiceEditPage',
    //props: ["user","child_info","dateInfo","monthNames","invoice_info"],
    props: {
        user: Object,
        child_info: Object,
        invoice_info: Object,
        object: Object
    },
    components: {
        Datepicker
    },
    methods: {
        editInvoice(invoice_info) {
            console.log("Editing Invoice");
            console.log("invoice_info"+ this.invoice_info);

            let len = this.child_info.records.length;
            let i = 0;
            for (i = 0; i < len; i++) 
            {
                axios.put(
                    "http://www.fizzlab.xyz:86/api/api.php/records/invoice_information/"+this.invoice_info[i*2].id,
                    {
                        "date_from": this.invoice_info[i*2].date_from,
                        "date_to": this.invoice_info[i*2].date_to,
                        "units": this.invoice_info[i*2].units,
                        "rates": this.invoice_info[i*2].rates
                    },
                    {headers: {"Content-Type": "text/plain"}}
                )
                .then(response => { console.log(response)})
                .catch(e => console.log(e));
                axios.put(
                    "http://www.fizzlab.xyz:86/api/api.php/records/invoice_information/"+this.invoice_info[(i*2)+1].id,
                    {
                        "date_from": this.invoice_info[(i*2)+1].date_from,
                        "date_to": this.invoice_info[(i*2)+1].date_to,
                        "units": this.invoice_info[(i*2)+1].units,
                        "rates": this.invoice_info[(i*2)+1].rates
                    }, 
                    {headers: {"Content-Type": "text/plain"}}
                )
                .then(response => { console.log(response)})
                .catch(e => console.log(e));
            }
            this.$router.replace({ name: "dashboard" });
        },
        formatDate(date) {
            let split = date.split("-");
            let newDate = split[1] + "/" + split[2].split("T")[0] + "/" + split[0];
            return (newDate);
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
    width: 60px;
}

</style>
