<template>
<div>
    <div class="row my-3">
        <div class="col-6">
            <div class="card card-body bg-dark-18 card-border-danger border-0">
                <div class="d-flex align-items-start">
                    <div class="flex-grow-1">
                        <h3>{{ movies_count }}</h3>
                        <p>{{ (movies_count==1)?'Movie':'Movies' }}</p>
                    </div>
                    <div class="d-inline-block">
                        <div class="card-logo">
                            <i class="fas fa-film"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-3">
                <router-link :to="{ name: 'AddMovie' }" class="btn border text-light hover-light">+ Add Movie</router-link>
            </div>
        </div>
        <div class="col-6">
            <div class="card card-body bg-dark-18 card-border-success border-0">
                <div class="d-flex align-items-start">
                    <div class="flex-grow-1">
                        <h3>{{ users_count }}</h3>
                        <p>{{ (users_count==1)?'User':'Users' }}</p>
                    </div>
                    <div class="d-inline-block">
                        <div class="card-logo">
                            <i class="fas fa-user"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-3">
                <router-link to="Users" class="btn border text-light hover-light">List All Users</router-link>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: 'Index',
    data() {
        return {
            movies_count: (Vue.prototype.$movies_count)?Vue.prototype.$movies_count:0,
            users_count: (Vue.prototype.$users_count)?Vue.prototype.$users_count:0,
        }
    },
    beforeMount() {
        fetch('/users/count', {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                }
            })
            .then(res => res.json())
            .then((res) => {
                console.log(res)
                this.users_count = Vue.prototype.$users_count = res
            })
            .catch(e => console.log(e))
        fetch('/movies/count', {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                }
            })
            .then(res => res.json())
            .then((res) => {
                console.log(res)
                this.movies_count = Vue.prototype.$movies_count = res
            })
            .catch(e => console.log(e))
    }
}
</script>
