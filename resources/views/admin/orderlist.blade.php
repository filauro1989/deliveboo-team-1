@extends('layouts.admin.dashboard')

@section('content')
@if(session("status"))
<div class="alert alert-success">
  {{session("status")}}
</div>
@endif
<div class="d-flex align-items-start flex-wrap">
    @foreach ($orders as $order)
    <div class="card mb-3" style="max-width: 400px;">
        <div class="row g-0">
          <div class="col-md-12">
            <div class="card-body">
              <h5 class="card-title">{{$order->customer_email}}</h5>
              <span class="card-title">{{$order->delivery_address}}</span>
              <p class="card-text">{{$order->payment_method}}</p>
              <h2 class="card-title">{{$order->total_amount}}</h2>
              
              <a class="btn btn-success" href="">Dettaglio Ordine</a>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection