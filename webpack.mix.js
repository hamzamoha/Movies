const mix = require('laravel-mix');

mix.disableNotifications();

mix.exports = {
    mode: 'production'
}

mix
    .js('resources/js/vuejs/blogger/blogger.js', 'public/js')
    .vue();