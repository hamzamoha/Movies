<template>
<div class="col-md-8 col-sm-10 mx-auto my-3 text-center p-2 bg-dark-28">
    <h3 class="py-2">Edit Settings</h3>
    <div v-if="alert" class="alert alert-danger col-lg-6 mx-auto">
        {{alert}}
    </div>
    <div v-if="user" class="col-lg-6 mx-auto">
        <table class="table table-bordered table-striped table-dark user-form">
            <tbody>
                <tr>
                    <td>
                        <div class="input-group mb-4">
                            <span class="input-group-text px-3"><i class="fas fa-font"></i></span>
                            <input id="name" type="text" class="form-control bg-dark-18 text-light" name="name" autocomplete="off" placeholder="Name" :value="user.name" required>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="input-group mb-4">
                            <span class="input-group-text px-3"><i class="fas fa-user"></i></span>
                            <input id="username" type="text" class="form-control bg-dark-18 text-light" name="username" autocomplete="off" placeholder="Username" :value="user.username" required>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="input-group mb-4">
                            <span class="input-group-text px-3"><i class="fas fa-at"></i></span>
                            <input id="email" type="email" class="form-control bg-dark-18 text-light" name="email" autocomplete="off" placeholder="Email" :value="user.email" required>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <router-link class="btn btn-secondary" :to="{ name: 'Settings' }">Cancel</router-link>
                        <button class="btn btn-success" @click="submitSettings">Save</button>
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
            alert: null,
        }
    },
    props: {
        user: Object,
    },
    methods: {
        submitSettings() {
            fetch('/users/me', {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    method: 'PUT',
                    body: JSON.stringify({
                        'name': document.querySelector('input[name=name]').value,
                        'username': document.querySelector('input[name=username]').value,
                        'email': document.querySelector('input[name=email]').value,
                        '_token': document.head.querySelector('meta[name="csrf-token"]').content,
                    })
                })
                .then(res => res.json())
                .then(res => {
                    if(res.message){
                        if(res.errors){
                            this.alert = res.errors.name && res.errors.name[0] || res.errors.username && res.errors.username[0] || res.errors.email && res.errors.email[0] || res.message
                        }
                    }
                    else if(res == 'done') location.href = '/settings'
                })
                .catch(res => console.log(res))
        },
    }
}
</script>
