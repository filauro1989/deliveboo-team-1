@extends('layouts.admin.app')

@section('script')
    <script src="{{ asset('js/admin.js') }}" defer></script>
@endsection

@section('content')
    @php
    use App\User;

    $user = User::where('restaurant_name', 'francesco')->first();

    @endphp
    <div class="container">
        <img class="img-fluid" src="{{ asset('storage/' . $user->image) }}" alt="">
    </div>
@endsection
