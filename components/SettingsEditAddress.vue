<template>
        <div class="uk-width-expand@m uk-flex-center uk-text-center">
            <h3 class="uk-heading-divider">Update Address Information:</h3>
            <table class="uk-table uk-table-striped">
                <tbody>
                    <tr>
                        <td class="fieldName"><b>First Name:</b></td>
                        <td><input class="uk-input uk-form-medium" type="text" name="city" v-model="user_info.fname" disabled></td>
                        <td class="fieldName"><b>Last Name:</b></td>
                        <td><input class="uk-input uk-form-medium" type="text" name="city" v-model="user_info.lname" disabled></td>
                    </tr>
                     <tr>
                        <td class="fieldName"><b>Address:</b></td>
                        <td><input class="uk-input uk-form-medium" type="text" name="address" v-model="user_info.address"></td>
                        <td class="fieldName"><b>Zip:</b></td>
                        <td><input class="uk-input uk-form-medium" type="text" name="zip" v-model="user_info.zip"></td>
                    </tr>
                    <tr>
                        <td class="fieldName"><b>City:</b></td>
                        <td><input class="uk-input uk-form-medium" type="text" name="city" v-model="user_info.city"></td>
                        <td class="fieldName"><b>State:</b></td>
                        <td><input class="uk-input uk-form-medium" type="text" name="st" v-model="user_info.st"></td>
                    </tr>
                    <tr>
                        <td class="fieldName"><b>Phone:</b></td>
                        <td><input class="uk-input uk-form-medium" type="text" name="phone_num" v-model="user_info.phone_num"></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <div>
            <button class="uk-button uk-button-secondary" @click="cancel()">Cancel</button>
            <button style="float: right;" class="uk-button uk-button-primary" @click="update()">Update</button>
            </div>  
        </div>
</template>

<script>
import UIkit from 'uikit';
export default {
    name: 'SettingsPage',
    props: ["user_info"],
    methods: {
        cancel(){
            UIkit.notification("No Updates Made", {
                status: 'danger'
            });
            this.$router.replace({ name: "settings" });
        },
        update() {
            this.$emit('update-user', this.user_info);
        }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.uk-input{
    border: 1px solid #ddd !important;
}

.fieldName {
    text-align: right;
    vertical-align: middle;
}
</style>
