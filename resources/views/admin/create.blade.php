@extends('layouts.admin.dashboard')

@section('content')
    <form action="{{route('admin.dishes.store')}}" enctype="multipart/form-data" method="POST">
        @csrf
        @method("POST")
        <div class="mb-3">
            <label for="name" class="form-label">Nome Piatto</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        @error('name')
            <div class="mt-2 alert alert-danger">
                {{$message}}
            </div>
        @enderror

        <select id="course" class="form-select" aria-label="Default select example" name="course_id">
            @foreach ($courses as $course)
                <option value="{{$course->id}}">{{$course->name}}</option>
            @endforeach
        </select>
        @error('course')
            <div class="mt-2 alert alert-danger">
                {{$message}}
            </div>
        @enderror

        <div class="mb-3">
            <label for="description" class="form-label">Descrizione Piatto/Ingredienti</label>
            <textarea class="form-control" id="description" required rows="3" name="description"></textarea>
        </div>
        @error('description')
            <div class="mt-2 alert alert-danger">
                {{$message}}
            </div>
        @enderror

        <div class="mb-3">
            <label for="price" class="form-label">Prezzo</label>
            <input  step="0.01" type="number" class="form-control" required id="price" name="price">
        </div>
        @error('price')
            <div class="mt-2 alert alert-danger">
                {{$message}}
            </div>
        @enderror

        <div class="mb-3 form-check">
            <input type="hidden" class="form-check-input" id="visible" name="visible" value=0>
            <input type="checkbox" class="form-check-input" id="visible" name="visible" value=1>
            <label class="form-check-label" for="visible">Visibile</label>
        </div>

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
