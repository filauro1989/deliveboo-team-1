@extends('layouts.admin.dashboard')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="d-flex align-items-start flex-wrap">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Email Cliente</th>
                    <th scope="col">Nome Cognome</th>
                    <th scope="col">Indirizzo spedizione</th>
                    <th scope="col">Metodo di Pagamento</th>
                    <th scope="col">Totale Ordine</th>
                    <th scope="col">Data</th>
                    <th scope="col">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->customer_email }}</td>
                        <td>{{ $order->first_name . ' ' . $order->last_name }}</td>
                        <td>{{ $order->delivery_address }}</td>
                        <td>{{ $order->payment_method }}</td>
                        <td>{{ $order->total_amount }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td><a class="btn btn-success" href="" data-bs-toggle="modal"
                                data-bs-target="#exampleModal{{ $order->id }}">Dettaglio Ordine</a></td>

                        <div class="modal fade" id="exampleModal{{ $order->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Dettaglo Ordine</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @foreach ($order->dishes()->get() as $dish)
                                            <h5>Nome Piatto:</h5>
                                            <span> {{ $dish->name }}</span>
                                            <h5>Categoria Piatto: </h5>
                                            <span>{{ $dish->course->name }}</span>
                                            <h5>Descrizione Piatto</h5>
                                            <p>{{ $dish->description }}</p>
                                            @if ($dish->image)
                                                <h5>Foto Piatto</h5>
                                                <img src="{{ asset('storage/' . $dish->image) }}" alt="" width="100%">
                                            @endif
                                            <h5>Prezzo:</h5>
                                            <span> {{ $dish->price }}&euro;</span>
                                            <h5>Quantità:</h5>
                                            <span>
                                                {{ $dish->orders()->where('order_id', $order->id)->first()->pivot->quantity }}</span>
                                        @endforeach
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
