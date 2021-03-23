<template>
  <div class="users">
    <NavSignedIn v-on:logout="$emit('logout')" v-bind:user="user" />
    <div class="uk-padding">
      <UserViewPage v-bind:users="users.records" v-on:add-user="addUser" v-on:del-user="deleteUser" v-bind:new_user="new_user"/>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import NavSignedIn from '@/components/NavSignedIn.vue';
import UserViewPage from '@/components/UserViewPage.vue';
import axios from 'axios';

export default {
  name: 'Users',
  components: {
    NavSignedIn,
    UserViewPage
  },
  props: {
    auth: Boolean,
    user: Object,
  },
  data() {
    return {
      users: [],
      new_user: {
        username: '',
        password: '',
        email: '',
        is_cw: '',
        is_admin: ''
      }
    }
  },
  created() {
      axios.get('http://www.fizzlab.xyz:86/api/api.php/records/users')
      .then(res => {
        this.users = res.data;   
        })
        .catch(err => console.log(err));
  },
  mounted() {
    this.$emit('check-admin-auth-page')
  },
  methods: 
  {
    addUser(formData)
    {
      console.log("Adding new user.." + formData.username);
      let newUserId = 0;
      axios.post
      (
        "http://www.fizzlab.xyz:86/api/api.php/records/users", 
        {
          "username": formData.username,
          "password": formData.password,
          "email": formData.email,
          "is_cw": formData.is_cw,
          "is_admin": formData.is_admin
        }, 
        {
          headers: 
          {
            "Content-Type": "text/plain"
          }
        }
      )
      .then
      (
        (res) => 
        {
          newUserId = res.data;
          let obj = {fname: "first name", lname: "last name", address: "address", zip: "12345", city: "city name", st: "state of residence", phone_num: "phone number"}
          let newUserInfo = JSON.stringify(obj)
          console.log(newUserInfo)
          axios.post
          (
            "http://www.fizzlab.xyz:86/api/api.php/records/user_information/", 
            newUserInfo, 
            {
              headers: 
              {
                "Content-Type": "text/plain"
              }
            }
          )
          .then
          (
            res => 
            {
              axios.put
              (
                "http://www.fizzlab.xyz:86/api/api.php/records/users/"+newUserId, 
                {
                  "info_id": res.data
                }, 
                {
                  headers: 
                  {
                    "Content-Type": "text/plain"
                  }
                }
              )
              .then
              (
                res => 
                {
                  axios.get('http://www.fizzlab.xyz:86/api/api.php/records/users')
                  .then
                  (
                    res => 
                    {
                      this.users = res.data;   
                    }
                  )
                  .catch
                  (
                    err => console.log(err)
                  );
                  formData.username = ''
                  formData.password = ''
                  formData.email = ''
                  formData.is_cw = ''
                  formData.is_admin = ''
                }
              )
              .catch
              (
                e => console.log(err)
              );
            }
          )
          .catch
          (
            e => console.log(err)
          );
        }
      )
      .catch
      (
        err => console.log(err)
      );
    },
    deleteUser(id,info_id) 
    {
      axios.delete("http://www.fizzlab.xyz:86/api/api.php/records/users/"+id)
        .then(res => 
        {
          axios.get('http://www.fizzlab.xyz:86/api/api.php/records/users')
          .then(res => { console.log(this.users); this.users = res.data; console.log(res.data)} )
          .catch( err => console.log(err) );
        })
        //.then(res => this.users.records = this.users.records.filter(user => user.user_id !== id))
        .catch(err => console.log(err));
      axios.delete("http://www.fizzlab.xyz:86/api/api.php/records/user_information/"+info_id)
        .then(res => {})
        .catch(err => console.log(err));
      
      
      console.log("deleted user by id: "+  id + " info id " + info_id);
    },
    getUsers(){
        axios.get('http://www.fizzlab.xyz:86/api/api.php/records/users')
      .then(res => {
        this.users = res.data;   
        })
        .catch(err => console.log(err));
    }
  }
}
</script>
