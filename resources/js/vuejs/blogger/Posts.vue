<template>
<div class="posts col-md-8 mx-auto">
    <h1 class='text-center display-3 py-3'>
        Posts
    </h1>
    <div class="text-dark">
        <div v-for="post of posts" :key="post.id.$t" class="card my-2">
            <div class="card-header" :set="d = new Date(post.published.$t)">
                <i class="far fa-calendar"></i> {{ d.toDateString() }} <span v-html="'&#8212;'"></span> <i class="far fa-clock"></i> {{ formatAMPM(d)  }}
            </div>
            <div class="row g-0">
                <div class="col-md-4">
                    <img :src='(post.media$thumbnail)?post.media$thumbnail.url.replace("s72-w640-h360-c", "w500").replace("/s72-c/", "/w500/").replace("/s72/", "/w500/"):""' class="card-img-top object-fit-cover h-md-100" :alt="(post.title) ? post.title.$t: ''">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h3>{{ (post.title)?post.title.$t:'' }}</h3>
                        <p>{{ (post.summary)?post.summary.$t:'' }}</p>
                        <a :href="post.link[4].href" class="btn btn-beauty">Read More</a>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a v-for="category of post.category" :key="category.term" :href="`/search/label/${category.term}?max-results=8`" class="btn btn-light border me-2">{{ category.term }}</a>
            </div>
        </div>
    </div>
    <div class='loading' v-if="loading">
        <i class='fas fa-spinner'></i>
    </div>
    <div id='load_more' class="text-center py-3" v-if="load_more">
        <button class="btn btn-primary" @click="start_index += max_results; fetch_posts();">Load More</button>
    </div>
</div>
</template>

<script>
export default {
    name: 'Posts',
    data() {
        return {
            loading: false,
            load_more: false,
            posts: [],
            posts_count: 0,
            start_index: 1,
            max_results: 3,
        }
    },
    methods: {
        fetch_posts() {
            fetch(`/feeds/posts/default?alt=json&start-index=${this.start_index}&max-results=${this.max_results}`, {
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    }
                })
                .then(res => res.json())
                .then(res => {
                    this.posts = [...this.posts, ...res.feed.entry]
                    this.posts_count = parseInt(res.feed.openSearch$totalResults.$t)
                    if(this.start_index + res.feed.entry.length <= this.posts_count) this.load_more = true
                    else this.load_more = false
                })
                .catch(e => console.log(e))
        },
        formatAMPM(date) {
            var hours = date.getHours();
            var minutes = date.getMinutes();
            var ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            minutes = minutes < 10 ? '0' + minutes : minutes;
            var strTime = hours + ':' + minutes + ' ' + ampm;
            return strTime;
        },
        
    },
    beforeMount() {
        this.fetch_posts()
    }
}
</script>
