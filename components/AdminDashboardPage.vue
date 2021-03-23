<template>
        <div class = "uk-width-expand" uk-height-viewport="expand: true">
            <div class="uk-grid">
                <div class = "uk-width-1-2">
                    <h1>Billing Records:</h1>
                </div>
                <div class = "uk-width-1-2 uk-margin-small-top">
                    <router-link to="/invoice/new"><button style="float: right;" class="uk-button uk-button-secondary">New Invoice</button></router-link>
                </div>
            </div>
            <h1 class="uk-width-1-1 uk-heading-divider uk-margin-small"></h1>
            <div class = "uk-width-1-1">
                <ul class="uk-width-1-1">
                    <li v-for="object in invoice_info.records" :key="object">
                        <DashboardStatement v-bind:object="object"/>
                    </li>
                </ul>
            </div>
        </div>
</template>

<script>
import DashboardStatement from '@/components/DashboardStatement.vue';

export default {
  name: 'DashboardPage',
  props: ["user","invoice_info"],
  components: {
    DashboardStatement
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only style="background: #D3D3D3" -->
<style scoped>
.uk-navbar-left a:link {
    font-family: "Open Sans", sans-serif !important;
    font-size: .85em;
    padding-left: 2em;
}

.uk-navbar-right a:link {
    font-family: "Open Sans", sans-serif !important;
    font-size: 1.3em;
    padding-right: 2em;
}

.uk-navbar-dropdown {
    width: 14em;
    background: #1E87F0 !important;
}

.uk-section-primary {
    background: #113C66 !important;
}

.uk-navbar-dropdown a:link {
    font-family: "Open Sans", sans-serif !important;
    font-size: 1em;
    width: 14em;
    padding: 15px;
    color: #B3CDF9;
}

.uk-button-secondary {
    background: #5dba6c !important;
}

.uk-box-shadow-xlarge {
    background: #66ccff !important;
    text-align:center;
}



.is-active, .active-nav {
    color: #fff !important;
}
li {
    list-style-type: none;
    padding-bottom: 10px;
    
}
ul {
    list-style-type: none;
    padding-left: 0px;
}
</style>
