@extends('template.index')

@section('content')
<div class="justify-content-center bg-popcorn">
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger col-md-4 mt-2 mx-auto">{{$error}}</div>
    @endforeach
    @endif
    @if(session('error'))
    <div class="alert alert-danger col-md-4 mt-2 mx-auto">{{session('error')}}</div>
    @endif
    <div class="col-md-4 mx-auto card card-body bg-dark-28 mt-5 mb-3 shadow-xl">
        <h2 class="py-3 mb-3 text-center">
            Login
        </h2>
        <div class="text-center line-behind mb-4">
            <span class="bg-dark-28 px-2 h5">Please Enter Your Informations</span>
        </div>
        <form method="POST" class="login-form" autocomplete="off">
            @csrf
            <div class="input-group mb-4">
                <span class="input-group-text px-3"><i class="fas fa-user"></i></span>
                <input id="username" value="{{ old('username') }}" type="text" class="form-control bg-dark-18 text-light @error('username'){{('border-danger')}}@else{{('border-light')}}@enderror" name="username" placeholder="username">
            </div>
            @error('username')
            <div class="mb-3 text-danger">
                {{ $message }}
            </div>
            @enderror
            <div class="input-group mb-4">
                <span class="input-group-text px-3"><i class="fas fa-key"></i></span>
                <input id="password" type="password" class="form-control bg-dark-18 text-light @error('password'){{('border-danger')}}@else{{('border-light')}}@enderror" name="password" placeholder="password">
            </div>
            @error('password')
            <div class="mb-3 text-danger">
                {{ $message }}
            </div>
            @enderror
            <div class="mb-3">
                <input type="checkbox" name="remember" id="remember" class="form-check-input">
                <label for="remember" class="cursor-pointer">Remember me</label>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary w-100">Sign in</button>
            </div>
            <div class="mb-3 text-center">
                or <a href="{{ route('register') }}">Create an Account</a>
            </div>
        </form>
    </div>
</div>
@endsection
