<template>
    <div class = "uk-width-expand@m uk-flex-center uk-text-center">
        <h1 class="uk-heading-divider">Account Information</h1>
        <table class="uk-table uk-table-striped uk-text-left">
            <tbody >
                <tr>
                    <td class="fieldName"><b>First Name:</b></td>
                    <td>{{ user_info.fname }}</td>
                    <td class="fieldName"><b>Last Name:</b></td>
                    <td>{{ user_info.lname }}</td>
                </tr>
                <tr>
                    <td class="fieldName"><b>Address:</b></td>
                    <td>{{ user_info.address }}</td>
                    <td class="fieldName"><b>Zip:</b></td>
                    <td>{{ user_info.zip }}</td>
                </tr>
                <tr>
                    <td class="fieldName"><b>City:</b></td>
                    <td>{{ user_info.city }}</td>
                    <td class="fieldName"><b>State:</b></td>
                    <td>{{ user_info.st }}</td>
                </tr>
                <tr>
                    <td class="fieldName"><b>Email:</b></td>
                    <td>{{ user.email }}</td>
                    <td class="fieldName"><b>Phone:</b></td>
                    <td>{{ user_info.phone_num }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
  name: 'SettingsAccountInfo',
  props: {
      user_info: Array,
      user: Object,
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.fieldName {
    text-align: left;
    vertical-align: middle;
}
</style>