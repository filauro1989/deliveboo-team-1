@extends('layouts.admin.dashboard')

@section('content')
    {{-- <form action="{{ route('admin.dishes.store') }}" enctype="multipart/form-data" method="POST">
        @csrf
        @method("POST")
        <div class="mb-3">
            <label for="name" class="form-label">Nome Piatto</label>
            <input type="text" class="form-control" id="name" name="name" minlength="2" maxlength="255" required>
        </div>
        @error('name')
            <div class="mt-2 alert alert-danger">
                {{ $message }}
            </div>
        @enderror

        <select id="course" class="form-select" aria-label="Default select example" name="course_id">
            @foreach ($courses as $course)
                <option value="{{ $course->id }}">{{ $course->name }}</option>
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
                maxlength="4000"></textarea>
        </div>
        @error('description')
            <div class="mt-2 alert alert-danger">
                {{ $message }}
            </div>
        @enderror

        <div class="mb-3">
            <label for="price" class="form-label">Prezzo</label>
            <input step="0.01" type="number" class="form-control" required id="price" name="price" min="0">
        </div>
        @error('price')
            <div class="mt-2 alert alert-danger">
                {{ $message }}
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
    </form> --}}

    <div class="container">
      <div class="row align-items-stretch justify-content-center no-gutters">
        <div class="col-md-7">
          <div class="form h-100 contact-wrap p-5">
            <h3 class="text-center">Inserisci il tuo piatto</h3>
            <form class="mb-5" action="{{ route('admin.dishes.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                @method("POST")
              <div class="row">
                <div class="col-md-12 form-group mb-3">
                  <label for="" class="col-form-label">Nome Piatto *</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="Il nome del tuo piatto" minlength="2" maxlength="255" required>
                  @error('name')
                    <div class="mt-2 alert alert-danger">
                        {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
                {{-- <div class="col-md-6 form-group mb-3">
                  <label for="" class="col-form-label">Email *</label>
                  <input type="email" class="form-control" name="email" id="email"  placeholder="Your email">
                </div> --}}
                <div class="row">
                <div class="col-md-12 form-group mb-3 d-flex flex-column">
                    <label for="" class="col-form-label">Categoria</label>
                    <select id="course" class="col-md-6 form-group mb-3 border-none" aria-label="Default select example" name="course_id">
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('course')
                    <div class="mt-2 alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
              </div>

              <div class="row">
                <div class="col-md-12 form-group mb-3">
                  <label for="budget" class="col-form-label">Prezzo</label>
                  <input step="0.01" type="number" class="form-control" required id="price" name="price" min="0">
                </div>
              </div>
              @error('price')
                    <div class="mt-2 alert alert-danger">
                        {{ $message }}
                    </div>
              @enderror

              <div class="row">
                <div class="col-md-12 form-group mb-3">
                  <input type="hidden" class="form-check-input" id="visible" name="visible" value=0>
                <input type="checkbox" class="form-check-input" id="visible" name="visible" value=1>
                <label class="form-check-label" for="visible">Visibile</label>
                </div>
              </div>

              <div class="row mb-5">
                <div class="col-md-12 form-group mb-3">
                  <label for="message" class="col-form-label">Descrizione/Ingredienti Piatto *</label>
                  <textarea class="form-control" id="description" required rows="3" name="description" minlength="3"
                maxlength="4000"></textarea>
                </div>
              </div>
              @error('description')
                    <div class="mt-2 alert alert-danger">
                        {{ $message }}
                    </div>
              @enderror

              <div class="row">
                <div class="col-md-12 form-group mb-3">
                  <label for="image" class="form-label">Carica immagine del piatto</label>
                  <input class="form-control" accept="image/*" type="file" id="image" name="image">
                </div>
              </div>
              @error('image')
                <div class="alert alert-danger mt-3">
                    {{ $message }}
                </div>
              @enderror

              <div class="row justify-content-center">
                <div class="col-md-5 form-group text-center">
                  <input type="submit" value="Aggiungi Piatto" class="btn-form btn-block btn-primary rounded-0 py-2 mt-4 px-4">
                  <span class="submitting"></span>
                </div>
              </div>
            </form>


          </div>
        </div>
      </div>
    </div>
@endsection
