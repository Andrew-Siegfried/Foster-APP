<template>
    <div class="uk-width-1-5 sideContainer">
        <nav class="uk-nav-side" >
            <div class="uk-section-secondary uk-text-medium sidebar">
                    <div class="nav-heading"><b>Update Information</b></div>
                    <router-link to="/settings/address"><div active-class="active-nav" class="sidebarLink">
                        &#187; Address
                    </div></router-link>
                    <router-link to="/settings/email"><div active-class="active-nav" class="sidebarLink">
                        &#187; Email
                    </div></router-link>
                    <router-link to="/settings/password"><div class="sidebarLink">
                        &#187; Password
                    </div></router-link>
            </div>
        </nav>
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
.nav-heading {
    padding: 10px;
    
}

.sidebar {
    margin-bottom: -5000px !important; /* any large number will do */
    padding-bottom: 5000px !important; 
    background-color: #094d90 !important;
}

.sidebar a:hover {
    text-decoration: none !important;
}

.sideContainer {
    overflow: hidden !important;
}

.sidebarLink {
    width: 100%;
    clear: both;
    padding: 10px 0 10px 20px;
}

.sidebarLink:hover {
    background-color: rgba(0,0,0,.1);
}

.sidebarLink a:hover {
    text-decoration: none !important;
}
</style>
