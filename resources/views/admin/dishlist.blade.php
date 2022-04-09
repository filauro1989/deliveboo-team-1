@extends('layouts.admin.dashboard')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="">
        <div class="row g-0 row-cols-1 row-cols-md-2 row-cols-lg-4">
            {{-- @foreach ($dishes as $dish)
                <div class="col mb-2">
                    <div class="card m-2 rounded overflow-hidden h-100" style="max-width: 400px;">
                        <div class="dish-img-wrapper"
                            style="background: url({{ asset('storage/' . $dish->image) }}); background-size: cover; background-position: center; background-repeat: no-repeat">
                            
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
            @endforeach --}}

            <table class="table table-responsive-xl">
						  <thead>
						    <tr>
						    	<th>Immagine</th>
						      <th>Nome</th>
						      {{-- <th>Categoria</th> --}}
						      <th>Prezzo</th>
						      <th>Status</th>
						      <th>Azioni</th>
						    </tr>
						  </thead>
						  <tbody>
                            @foreach ($dishes as $dish)
                                <tr class="alert" role="alert">
                                    <td>
                                        <img class="table-img" src="{{ asset('storage/' . $dish->image) }}" alt="">
                                    </td>
                                    <td>
                                        {{ $dish->name }}
                                    </td>
                                    {{-- <td>
                                        {{ $dish->course->name }}
                                    </td> --}}
                                    <td>{{ number_format($dish->price, 2) }} &#8364;</td>
                                    <td class="status">
                                        @if ($dish->visible)
                                            <span class="status-green">Disponibile</span>
                                        @else
                                            <span class="status-red">Non Disponibile</span>
                                        @endif
                                        
                                    </td>
                                    <td>
                                        <a class="btn  rounded-pill btn-outline-info " href="{{ route('admin.dishes.show', $dish->slug) }}">Visualizza
                                        Piatto</a>
                                        <a class="btn btn-info rounded-pill text-white" href="{{ route('admin.dishes.edit', $dish) }}">Modifica</a>
                                        <button type="button" class="btn btn-danger rounded-pill text-white" data-bs-toggle="modal"
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

                                                            <input class="btn btn-danger text-white" type="submit" value="Elimina">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td> 
                                </tr>
						    @endforeach
						  </tbody>
						</table>
        </div>

        
    </div>
@endsection
