window.Vue = require('vue').default;

const app = new Vue({
    el: '#movie',
    methods: {
        add_to_favorites(id) {
            fetch('/movies/favorites/add', {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    method: 'POST',
                    body: JSON.stringify({
                        '_token': document.head.querySelector('meta[name="csrf-token"]').content,
                        'movie_id': id,
                    })
                })
                .then(res => { location.reload() });
        },
        remove_favorite(id) {
            fetch('/movies/favorites/remove', {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    method: 'POST',
                    body: JSON.stringify({
                        '_token': document.head.querySelector('meta[name="csrf-token"]').content,
                        'movie_id': id,
                    })
                })
                .then(res => { location.reload() });
        },
        remove_watch_later(id) {
            fetch('/movies/watch_later/remove', {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    method: 'POST',
                    body: JSON.stringify({
                        '_token': document.head.querySelector('meta[name="csrf-token"]').content,
                        'movie_id': id,
                    })
                })
                .then(res => { location.reload() });
        },
        add_to_watch_later(id) {
            fetch('/movies/watch_later/add', {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    method: 'POST',
                    body: JSON.stringify({
                        '_token': document.head.querySelector('meta[name="csrf-token"]').content,
                        'movie_id': id,
                    })
                })
                .then(res => { location.reload() });
        },
        mark_as_watched(id) {
            fetch('/movies/watch_later/watched', {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    method: 'POST',
                    body: JSON.stringify({
                        '_token': document.head.querySelector('meta[name="csrf-token"]').content,
                        'movie_id': id,
                    })
                })
                .then(res => { location.reload() });
        },
        mark_as_unwatched(id) {
            fetch('/movies/watch_later/unwatched', {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    method: 'POST',
                    body: JSON.stringify({
                        '_token': document.head.querySelector('meta[name="csrf-token"]').content,
                        'movie_id': id,
                    })
                })
                .then(res => { location.reload() });
        }
    }
});