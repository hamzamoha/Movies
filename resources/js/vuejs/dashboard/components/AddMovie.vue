<template>
<div class="my-3">
    <div class="display-4 text-center py-2">Add Movie</div>
    <div class="my-3">
        <label for="query" class="form-label h4">Type your movie name</label>
    </div>
    <div class="mb-3 input-group">
        <input type="text" autocomplete="off" @input="page = 1;
search();" name="query" id="query" class="form-control bg-dark-18 text-light outline-none" v-model="query" placeholder="Start typing...">
        <span class="input-group-text"><i class="fas fa-search"></i></span>
    </div>
    <div class="text-center py-5 loading" v-if="loading">
        <i class="fas fa-spinner"></i>
    </div>
    <div class="alert alert-danger" v-if="alert && !loading && movies.length == 0">
        {{ alert }}
    </div>
    <div v-if="movies.length > 0 && !loading" class="movies row col-lg-10 mx-auto g-3 my-2 justify-content-center">
        <div class="col-12 text-center h5 py-2">
            Found: {{ movie_count }}
        </div>
        <div class="col-lg-3 row justify-content-center my-2" v-for="movie in movies" :key="movie.id">
            <div class="movie col-10 mb-2">
                <router-link class="mx-auto d-block btn btn-success mb-2" :to="{name: 'SubmitMovie', params: {id: movie.id}}">Add</router-link>
                <img :src="movie.medium_cover_image" :alt="movie.title_english" class="img-thumbnail bg-success border-success">
            </div>
            <h5 class="text-center">{{ movie.title }} ({{movie.year}})</h5>
        </div>
        <div class="col-12 text-center" v-if="load_more && movies.length > 0">
            <button @click="page++;search();load_more = false;" class="btn text-light btn-success"><i class="fas fa-angle-double-down me-1"></i>Load More</button>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: {},
    data() {
        return {
            query: "",
            loading: false,
            alert: false,
            movies: [],
            page: 1,
            load_more: false,
            movie_count: 0,
        }
    },
    methods: {
        search() {
            if (this.query == "") {
                this.alert = false
                this.movies = []
                return
            }
            this.page == 1 && (this.loading = true)
            this.alert = false
            fetch('https://yts.mx/api/v2/list_movies.json?sort_by=year&query_term=' + encodeURI(this.query) + '&limit=8&page=' + this.page)
                .then(res => res.json())
                .then(res => {
                    if (res.status == 'ok') {
                        this.movie_count = res.data.movie_count
                        if (res.data.movie_count == 0) {
                            this.movies = []
                            this.alert = 'No Result Found'
                            this.load_more = false
                            return;
                        }
                        if (this.page == 1) this.movies = [...res.data.movies];
                        else this.movies = [...this.movies, ...res.data.movies];
                    } else {
                        this.alert = res.status_message
                        this.movies = []
                    }
                    if (res.data.movie_count > res.data.limit * res.data.page_number) this.load_more = true
                })
                .then(r => {
                    setTimeout(() => { this.loading = false }, 2000)
                })
                .catch(e => {
                    console.log(e)
                    setTimeout(() => { this.loading = false }, 2000)
                })
        }
    }
}
</script>
