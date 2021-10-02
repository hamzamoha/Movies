<template>
<div class="col-md-8 col-sm-10 mx-auto my-3 text-center p-2 bg-dark-28">
    <h3 class="py-2">Change Password</h3>
    <div v-if="alert" class="alert alert-danger col-lg-6 mx-auto">
        {{alert}}
    </div>
    <div v-if="user" class="col-lg-6 mx-auto">
        <table class="table table-bordered table-striped table-dark">
            <tbody>
                <tr>
                    <td>
                        <div class="input-group mb-4">
                            <span class="input-group-text px-3"><i class="fas fa-font"></i></span>
                            <input id="current_password" type="password" class="form-control bg-dark-18 text-light" name="current_password" placeholder="Current Password" v-model="passwords.current">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="input-group mb-4">
                            <span class="input-group-text px-3"><i class="fas fa-user"></i></span>
                            <input id="password" type="password" class="form-control bg-dark-18 text-light" name="password" placeholder="New Password" v-model="passwords.password">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="input-group mb-4">
                            <span class="input-group-text px-3"><i class="fas fa-at"></i></span>
                            <input id="password_confirmation" type="password" class="form-control bg-dark-18 text-light" name="password_confirmation" placeholder="Confirm Your Password" v-model="passwords.confirmation">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <router-link class="btn btn-secondary" :to="{ name: 'Settings' }">Cancel</router-link>
                        <button @click="submitPassword" class="btn btn-success">Save</button>
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
    data() {
        return {
            passwords: {
                current: '',
                password: '',
                confirmation: '',
            },
            alert: null,
        }
    },
    props: {
        user: Object,
    },
    beforeMount() {},
    methods: {
        submitPassword() {
            this.alert = null
            fetch('/users/me/password', {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    method: 'PUT',
                    body: JSON.stringify({
                        'current_password': this.passwords.current,
                        'password': this.passwords.password,
                        'password_confirmation': this.passwords.confirmation,
                        '_token': document.head.querySelector('meta[name="csrf-token"]').content,
                    })
                })
                .then(res => res.json())
                .then(res => {
                    if (res.message) {
                        if (res.errors) setTimeout(() => {
                            this.alert = res.errors.current_password && res.errors.current_password[0] || res.errors.password && res.errors.password[0] || res.errors.password_confirmation && res.errors.password_confirmation[0] || res.message
                        }, 600)
                        else setTimeout(() => { this.alert = res.message }, 600)
                    } else if (res == 'done') location.href = '/settings'
                })
                .catch(res => console.log(res))
        },
    }
}
</script>
