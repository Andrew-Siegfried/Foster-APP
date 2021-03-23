<template>
        <div class = "uk-width-2-3" uk-height-viewport="expand: true">
            <h1 class="uk-heading-divider">Contact Us:</h1>
            <h3>Phone: 651-500-6000</h3>
            <h3>Email: contact@fish.com</h3>
        </div>
</template>

<script>
export default {
  name: 'SettingsPage',
  props: {
    msg: String
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
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


.uk-box-shadow-xlarge {
    background: #66ccff !important;
    text-align:center;
}

.is-active, .active-nav {
    color: #fff !important;
}
</style>
