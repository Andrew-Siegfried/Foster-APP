<template>
    <div class="nav">
        <div uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky;">
        <nav class="uk-section-primary uk-padding-remove-bottom uk-padding-remove-top" uk-navbar="delay-hide:200" >
            <div class="uk-navbar-left uk-section-primary uk-text-large">
                
            <ul class="uk-navbar-nav">
                <li active-class="active-nav">
                <router-link to="/">Home</router-link>
                </li>
                <li active-class="active-nav">
                <router-link to="/about">Contact Us</router-link>
                </li>
            </ul>
            </div>
            <div class="uk-navbar-right uk-section-primary">
                <ul class="uk-navbar-nav login-nav">
                    <li active-class="active-nav">
                    <router-link to="login">User Login</router-link>
                    </li>
                </ul>
            </div>
        </nav>
        </div>
    </div>
</template>

<script>
export default {
  name: 'Nav'
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

.login-nav li {
    background: #5dba6c;
    color: #fff !important;
}

.login-nav li:hover {
    background: #56AD63;
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
    width: 14em;
    background: #1E87F0 !important;
}

.uk-navbar-dropdown a:link {
    font-family: "Open Sans", sans-serif !important;
    font-size: 1em;
    width: 14em;
    padding: 15px;
    color: #fff !important;
}

.uk-navbar-dropdown a:hover {
    color: #fff;
}

.is-active, .active-nav {
    color: #fff !important;
}

.nav, .uk-navbar-left, .uk-narbar-right, .uk-navbar-nav, .uk-navbar-nav li, .uk-navbar-nav li a:link {
    height: 60px !important;
    max-height: 60px !important;
    min-height: 60px !important;
    margin-top: 0 !important;
    padding-top: 0 !important;
}

.uk-navbar-nav li {
    margin-top: 0 !important;
    padding-top: 0 !important;
}
</style>