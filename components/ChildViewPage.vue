<template>
    <div id="childViewPage" uk-height-viewport="expand: true">
        <div style="float:left;">
            <h3>Foster Children Information</h3>
        </div>
        <div style="float:right;">
        Filter by last name: <input type="text" v-model="search" class="uk-input" style="width: 200px !important;">
        </div>
        <table width="100%" class="uk-table uk-table-striped uk-table-responsive">
            <thead>
            <tr>
                <th>id</th>
                <th>first name</th>
                <th>last name</th>
                <th>date of birth</th>
                <th>foster id</th>
                <th></th>

            </tr>
            </thead>

            <tbody v-if="filteredList.length > 0">
            <tr v-bind:key="child.id" v-for="child in filteredList">
                <td>{{ child.id }}</td>
                <td>{{ child.fname }}</td>
                <td>{{ child.lname }}</td>
                <td>{{ child.dob }}</td>
                <td style="width: 200px">{{ child.fp_id }} <input type="button" v-bind:uk-toggle=" `target: #modal-fpchange-${child.id}`"  class="uk-button uk-button-primary uk-button reassign-button" value="re-assign"></td>
                <td style="width: 30px"><input type="button" v-bind:uk-toggle=" `target: #modal-example-${child.id}`"  class="uk-button uk-button-danger uk-button" value="X"></td>
            </tr>
            </tbody>
            <tbody v-else>
                <tr>
                    <td colspan="6" class="uk-text-danger">No children match your search.</td>
                </tr>
            </tbody>
        </table>

        <!-- This is the modal -->
        <div v-bind:key="child.id" v-for="child in children" :id="`modal-example-${child.id}`"  uk-modal>
            <div class="uk-modal-dialog uk-modal-body  uk-margin-auto-vertical">
                <h2 class="uk-modal-title uk-text-center">Remove child "<i>{{ child.fname }} {{ child.lname }}</i>"?</h2>
                <p class="uk-text-center">This will perminantly delete this childs data, are you sure you want to procede?</p>
                <p class="uk-text-right">
                    <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                    <button class="uk-button uk-button-danger uk-modal-close" type="button" @click="$emit('del-child', child.id)">Delete</button>
                </p>
            </div>
        </div>

        <div v-bind:key="child.id" v-for="child in children" :id="`modal-fpchange-${child.id}`"  uk-modal>
            <div class="uk-modal-dialog uk-modal-body  uk-margin-auto-vertical">
                <h2 class="uk-modal-title uk-text-center">Change <i>{{ child.fname }} {{ child.lname }}'s</i> foster assignment:</h2>
                <p class="uk-text-center">Current Foster Parent ID: &emsp; <b>{{ child.fp_id }}</b><br/><br/>
                    New Foster Parent ID: &emsp;&emsp; <input type="text" :name="`reassign-fp_id-${child.id}`" v-model="edit[child.id]" class="uk-input uk-form-small" style="width: 60px !important; text-align: right;"></p>
                <p class="uk-text-right">
                    <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                    <button class="uk-button uk-button-primary uk-modal-close" type="button" @click="reassign(child.id, edit[child.id])">Re-Assign Child</button>
                </p>
            </div>
        </div>

        <br/>

        <div class="">
            <form>
                <fieldset class="uk-fieldset">
                <h3>Add Child Information</h3>
                <table width="100%">
                    <tr>
                        <td>
                            <label>First Name <br/></label>&nbsp;&nbsp;
                            <input type="text" name="fname" class="uk-input uk-form-large" v-model="new_child.fname">
                        </td>
                        <td>
                            <label>Last Name <br/></label>&nbsp;&nbsp;
                            <input type="text" name="lname" class="uk-input uk-form-large" v-model="new_child.lname">
                        </td>
                        <td>
                            <label>Date of Birth <br/></label>&nbsp;&nbsp;
                            <input type="email" name="dob" class="uk-input uk-form-large" v-model="new_child.dob">
                        </td>
                        <td style="width: 120px">
                            <label>Foster ID <br/>(must be valid)</label>&nbsp;&nbsp;
                            <input type="email" name="fp_id" class="uk-input uk-form-large" v-model="new_child.fp_id">
                        </td>
                        <td>
                            <label>&nbsp;&nbsp;</label><br/>
                             <br/><input type="button" @click="addUser()" class="uk-button uk-button-primary uk-form-large" value="Submit">
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
import axios from 'axios';
import UIkit from 'uikit';

export default {
    name: "ChildViewPage",
    props: {
        children: Array,
        new_child: Object
    },
    data() {
        return {
        edit: [],
        search: ""
        }
    },
    computed :{
        filteredList() {
            let filtered = this.children;

            if (this.search) {
                filtered = this.children.filter(
                    m => m.lname.toLowerCase().startsWith(this.search.toLowerCase())
                )
            }

            return filtered;
        }
    },
    methods: {
    addUser(){
        console.log("fname:", this.fname)

        axios.get('http://www.fizzlab.xyz:86/api/api.php/records/users/'+this.new_child.fp_id)
        .then(res => {
            console.log(res) 
            this.$emit('add-user', this.new_child);
        })
        .catch(err => {
            console.log(err)
            UIkit.notification("ERROR! <br/> A foster parent with the ID "+this.new_child.fp_id+" does not exist.", {
                  status: 'danger'
            })
        });
    },
    reassign(childid, fpid){

        axios.get('http://www.fizzlab.xyz:86/api/api.php/records/users/'+fpid)
        .then(res => {
            console.log(res) 
            this.$emit('re-assign', childid, fpid)
        })
        .catch(err => {
            console.log(err)
            UIkit.notification("ERROR! <br/> A foster parent with the ID "+fpid+" does not exist.", {
                  status: 'danger'
            })
            this.edit[childid] = '';
        });
    },
  }
}
</script>

<style>

.uk-input, .uk-select {
    border: 1px solid #ccc !important;
}

.reassign-button {
    background: #82c45c;
}

.reassign-button:hover {
    background: #6fb547;
}

</style>
