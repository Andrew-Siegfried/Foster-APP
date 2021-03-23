<template>
    <div class="NavCountyWorker">
        <div uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky;">
        <nav class="uk-section-primary uk-padding-remove-bottom uk-padding-remove-top" uk-navbar="delay-hide:200; animation:fade;" >
            <div class="uk-navbar-left uk-section-primary uk-text-large">
                
            <ul class="uk-navbar-nav">
                <li active-class="active-nav">
                    <router-link to="/"><img src="../assets/home_icon.png" alt=""></router-link>
                </li>
                <li active-class="active-nav">
                    <router-link to="/cw/dashboard">County Dashboard</router-link>
                </li>
                <li active-class="active-nav">
                    <router-link to="/cw/completed">Past Invoices</router-link>
                </li>
                <li active-class="active-nav">
                    <router-link to="/cw/children">Manage Children</router-link>
                </li>
            </ul>
            </div>
            <div class="uk-navbar-right uk-section-primary">
                <ul class="uk-navbar-nav account-nav ">
                    <li>
                        <router-link to="/settings">Account</router-link>
                        <div uk-dropdown="pos: bottom-right; delay-hide:0; duration:0" class="uk-navbar-dropdown uk-margin-remove ">
                            <ul class="uk-nav uk-navbar-dropdown-nav uk-section-primary uk-margin-remove">
                            <li active-class="active-nav">
                                <router-link to="/settings">Settings</router-link>
                            </li>
                            <li active-class="active-nav">
                                <a href="#" uk-toggle="target: #logout-modal">Logout</a>
                            </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        </div>

        <!-- This is the modal -->
        <div id="logout-modal"  uk-modal>
            <div class="uk-modal-dialog uk-modal-body  uk-margin-auto-vertical">
                <h2 class="uk-modal-title uk-text-center">Logout?</h2>
                <p class="uk-text-center">Are you sure you want to log out of the Foster Care Invoice System?</p>
                <p class="uk-text-right">
                    <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                    <a href="#" class="uk-button uk-button-danger uk-modal-close" @click="$emit('logout')" type="button">Logout</a>
                </p>
            </div>
        </div>

    </div>
</template>

<script>
import UIkit from 'uikit'
export default {
  name: 'NavCountyWorker'
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

.uk-navbar-nav li {
    color: #fff !important;
}

.uk-navbar-nav li:hover {
    background-color: rgba(0,0,0,.05);
}

.account-nav li {
    background: #1B76D1;
    color: #fff !important;
}

.account-nav li:hover {
    background: #1970C6;
}

.uk-navbar-left a:link {
    font-family: "Open Sans", sans-serif !important;
    font-size: .85em;
    padding: 0 2em 0 2em;
    color: #fff !important;
}

.uk-navbar-right a:link {
    font-family: "Open Sans", sans-serif !important;
    font-size: 1.3em;
    padding: 0 2em 0 2em;
    color: #fff !important;
}
.uk-navbar-dropdown {
    width: 200px;
    background: #1970C6 !important;
    padding: 0 !important;
}
.uk-navbar-dropdown-nav li {
    background: #1970C6 !important;
    margin: 0 !important;
    padding: 0 !important;
    vertical-align: middle;
}
.uk-navbar-dropdown a:link {
    font-family: "Open Sans", sans-serif !important;
    font-size: 18px;
    width: 200px;
    padding: 15px 0 15px 0;
    color: #fff !important;
    text-align: center;
    margin: 0 !important;
}

.uk-navbar-dropdown a:hover {
    color: #fff;
    background-color: rgba(0,0,0,.05);
}
.is-active, .active-nav {
    color: #fff !important;
}

.nav, .uk-navbar-left, .uk-narbar-right, .uk-navbar-nav, .uk-navbar-nav li, 
.uk-navbar-nav li a:link, .uk-navbar-dropdown-nav li, .uk-navbar-nav li:hover, 
.uk-navbar-dropdown li li:hover a:hover  {
    height: 60px !important;
    max-height: 60px !important;
    min-height: 60px !important;
    overflow: hidden;
}
</style>