<template>
        <div class = "uk-width-expand@m  uk-flex-center uk-text-center"  uk-grid>
            <h3 class="uk-heading-divider" style="width: 90%;">Update Email Address:</h3>
            <div class="uk-card uk-width-1-2">
                <table width="100%">
                    <tr>
                        <td class="uk-padding-small">
                            <label><b>Current Email:</b></label>&nbsp;&nbsp;
                            <input type="email" name="current_email" class="uk-input uk-form-medium" v-model="this.user.email">
                        </td>
                    </tr>
                    <tr>
                        <td class="uk-padding-small">
                            <label><b>New Email:</b></label>&nbsp;&nbsp;
                            <input type="email" name="email" class="uk-input uk-form-medium" v-model="email">
                        </td>
                    </tr>
                    <tr>
                        <td class="uk-padding-small">
                            <label><b>Confirm New Email:</b></label>&nbsp;&nbsp;
                            <input type="email" name="verify_email" class="uk-input uk-form-medium" v-model="verify_email">
                        </td>
                    </tr>
                </table>
                <div>
                    &nbsp;
                </div>
                <button class="uk-button uk-button-secondary" @click="cancel()">Cancel</button>
                <button class="uk-button uk-button-primary" @click="update()">Update</button>
            </div>
        </div>
</template>

<script>
import UIkit from 'uikit';
export default {
    name: 'SettingsPage',
    props: {
        msg: String,
        user: Object
    },
    methods: {
        cancel(){
            UIkit.notification("No Updates Made", {
                status: 'danger'
            });
            this.$router.replace({ name: "settings" });
        },
        update() {
            if(this.email === this.verify_email){
                this.$emit('update-email', this.email)
                UIkit.notification("Updated Email", {
                status: 'success'
                });
            } else {
                UIkit.notification("New email addresses dont match", {
                status: 'danger'
                });
            }
        }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.uk-input, .uk-select {
    border: 1px solid #ccc !important;
    text-align: center;
}
.uk-button-primary {
    background: #66ccff !important;
    float:right;
}
</style>
