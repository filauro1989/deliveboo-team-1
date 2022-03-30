@extends('layouts.admin.dashboard')

@section('content')
    <form action="{{ route('admin.dishes.update', $dish) }}" enctype="multipart/form-data" method="POST">
        @csrf
        @method("PATCH")
        <div class="mb-3">
            <label for="name" class="form-label">Nome Piatto</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $dish->name }}" minlength="2"
                maxlength="255">

        </div>
        @error('name')
            <div class="mt-2 alert alert-danger">
                {{ $message }}
            </div>
        @enderror

        <select id="course" class="form-select" aria-label="Default select example" name="course_id">
            @foreach ($courses as $course)
                @if ($course->id == $dish->course_id)
                    <option selected value="{{ $course->id }}">{{ $course->name }}</option>
                @else
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endif
            @endforeach
        </select>
        @error('course')
            <div class="mt-2 alert alert-danger">
                {{ $message }}
            </div>
        @enderror

        <div class="mb-3">
            <label for="description" class="form-label">Descrizione Piatto/Ingredienti</label>
            <textarea class="form-control" id="description" required rows="3" name="description" minlength="3"
                maxlength="4000">{{ $dish->description }}</textarea>
        </div>
        @error('description')
            <div class="mt-2 alert alert-danger">
                {{ $message }}
            </div>
        @enderror

        <div class="mb-3">
            <label for="price" class="form-label">Prezzo</label>
            <input min='0' step="0.01" type="number" class="form-control" required id="price" name="price"
                value="{{ $dish->price }}">
        </div>
        @error('price')
            <div class="mt-2 alert alert-danger">
                {{ $message }}
            </div>
        @enderror

        <div class="mb-3 form-check">
            @if ($dish->visible)
                <input type="hidden" class="form-check-input" id="visible" name="visible" value=0>
                <input type="checkbox" class="form-check-input" id="visible" name="visible" value=1 checked>
            @else
                <input type="hidden" class="form-check-input" id="visible" name="visible" value=0>
                <input type="checkbox" class="form-check-input" id="visible" name="visible" value=1>
            @endif
            <label class="form-check-label" for="visible">Visibile</label>
        </div>

        @if (!empty($dish->image))
            <img class="img-fluid" src="{{ asset('storage/' . $dish->image) }}" alt="">
        @else
            <img class="img-fluid" src="{{ asset('storage/default_images/default-placeholder.png') }}" alt="">
        @endif
        <div class="mb-3">
            <label for="image" class="form-label">Carica immagine del piatto</label>
            <input class="form-control" accept="image/*" type="file" id="image" name="image">
            @error('image')
                <div class="alert alert-danger mt-3">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
