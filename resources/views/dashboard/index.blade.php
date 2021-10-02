@extends('template.index')

@section('content')
<div id="dashboard" class="container">
    <div class="card card-body bg-dark my-3">
        <ul class="nav nav-tabs">
            <li class="me-2 nav-item">
                <router-link :to="{ name: 'Index' }" class="nav-link">Index</router-link>
            </li>
            <li class="me-2">
                <router-link :to="{ name: 'Movies' }" class="nav-link">Movies</router-link>
            </li>
        </ul>
        <router-view></router-view>
        <keep-alive>
            <router-view name='Movies'></router-view>
        </keep-alive>
    </div>
</div>
<script src="{{ asset('js/dashboard.js') }}"></script>
@endsection