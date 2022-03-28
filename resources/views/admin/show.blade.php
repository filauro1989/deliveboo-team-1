@extends('layouts.admin.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col d-flex justify-content-center">
                <div class="card w-50 d-flex align-items-center">
                    <h2>Nome Piatto: {{ $dish->name }}</h2>
                    <h2>Categoria: {{ $dish->course()->first()->name }}</h2>
                    <h3>Prezzo:
                        {{ number_format($dish->price, 2) }}
                    </h3>
                    @if ($dish->visible)
                        <h3>Disponibile</h3>
                    @else
                        <h3>Non Disponibile</h3>
                    @endif
                    @if (!empty($dish->image))
                        <img class="img-fluid" src="{{ asset('storage/' . $dish->image) }}" alt="">
                    @else
                        <img class="img-fluid" src="{{ asset('storage/default_images/default-placeholder.png') }}"
                            alt="">
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col d-flex justify-content-center mt-3">
                <a class="btn btn-dark" href="{{ route('admin.dishes.index') }}">Back</a>
            </div>
        </div>
    </div>
@endsection
