@extends('layouts.app')

@section('content')
    <div class="container-login mt-0">
        <div class="top-login"></div>
        <div class="bottom-login"></div>
        <div class="center-login mb-5">
            <div class="img-login-container">
                <img class="login-img" src="{{ asset('/storage/default_images/MyDeliveboo10sBlue-unscreen.gif') }}"
                    alt="DeliveBoo Logo">
            </div>
            <form class="position-relative" method="POST" action="{{ route('login') }}">
                @csrf
                <label for="email">{{ __('E-mail') }}</label>
                <input class="my_input" id="email" type="email" @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <label for="password">{{ __('Password') }}</label>
                <input class="my_input" id="password" type="password" @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="mt-2">
                    <button type="submit" class="btn my_btn-login">
                        {{ __('Login') }}
                    </button>
                    <a class="btn my_btn-login" href="{{ url('/') }}">
                        {{ __('Indietro') }}
                    </a>
                    <a class="btn btn-link" href="{{ route('register') }}">
                        {{ __('Non sei registrato?') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
