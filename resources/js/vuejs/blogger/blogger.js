window.Vue = require('vue').default;

import Posts from './Posts'

const app = new Vue({
    el: '#blogger_posts_app',
    components: {
        Posts,
    }
});