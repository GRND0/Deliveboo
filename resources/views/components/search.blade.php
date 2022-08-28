<div class="bg-dark container">
    <img  src="" alt="">
    <div class="text-center text-white">

        <h1>Cerca</h1>
        <p>Scegli e ordina subito i tuoi piatti preferiti!</p>

        <form action="" method="post">
            @csrf

            <select class="form-control mb-4" name="categories" id="categories">
                <option>Scegli la categoria</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ ucFirst($category->name) }}</option>
                @endforeach
            </select>
            <input class="btn btn-primary" type="submit" value="Cerca">
        </form>

    </div>
</div>
