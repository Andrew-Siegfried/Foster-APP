<template>
    <div id="userViewPage" uk-height-viewport="expand: true">
        <div style="float:left;">
            <h3>User List</h3>
        </div>
        <div style="float:right;">
        Filter by username: <input type="text" v-model="search" class="uk-input" style="width: 200px !important;">
        </div>
        <table width="100%" class="uk-table uk-table-striped uk-table-responsive">
            <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>password</th>
                <th>email</th>
                <th>County Worker</th>
                <th>Admin</th>
                <th></th>

            </tr>
            </thead>

            <tbody v-if="filteredList.length > 0">
            <tr v-bind:key="user.user_id" v-for="user in filteredList">
                <td>{{ user.user_id }}</td>
                <td>{{ user.username }}</td>
                <td>{{ user.password }}</td>
                <td>{{ user.email }}</td>
                <td v-if="user.is_cw == 1">Yes</td>
                <td v-else>No</td>
                <td v-if="user.is_admin == 1">Yes</td>
                <td v-else>No</td>
                <td width="30px"><input type="button" v-bind:uk-toggle=" `target: #modal-example-${user.user_id}`"  class="uk-button uk-button-danger" value="X"></td>
            </tr>
            </tbody>
            <tbody v-else>
                <tr>
                    <td colspan="6" class="uk-text-danger">No users match your search.</td>
                </tr>
            </tbody>
        </table>

        <!-- This is the modal -->
        <div v-bind:key="user.user_id" v-for="user in users" :id="`modal-example-${user.user_id}`"  uk-modal>
            <div class="uk-modal-dialog uk-modal-body  uk-margin-auto-vertical">
                <h2 class="uk-modal-title uk-text-center">Delete User "<i>{{ user.username }}</i>"?</h2>
                <p class="uk-text-center">This will perminantly delete this user from the database, are you sure you want to procede?</p>
                <p class="uk-text-right">
                    <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                    <button class="uk-button uk-button-danger uk-modal-close" type="button" @click="$emit('del-user', user.user_id)">Delete</button>
                </p>
            </div>
        </div>

        <br/>

        <div class="">
            <form>
                <fieldset class="uk-fieldset">
                <h3>Create A New User</h3>
                <table width="100%">
                    <tr>
                        <td>
                            <label>Username</label>&nbsp;&nbsp;
                            <input type="text" class="uk-input uk-form-large" v-model="new_user.username">
                        </td>
                        <td>
                            <label>Password</label>&nbsp;&nbsp;
                            <input type="text" class="uk-input uk-form-large" v-model="new_user.password">
                        </td>
                        <td>
                            <label>Email</label>&nbsp;&nbsp;
                            <input type="email" class="uk-input uk-form-large" v-model="new_user.email">
                        </td>
                        <td>
                            <label>County Worker</label>&nbsp;&nbsp;
                            <select class="uk-input uk-select uk-form-large" v-model="new_user.is_cw" name="is_cw">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </td>
                        <td>
                            <label>Admin</label>&nbsp;&nbsp;
                            <select class="uk-input uk-select uk-form-large" v-model="new_user.is_admin" name="is_admin">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </td>

                        <td>
                            <label>&nbsp;&nbsp;</label><br/>
                            <input type="button" @click="addUser()" class="uk-button uk-button-primary uk-form-large " value="Submit">
                        </td>
                    </tr>
                    </table>
                    </fieldset>
                </form>
            </div>
            <br/><br/><br/>

    </div>
</template>

<script>
export default {
    name: "UserViewPage",
    props: ["users","new_user"],
    data() {
        return {
        search: ""
        }
    },
    computed :{
        filteredList() {
            let filtered = this.users;

            if (this.search) {
                filtered = this.users.filter(
                    m => m.username.toLowerCase().startsWith(this.search.toLowerCase())
                )
            }

            return filtered;
        }
    },
    methods: {
    addUser(){
        this.$emit('add-user', this.new_user);
    }
  }
}
</script>

<style>

.uk-input, .uk-select {
    border: 1px solid #ccc !important;
}

</style>
