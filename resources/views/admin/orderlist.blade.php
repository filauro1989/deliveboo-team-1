@extends('layouts.admin.dashboard')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="d-flex align-items-start flex-wrap">
        @foreach ($orders as $order)
            @foreach ($order as $orderItem)
                <div class="card mb-3" style="max-width: 400px;">
                    <div class="row g-0">
                        <div class="col-md-12">
                            <div class="card-body">
                                <h5 class="card-title">{{ $orderItem->customer_email }}</h5>
                                <h5 class="card-title">{{ $orderItem->last_name . ' ' . $orderItem->first_name }}</h5>
                                <span class="card-title">{{ $orderItem->delivery_address }}</span>
                                <p class="card-text">{{ $orderItem->payment_method }}</p>
                                <h2 class="card-title">{{ $orderItem->total_amount }}</h2>

                                <a class="btn btn-success" href="">Dettaglio Ordine</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
@endsection
