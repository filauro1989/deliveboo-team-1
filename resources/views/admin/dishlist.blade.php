@extends('layouts.admin.dashboard')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="d-flex align-items-start flex-wrap">
        @foreach ($dishes as $dish)
            <div class="card mb-3" style="max-width: 400px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        @if (!empty($dish->image))
                            <img class="img-fluid" src="{{ asset('storage/' . $dish->image) }}"
                                alt="{{ $dish->image }}">
                        @else
                            <img class="img-fluid" src="{{ asset('storage/default_images/default-placeholder.png') }}"
                                alt="no-photo">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $dish->name }}</h5>
                            <span class="card-title">{{ $dish->course->name }}</span>
                            <p class="card-text">{{ $dish->description }}</p>
                            <h6 class="card-title">{{ number_format($dish->price, 2) }}</h6>
                            @if ($dish->visible)
                                <div class="alert alert-success">Disponibile</div>
                            @else
                                <div class="alert alert-danger">Non Disponibile</div>
                            @endif
                            <a class="btn btn-info" href="{{ route('admin.dishes.edit', $dish) }}">Modifica</a>
                            <form method="POST" action="{{ route('admin.dishes.destroy', $dish) }}">
                                @csrf
                                @method("DELETE")

                                <input class="btn btn-danger" type="submit" value="Elimina">
                            </form>
                            <a class="btn btn-info" href="{{ route('admin.dishes.show', $dish) }}">Visualizza
                                Piatto</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
