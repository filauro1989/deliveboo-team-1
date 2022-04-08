@extends('layouts.guest.app')

@section('content')
    <div class="container mt-2">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Registrazione') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            {{-- Restaurant Name --}}
                            <div class="form-group row">
                                <label for="restaurant_name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Nome Attività') }}</label>

                                <div class="col-md-6">
                                    <input id="restaurant_name" type="text"
                                        class="form-control @error('restaurant_name') is-invalid @enderror"
                                        name="restaurant_name" value="{{ old('restaurant_name') }}" required
                                        autocomplete="restaurant_name" autofocus maxlength="255" minlength="2">
                                    @error('restaurant_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Categories --}}
                            <div>Scegli la categoria del ristorante</div>
                            @foreach ($categories as $category)
                                <div required class="btn-group mb-1" role="group"
                                    aria-label="Basic checkbox toggle button group">

                                    <input type="checkbox" class="btn-check my_btn-check"
                                        id="{{ 'btncheck' . $category->id }}" autocomplete="off" name="categories[]"
                                        value="{{ $category->id }}"
                                        {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}>

                                    <label class="btn btn-outline-primary"
                                        for="{{ 'btncheck' . $category->id }}">{{ $category->name }}</label>

                                </div>
                            @endforeach

                            <div id="message"></div>

                            @error('categories')
                                <div class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror


                            {{-- Email Address --}}
                            <div class="form-group row mt-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo E-Mail') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" autocomplete="email" required>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Street Address --}}
                            <div class="form-group row">
                                <label for="address"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo Attività') }}</label>

                                <div class="col-md-6">
                                    <input id="address" type="text"
                                        class="form-control @error('address') is-invalid @enderror" name="address"
                                        value="{{ old('address') }}" autocomplete="address" maxlength="255"
                                        minlength="10" required>

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Phone Number --}}
                            <div class="form-group row">
                                <label for="phone"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Numero di Telefono') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror"
                                        name="phone" value="{{ old('phone') }}" required autocomplete="phone"
                                        minlength="7" pattern="^\S+$">

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- VAT --}}
                            <div class="form-group row">
                                <label for="vat" class="col-md-4 col-form-label text-md-right">{{ __('P.Iva') }}</label>

                                <div class="col-md-6">
                                    <input id="vat" type="text" class="form-control @error('vat') is-invalid @enderror"
                                        name="vat" value="{{ old('vat') }}" required autocomplete="vat" maxlength="11"
                                        minlength="11" pattern="^\S+$">

                                    @error('vat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Password --}}
                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password" minlength="8" maxlength="255">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Password Confirm --}}
                            <div class="form-group row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Conferma Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password" minlength="8"
                                        maxlength="255">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Carica immagine dell'attività</label>
                                <input class="form-control" accept="image/*" type="file" id="image" name="image">
                                @error('image')
                                    <div class="alert alert-danger mt-3">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Register Button --}}
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button id="register-button" type="submit" class="btn my_btn-register">
                                        {{ __('Registrati') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.onload = () => {

            let checkboxes = document.querySelectorAll('input[type=checkbox]');
            let message = document.getElementById('message');
            let register = document.getElementById('register-button');

            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('click', function() {
                    message.innerHTML = '';
                });
            });

            register.addEventListener('click', function() {
                let atLeastOneChecked = false;

                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        atLeastOneChecked = true;
                    }
                })
                if (!atLeastOneChecked) {

                    message.innerHTML =
                        `<div class="alert alert-danger mt-3" role="alert">Scegli almeno una Categoria</div>`;
                    return false;
                }
            });
        }
    </script>
@endsection
