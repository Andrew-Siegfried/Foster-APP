<template>
    <div class="NavSignedIn">

        <NavAdmin v-if="user.is_admin === 1" v-on:logout="$emit('logout')" v-bind:user="user" />
        <NavCountyWorker v-else-if="user.is_cw === 1" v-on:logout="$emit('logout')" v-bind:user="user" />
        <NavFosterParent v-else v-on:logout="$emit('logout')" v-bind:user="user" />

    </div>
</template>

<script>
import NavFosterParent from '@/components/NavFosterParent.vue';
import NavCountyWorker from '@/components/NavCountyWorker.vue';
import NavAdmin from '@/components/NavAdmin.vue';
import UIkit from 'uikit'

export default {
  name: 'NavSignedIn',
  components: {
    NavFosterParent,
    NavCountyWorker,
    NavAdmin
  },
  props: {
    auth: Boolean,
    user: Object
  },
  created() {
    if(typeof this.user.user_id !== "undefined"){

    }else{
        console.log("waiting")
        setTimeout(this.waitForUser, 250)
    }
  },
  methods: {
    waitForUser(){
      if(typeof this.user.user_id !== "undefined"){

      }else{
        console.log("waiting")
          setTimeout(this.waitForElement, 250)
      }
    }
  }
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