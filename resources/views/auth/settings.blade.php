@extends('template.index')

@section('content')
<div class="row g-0" id="settings">
    <router-view :user="user"></router-view>
</div>
<script src="/js/settings.js"></script>
@endsection