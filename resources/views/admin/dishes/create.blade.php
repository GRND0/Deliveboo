@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-2">

            <div class="col-md-8">

                <h1 class="mt-2">Crea un nuovo piatto</h1>
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

                <form action="{{ route('admin.dishes.store') }}" method="POST" enctype="multipart/form-data">
                    @method('POST')
                    @csrf

                    <div class="form-group">
                        <label for="name">Nome del piatto*</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required oninput="verify()" onblur="verify()" onfocus="verify()">
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
                        <label for="price">Prezzo del piatto € (max 50,00)*</label>
                        <input type="number" min="1" max="50" step=".01" class="form-control"
                            id="price" name="price" value="{{ old('price') }}" required oninput="verify()" onblur="verify()" onfocus="verify()">
                    </div>

                    <div class="mt-2">
                        <label for="image">Immagine*</label>
                        <input type="file" name="image" id="image" required onblur="verify()" onfocus="verify()">
                    </div>

                    <div class="form-group mt-2">
                        <input type="radio" id="available" name="available" required value="1" onclick="verify()">
                        <label for="available">Disponibile</label>
                        <input type="radio" id="available" name="available" required value="0" onclick="verify()">
                        <label for="available">Non disponibile</label>
                    </div>


                    <button id="submit" type="submit" class="btn btn-primary mt-3" disabled="true" >Crea</button>
                </form>

            </div>
        </div>
    </div>
@endsection

<script>
    function verify() {
        if (
            (document.getElementById('name').value.trim() != '')
            && (document.getElementById('price').value.trim() != '') 
            && (document.getElementById('image').value != '')
            && Array.prototype.slice.call((document.querySelectorAll('input[type="radio"]'))).some(x => x.checked)
        ) {
            document.getElementById('submit').disabled = false;
        } else {
            document.getElementById('submit').disabled = true;
        }
    }
</script>
