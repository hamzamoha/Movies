<template>
<div class="">
    <div v-if="movies.length > 0">
        <div class="text-center my-3">
            <router-link :to="{ name: 'AddMovie' }" class="btn btn-info"><i class="fas fa-plus" /> New</router-link>
        </div>
        <table class="table table-bordered table-striped table-dark text-center my-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Poster</th>
                    <th>Title</th>
                    <th>Links</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="movie in movies" :key="movie.id">
                    <td>{{movie.id}}</td>
                    <td><img :src="'/images/movies/' + movie.cover" :alt="movie.title"></td>
                    <td>{{movie.title}} ({{movie.year}})</td>
                    <td><a :href="'https://www.imdb.com/title/' + movie.imdb_code" class="btn btn-warning" target="_blank">IMDb</a></td>
                    <td>
                        <button class="btn btn-primary btn-sm">Edit url</button>
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="py-2 text-center" v-if="load_more">
            <button @click="load_movies()" class="btn btn-info">More</button>
        </div>
    </div>
    <div class="py-5 h4 text-light" v-else>
        No Movies in the database
    </div>
    <div class="text-center py-5 loading" v-if="loading">
        <i class="fas fa-spinner"></i>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            movies: [],
            current_page: 1,
            load_more: false,
            loading: false,
        }
    },
    methods: {
        load_movies() {
            this.loading = true
            fetch('/movies?page='+this.current_page, {
                    headers: {
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(res => {
                    this.movies = [...this.movies, ...res.data]
                    if (this.current_page++ < res.last_page) {
                        this.load_more = true
                    } else this.load_more = false
                })
                .catch(e => console.log(e))
            setTimeout(() => { this.loading = false }, 800)
        }
    },
    beforeMount() {
        this.load_movies()
    }
}
</script>

<style scoped>
img {
    height: 50px;
}
</style>
