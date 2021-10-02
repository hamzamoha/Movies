<template>
<div class="text-center my-2">
    <div class="text-center py-5 loading" v-if="loading">
        <i class="fas fa-spinner"></i>
    </div>
    <div class="alert alert-warnign" v-if="alert && !loading">
        {{alert}}
    </div>
    <div v-if="!loading">
        <img :src="movie.cover" :alt="movie.title" class="d-block mx-auto img-thumbnail">
        <div class="py-2">
            <span class="h1">
                {{ movie.title }} ({{movie.year}})
            </span>
            <span class="h5 btn btn-warning ">
                {{ movie.rating }}/10
            </span>
        </div>
        <p class="h4 text-center py-2 col-md-8 mx-auto">{{ movie.summary }}</p>
        <div class="my-2">
            <button class="btn btn-secondary">Cancel</button>
            <button class="btn btn-success" @click="submitMovie">Submit</button>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            movie_id: this.$route.params.id,
            movie: {},
            loading: false,
            alert: false,
        }
    },
    methods: {
        getMovie() {
            this.loading = true
            if (this.movie_id == 0 || !isNaN(parseInt('this.movie_id'))) this.$router.push({ name: 'Index' })
            fetch('https://yts.mx/api/v2/movie_details.json?movie_id=' + this.movie_id)
                .then(res => res.json())
                .then(res => {
                    if (res.data.movie.id == 0) this.$router.push({ name: 'Index' })
                    let movie = res.data.movie
                    this.movie.imdb_code = movie.imdb_code
                    this.movie.title = movie.title
                    this.movie.year = movie.year
                    this.movie.rating = movie.rating
                    this.movie.runtime = movie.runtime
                    this.movie.genres = movie.genres
                    this.movie.summary = movie.description_intro
                    this.movie.cover = movie.large_cover_image
                    this.movie.trailer_code = movie.yt_trailer_code
                })
                .then(res => {
                    setTimeout(() => { this.loading = false }, 1500)
                })
                .catch(e => {
                    this.alert = "Error"
                    this.loading = false
                    console.log(e)
                })
        },
        submitMovie() {
            this.loading = true
            this.movie._token = document.head.querySelector('meta[name="csrf-token"]').content
            fetch('/movies/', {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    method: 'POST',
                    body: JSON.stringify(this.movie)
                })
                .then(res => {
                    if (res.status == 200) this.$router.push({ name: 'Movies' });
                    else if (res.status == 422) this.alert = "The movies was not added successfully, it could be duplicated"
                    else this.alert = res.json()
                    setTimeout(() => { this.loading = false }, 1500)
                })
                .catch(e => console.log(e))
        }
    },
    beforeMount() {
        this.getMovie()
    }
}
</script>
