@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-2">

            <div class="col-md-8">

                <h1>Crea un nuovo piatto</h1>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.dishes.store') }}" method="POST" enctype="multipart/form-data">
                    @method('POST')
                    @csrf

                    <div class="form-group">
                        <label for="name">Nome del piatto</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label for="description">Descrizione</label>
                        <textarea type="text" class="form-control" name="description" id="description" rows='10'> {{ old('description') }} </textarea>
                    </div>

                    <div class="form-group">
                        <label for="ingredients">Ingredienti</label>
                        <textarea type="text" class="form-control" name="ingredients" id="ingredients" rows='3'> {{ old('ingredients') }} </textarea>
                    </div>

                    <div class="form-group">
                        <label for="price">Prezzo del piatto € (max 50,00)</label>
                        <input type="number" min="1" max="50" step=".01" class="form-control"
                            id="price" name="price" value="{{ old('price') }}">
                    </div>

                    <div class="mt-2">
                        <label for="image">Immagine</label>
                        <input type="file" name="image" id="image">
                    </div>

                    <div class="form-group mt-2">
                        <input type="radio" id="available" name="available" value="1">
                        <label for="available">Disponibile</label>
                        <input type="radio" id="available" name="available" value="0">
                        <label for="available">Non disponibile</label>
                    </div>


                    <button type="submit" class="btn btn-primary mt-3">Crea</button>
                </form>

            </div>
        </div>
    </div>
@endsection
