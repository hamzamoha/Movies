@extends('template.index')

@section('content')
<div class="justify-content-center bg-popcorn">
    <div class="col-4 mx-auto card card-body bg-dark-28 mt-5 mb-3 shadow-xl">
        <h2 class="py-3 mb-3 text-center">
            Register
        </h2>
        <div class="text-center line-behind mb-4">
            <span class="bg-dark-28 px-2 h5">Please Enter Your Informations</span>
        </div>
        <form method="POST" class="login-form" autocomplete="off">
            @csrf
            <label for="name" class="form-label">Name</label>
            <div class="input-group mb-4">
                <span class="input-group-text px-3"><i class="fas fa-font"></i></span>
                <input id="name" value="{{ old('name') }}" type="text" class="form-control bg-dark-18 text-light @error('name'){{('border-danger')}}@else{{('border-light')}}@enderror" name="name" placeholder="Type Your Name">
            </div>
            @error('name')
            <div class="mb-3 text-danger">
                {{ $message }}
            </div>
            @enderror
            <label for="email" class="form-label">Email</label>
            <div class="input-group mb-4">
                <span class="input-group-text px-3"><i class="fas fa-at"></i></span>
                <input id="email" value="{{ old('email') }}" type="email" class="form-control bg-dark-18 text-light @error('email'){{('border-danger')}}@else{{('border-light')}}@enderror" name="email" placeholder="Enter Your Email Address">
            </div>
            @error('email')
            <div class="mb-3 text-danger">
                {{ $message }}
            </div>
            @enderror
            <label for="username" class="form-label">Username</label>
            <div class="input-group mb-4">
                <span class="input-group-text px-3"><i class="fas fa-user"></i></span>
                <input id="username" value="{{ old('username') }}" type="text" class="form-control bg-dark-18 text-light @error('username'){{('border-danger')}}@else{{('border-light')}}@enderror" name="username" placeholder="Pick a Username">
            </div>
            @error('username')
            <div class="mb-3 text-danger">
                {{ $message }}
            </div>
            @enderror
            <label for="password" class="form-label">Password</label>
            <div class="input-group mb-4">
                <span class="input-group-text px-3"><i class="fas fa-key"></i></span>
                <input id="password" type="password" class="form-control bg-dark-18 text-light @error('password'){{('border-danger')}}@else{{('border-light')}}@enderror" name="password" placeholder="Enter a Password">
            </div>
            @error('password')
            <div class="mb-3 text-danger">
                {{ $message }}
            </div>
            @enderror
            <label for="password_confirmation" class="form-label">Confirm Your Password</label>
            <div class="input-group mb-4">
                <span class="input-group-text px-3"><i class="fas fa-key"></i></span>
                <input id="password_confirmation" type="password" class="form-control bg-dark-18 text-light @error('password_confirmation'){{('border-danger')}}@else{{('border-light')}}@enderror" name="password_confirmation" placeholder="Re-enter Your Password">
            </div>
            @error('password_confirmation')
            <div class="mb-3 text-danger">
                {{ $message }}
            </div>
            @enderror
            <div class="mb-3">
                <input type="checkbox" name="remember" id="remember" class="form-check-input" @if (old('remember')){{('checked')}}@endif>
                <label for="remember" class="cursor-pointer">Remember me</label>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary w-100">Sign up</button>
            </div>
            <div class="mb-3 text-center">
                Already have an account? <a href="{{ route('login') }}">Sign in</a>
            </div>
        </form>
    </div>
</div>
@endsection
