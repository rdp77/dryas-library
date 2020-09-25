@extends('layouts.auth')

@section('title', __('Dryas Library | Login'))
@section('pageTitle', __('Login'))
@section('content')
<div class="alert alert-light" role="alert">
    <h4 class="alert-heading">{{ __('Welcome!') }}</h4>
    <div class="row">
        <div class="col">
            <p><b>{{ __('Admin') }}</b><br>
                {{ __('username: admin@admin.com') }}<br>
                {{ __('password: 123123123') }}
            </p>
        </div>
        <div class="col">
            <p><b>{{ __('User') }}</b><br>
                {{ __('username: user@user.com') }}<br>
                {{ __('password: 12345678') }}
            </p>
        </div>
    </div>
</div>
<form method="POST" action="{{ route('login') }}" class="contact-from">
    @csrf
    <div class="row">
        <div class="col-md-12">
            {{-- Email --}}
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autocomplete="email" placeholder="Your e-mail" autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            {{-- Password --}}
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="current-password" placeholder="Your Password">
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <button type="submit" class="site-btn mt-3">{{ __('Login') }}</button>
        </div>
    </div>
</form>
@endsection
@section('notice')
<p>{{ ('If you don\'t have an account, click ') }}<a href="{{ route('register') }}">{{ ('here') }}</a>
    {{__(' to start creating new account.')}}
</p>
@endsection