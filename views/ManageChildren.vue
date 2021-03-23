<template>
  <div class="manage-children">
    <NavSignedIn v-on:logout="$emit('logout')" v-bind:user="user" />
    <div class="uk-padding">
      <ChildViewPage v-bind:children="children.records" v-on:add-user="addChild" v-on:del-child="deleteChild" v-on:re-assign="reassignChild" v-bind:new_child="new_child"/>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import NavSignedIn from '@/components/NavSignedIn.vue';
import ChildViewPage from '@/components/ChildViewPage.vue';
import axios from 'axios';
import UIkit from 'uikit';

export default {
  name: 'ManageChildren',
  components: {
    NavSignedIn,
    ChildViewPage
  },
  props: {
    auth: Boolean,
    user: Object,
  },
  data() {
    return {
      children: [],
      new_child: {
        fname: '',
        lname: '',
        dob: '',
        fp_id: ''
      }
    }
  },
  created() {
      axios.get('http://www.fizzlab.xyz:86/api/api.php/records/child_information')
      .then(res => {
        this.children = res.data;   
        })
        .catch(err => console.log(err));
  },
  mounted() {
    this.$emit('check-cw-auth-page')
  },
  methods: 
  {
    addChild(formData)
    {
      console.log("Adding new user.." + formData.fname);
      let newUserId = 0;
      axios.post
      (
        "http://www.fizzlab.xyz:86/api/api.php/records/child_information", 
        {
          "fname": formData.fname,
          "lname": formData.lname,
          "dob": formData.dob,
          "fp_id": formData.fp_id
        }, 
        {
          headers: 
          {
            "Content-Type": "text/plain"
          }
        }
      )
      .then(
        res => 
                {
                  axios.get('http://www.fizzlab.xyz:86/api/api.php/records/child_information')
                  .then
                  (
                    res => 
                    {
                      this.children = res.data;   
                    }
                  )
                  .catch
                  (
                    err => console.log(err)
                  );
                  formData.fname = '';
                  formData.lname = '';
                  formData.dob = '';
                  formData.fp_id = '';
                }
      )
      .catch
      (
        err => console.log(err)
      );
    },
    deleteChild(id) 
    {
      axios.delete("http://www.fizzlab.xyz:86/api/api.php/records/child_information/"+id)
        .then(res => 
        {
          axios.get('http://www.fizzlab.xyz:86/api/api.php/records/child_information')
          .then(res => { console.log(this.children); this.children = res.data; console.log(res.data)} )
          .catch( err => console.log(err) );
        })
        //.then(res => this.users.records = this.users.records.filter(user => user.user_id !== id))
        .catch(err => console.log(err));
      
      console.log("deleted child by id: "+  id);
    },
    reassignChild(id, fpid)
    {
      console.log("updating child fpid");
      console.log("child: "+id+" fpid: "+fpid);
      axios.put(
                "http://www.fizzlab.xyz:86/api/api.php/records/child_information/"+id, 
                {
                    "fp_id": fpid
                }, 
                {headers: {"Content-Type": "text/plain"}}
            )
            .then(res => {
              UIkit.notification("Updated Foster Assignment", {
                  status: 'success'
              })

              axios.get('http://www.fizzlab.xyz:86/api/api.php/records/child_information')
              .then
              (
                res => 
                {
                  this.children = res.data;   
                }
              )
              .catch
              (
                err => console.log(err)
              )
            
            })
            .catch(e => console.log(e));
            this.$router.replace({ name: "manage-children" })
    },
    getChildren(){
        axios.get('http://www.fizzlab.xyz:86/api/api.php/records/child_information')
      .then(res => {
        this.children = res.data;   
        })
        .catch(err => console.log(err));
    }
  }
}
</script>
