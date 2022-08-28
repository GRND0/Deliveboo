<div id="hero" class="position-relative bg-dark">
    <img  src="/img/search_ok.jpg" alt="">
    <div id="text-hero" class="text-center my-py-13 text-white position-absolute">

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
