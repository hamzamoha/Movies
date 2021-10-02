<template>
<div class="col-md-8 col-sm-10 mx-auto my-3 text-center p-2 bg-dark-28">
    <h3 class="py-2">Settings</h3>
    <div v-if="user" class="col-lg-6 mx-auto">
        <table class="table table-bordered table-striped table-dark">
            <tbody>
                <tr>
                    <th>Name:</th>
                    <td>{{user.name}} ({{user.user_type}})</td>
                </tr>
                <tr>
                    <th>Username:</th>
                    <td>{{user.username}}</td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td>{{user.email}}</td>
                </tr>
                <tr>
                    <th>Joined:</th>
                    <td>{{user.created_at_str}}</td>
                </tr>
                <tr>
                    <th>Last Edit:</th>
                    <td>{{user.updated_at_str}}</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <router-link class="btn btn-info" :to="{name: 'EditSettings'}">Edit Info</router-link>
                        <router-link class="btn btn-black" :to="{name: 'EditPassword'}">Edit Password</router-link>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div v-else class="loading">
        <i class="fas fa-spinner"></i>
    </div>
</div>
</template>

<script>
export default {
    props: {
        user: Object,
    },
};
</script>
