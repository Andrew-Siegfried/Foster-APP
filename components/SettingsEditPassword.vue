<template>
        <div class = "uk-width-expand@m  uk-flex-center uk-text-center"  uk-grid>
            <h3 class="uk-heading-divider" style="width: 90%;">Update Password:</h3>
            <div class="uk-card uk-width-1-2">
                <table width="100%">
                    <tr>
                        <td class="uk-padding-small">
                            <label><b>Current Password:</b></label>&nbsp;&nbsp;
                            <input type="password" name="current_password" class="uk-input uk-form-medium" v-model="current_password">
                        </td>
                    </tr>
                    <tr>
                        <td class="uk-padding-small">
                            <label><b>New Password:</b></label>&nbsp;&nbsp;
                            <input type="password" name="new_password" class="uk-input uk-form-medium" v-model="new_password">
                        </td>
                    </tr>
                    <tr>
                        <td class="uk-padding-small">
                            <label><b>Confirm New Password:</b></label>&nbsp;&nbsp;
                            <input type="password" name="verify_password" class="uk-input uk-form-medium" v-model="verify_password">
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
            if(this.current_password === this.user.password){
                if(this.new_password === this.verify_password){
                    this.$emit('update-password', this.new_password)
                    UIkit.notification("Updated Password", {
                    status: 'success'
                    });
                } else {
                    UIkit.notification("New passwords dont match", {
                    status: 'danger'
                    });
                }
            } else {
                    UIkit.notification("Incorrect password entered for current password", {
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
