@extends('layouts.admin.dashboard')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="">
        <div class="row g-0 row-cols-1 row-cols-md-2 row-cols-lg-4">
            @foreach ($dishes as $dish)
                <div class="col mb-2">
                    <div class="card m-2 rounded overflow-hidden h-100" style="max-width: 400px;">
                        <div class="dish-img-wrapper"
                            style="background: url({{ asset('storage/' . $dish->image) }}); background-size: cover; background-position: center; background-repeat: no-repeat">
                            {{-- @if (!empty($dish->image))
                            <img class="img-fluid" alt="{{ $dish->image }}"> --}}
                            {{-- @else
                            <img class="img-fluid" src="{{ asset('storage/default_image.jpg') }}" alt="no-photo"> --}}
                            {{-- @endif --}}
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $dish->name }}</h5>
                            <span class="card-title">{{ $dish->course->name }}</span>
                            <p class="card-text">{{ $dish->description }}</p>
                            <h6 class="card-title">{{ number_format($dish->price, 2) }} &#8364;</h6>
                            @if ($dish->visible)
                                <div class="alert alert-success">Disponibile</div>
                            @else
                                <div class="alert alert-danger">Non Disponibile</div>
                            @endif
                            <a class="btn btn-info" href="{{ route('admin.dishes.edit', $dish) }}">Modifica</a>

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteConfirmation{{ $dish->slug }}">
                                Elimina
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="deleteConfirmation{{ $dish->slug }}" data-bs-backdrop="static"
                                tabindex="-1" aria-labelledby="deletePopup{{ $dish->slug }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deletePopup{{ $dish->slug }}">Attenzione</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Sei sicuro di cancellare {{ $dish->name }} ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Annulla</button>
                                            <form method="POST"
                                                action="{{ route('admin.dishes.destroy', $dish->slug) }}">
                                                @csrf
                                                @method("DELETE")

                                                <input class="btn btn-danger" type="submit" value="Elimina">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a class="btn btn-info mt-2" href="{{ route('admin.dishes.show', $dish->slug) }}">Visualizza
                                Piatto</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- <section class="wrapper">
            <div class="container">
                <div class="row row-cols-5">
                    @foreach ($dishes as $dish)
                        <div class="col">
                            <div class="card text-white card-has-bg click-col"
                                style="background-image:url({{ asset('storage/' . $dish->image) }});">
                                <img class="card-img d-none" src="https://source.unsplash.com/600x900/?tech,street"
                                    alt="Goverment Lorem Ipsum Sit Amet Consectetur dipisi?">
                                <div class="card-img-overlay d-flex flex-column">
                                    <div class="card-body">
                                        <h4 class="card-title mt-0 fw-bold text-uppercase"><a class="text-white"
                                                herf="#">{{ $dish->name }}</a></h4>
                                        <small>{{ $dish->description }}</small>
                                    </div>
                                    <div class="card-footer">
                                        <div class="media">
                                            <img class="mr-3 rounded-circle"
                                                src="https://cdn0.iconfinder.com/data/icons/user-pictures/100/male-512.png"
                                                alt="Generic placeholder image" style="max-width:50px">
                                            <div class="media-body">
                                                <h6 class="my-0 text-white d-block">Oz COruhlu</h6>
                                                <small>Director of UI/UX</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>
        </section> --}}
    </div>
@endsection
