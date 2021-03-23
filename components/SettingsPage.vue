<template>
    <div class="SettingsPage uk-grid">
        <div class = "uk-width-1-5">
            <nav class="uk-nav-side" >
                <div class="uk-section-primary uk-text-large">
                    <ul class="uk-navbar-left uk-navbar-nav">
                        <li class="uk-nav-header uk-heading-bullet">Update Account Information</li>
                    </ul>
                    <ul class="uk-navbar-left uk-navbar-nav">
                        <li active-class="active-nav">
                            <router-link to="/">Address</router-link>
                        </li>
                    </ul>
                    <ul class="uk-navbar-left uk-navbar-nav">
                        <li active-class="active-nav">
                            <router-link to="/">Email</router-link>
                        </li>
                    </ul>
                    <ul class="uk-navbar-left uk-navbar-nav">
                        <li active-class="active-nav">
                            <router-link to="/">Password</router-link>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        <div class = "uk-width-3-5">
            <h1 class="uk-heading-divider">Account Information</h1>
            <table class="uk-table uk-table-striped">
                <tbody>
                    <tr>
                        <td><b>First Name:</b></td>
                        <td>Andrew</td>
                        <td><b>Last Name:</b></td>
                        <td>Siegfried</td>
                    </tr>
                    <tr>
                        <td><b>Address:</b></td>
                        <td>5040 Oliver Ave S</td>
                        <td><b>Zip:</b></td>
                        <td>55419</td>
                    </tr>
                    <tr>
                        <td><b>City:</b></td>
                        <td>Minneapolis</td>
                        <td><b>State:</b></td>
                        <td>Minnesota</td>
                    </tr>
                    <tr>
                        <td><b>Email:</b></td>
                        <td>siegfried.andrew@gmail.com</td>
                        <td><b>Phone:</b></td>
                        <td>612-388-7872</td>
                    </tr>
                </tbody>
            </table>
        </div>
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
