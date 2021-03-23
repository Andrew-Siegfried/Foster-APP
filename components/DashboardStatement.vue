<template>
<button class="button">
    <div class = "uk-width-1-1 uk-grid " >
        <div class = "uk-margin-small-top uk-width-1-4">
            <h4><img style="width:32px;height:32px;" src="../assets/images/invoice-icon.svg" alt=""> {{object.month}} {{object.year}} Invoice</h4>
        </div>
        <div class = "uk-margin-small-top uk-width-2-5"> 
            <h4 v-if="object.state == 0 && object.flagged != 1" class="uk-text-warning"> <!-- Created but not submitted -->
            (Not Complete)
            </h4>
            <h4 v-else-if="object.state == 1 && object.flagged != 1" class="uk-text-primary"> <!-- Created and submitted, not accepted by county -->
            (Pending Review)
            </h4>
            <h4 v-else-if="object.state == 2 && object.flagged != 1"  class="uk-text-primary"> <!-- Created and submitted and accepted by county -->
            (Accepted By County)
            </h4>
            <h4 v-else-if="object.state == 3 && object.flagged != 1" class="uk-text-success"> <!-- Created and submitted, accepted by county and payment disbursed -->
            (Payment Disbursed)
            </h4>
            <h4 v-else-if="object.flagged == 1" class="uk-text-warning">
            (Attention Required)
            </h4>
            <h4 v-else class="uk-text-danger">
            Error! Contact System Admin.
            </h4>
        </div> 
        <div class = "uk-width-1-4">
            <table class="table">
            <tbody>
                <tr>
                    <td class="progress-td">
                        <img v-if="object.state >= 0" style="width:118px;height:34px;" src="../assets/images/progress-grn.png" alt="">
                        <img v-else-if="object.flagged == 1 && object.state == 0" style="width:118px;height:34px;" src="../assets/images/progress-red.png" alt="">
                        <img v-else style="width:118px;height:34px;" src="../assets/images/progress-gry.png" alt="">
                    </td>
                    <td class="progress-td">
                        <img v-if="object.state == 0 && object.flagged == 0" style="width:118px;height:34px;" src="../assets/images/progress-blu.png" alt="">
                        <img v-else-if="object.state >= 1" style="width:118px;height:34px;" src="../assets/images/progress-grn.png" alt="">
                        <img v-else-if="object.flagged == 1 && object.state == 0" style="width:118px;height:34px;" src="../assets/images/progress-red.png" alt="">
                        <img v-else style="width:118px;height:34px;" src="../assets/images/progress-gry.png" alt="">
                    </td>
                    <td class="progress-td">
                        <img v-if="object.state == 1 && object.flagged == 0" style="width:118px;height:34px;" src="../assets/images/progress-blu.png" alt="">
                        <img v-else-if="object.state >= 2" style="width:118px;height:34px;" src="../assets/images/progress-grn.png" alt="">
                        <img v-else-if="object.flagged == 1 && object.state == 1" style="width:118px;height:34px;" src="../assets/images/progress-red.png" alt="">
                        <img v-else style="width:118px;height:34px;" src="../assets/images/progress-gry.png" alt="">
                    </td>
                    <td class="progress-td">
                        <img v-if="object.state == 2 && object.flagged == 0" style="width:118px;height:34px;" src="../assets/images/progress-blu.png" alt="">
                        <img v-else-if="object.state == 3 && object.flagged == 0" style="width:118px;height:34px;" src="../assets/images/progress-grn.png" alt="">
                        <img v-else-if="object.flagged == 1 && object.state == 2" style="width:118px;height:34px;" src="../assets/images/progress-red.png" alt="">
                        <img v-else-if="object.flagged == 1 && object.state == 3" style="width:118px;height:34px;" src="../assets/images/progress-red.png" alt="">
                        <img v-else style="width:118px;height:34px;" src="../assets/images/progress-gry.png" alt="">
                    </td>
                </tr>
                <tr>
                    <td class="progress-td">Created</td>
                    <td class="progress-td">Submitted</td>
                    <td class="progress-td">Accepted</td>
                    <td class="progress-td">Disbursed</td>
                </tr>
            </tbody>
            </table>
        </div>
    </div>
    <div v-if="object.flagged == 0 && object.state < 3" class = "Bar uk-width-1-1">
    </div>
    <div v-else-if="object.flagged == 0 && object.state == 3" class = "Bar uk-width-1-1" style="border-bottom: 3px solid #32d296">
    </div>
    <div v-else class = "Bar uk-width-1-1" style="border-bottom: 3px solid #faa05a">  
    </div> 
    </button>
</template>

<script>
export default {
  name: 'DashboardStatement',
  props: ["object"]
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only <button class="uk-button uk-button-danger" style="float: right; line-height:100%; width: 20px; padding:0px 0px 4px 0px;">E<br>D<br>I<br>T</button> <!-- style="float: right; line-height:15px; width: 50px;" -->
<style scoped>
.uk-navbar-left a:link {
    font-family: "Open Sans", sans-serif !important;
    font-size: .85em;
    padding-left: 2em;
}

.tr { 
padding:0; margin:0;
border-spacing: 0;
border-collapse: collapse;
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

.progress-td {
    min-width: 60px !important;
}

.inv-padding {
    padding: 10px 0 10px 0;
}

.button {
  border: none;
  color: black;
  background: rgb(224, 224, 224);
  padding: 0px;
  text-align: none;
  text-decoration: none;
  outline: none;
  display: inline-block;
  margin: 0px;
  cursor: pointer;
  width: 100%;
}

.button:hover { 
  background: rgb(205, 205, 205);
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

.Bar {
    border-bottom: 3px solid #1E87F0;
    margin-left: 0px;
}

.uk-box-shadow-xlarge {
    background: #66ccff !important;
    text-align:center;
}

.is-active, .active-nav {
    color: #fff !important;
}
</style>
