@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-2">

            <div class="col-md-8">

                <h1>Modifica il piatto</h1>
                <span>(i campi contrasegnati con * sono obbligatori)</span><br><br>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.dishes.update', ['dish' => $dish]) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                    <div class="form-group">
                        <label for="name">Nome del piatto*</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name') ? old('name') : $dish->name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Descrizione</label>
                        <textarea type="text" class="form-control" name="description" id="description" rows='10'> {{ old('description') ? old('description') : $dish->description }} </textarea>
                    </div>

                    <div class="form-group">
                        <label for="ingredients">Ingredienti</label>
                        <textarea type="text" class="form-control" name="ingredients" id="ingredients" rows='3'> {{ old('ingredients') ? old('ingredients') : $dish->ingredients }} </textarea>
                    </div>

                    <div class="form-group">
                        <label for="price">Prezzo del piatto € (max 50.00)*</label>
                        <input type="number" min="1" max="50" step=".01" class="form-control"
                            id="price" name="price" required value="{{ old('price') ? old('price') : $dish->price }}">
                    </div>

                    <div class="mt-2">
                        <label for="image">Immagine*</label>
                        <input type="file" id="image" name="image">

                        @if ($dish->image)
                            <h5>Immagine attuale</h5>
                            <img src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->name }}">
                        @endif
                    </div>

                    <div class="form-group mt-2">
                        @if ($dish->available)
                            <input type="radio" id="available" name="available" checked value="1">
                            <label for="available">Disponibile</label>
                            <input type="radio" id="available" name="available" value="0">
                            <label for="available">Non disponibile</label>
                        @else
                            <input type="radio" id="available" name="available" value="1">
                            <label for="available">Disponibile</label>
                            <input type="radio" id="available" name="available" checked value="0">
                            <label for="available">Non disponibile</label>
                        @endif
                    </div>

                    <button id="submit" type="submit" class="btn btn-primary mt-3">Salva modifiche</button>


                </form>
                <form class="mt-3" action="{{ route('admin.dishes.destroy', ['dish' => $dish->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit"
                        onclick="return confirm('Vuoi veramente cancellare questo piatto?')">Cancella</button>
                </form>

            </div>
        </div>
    </div>
@endsection