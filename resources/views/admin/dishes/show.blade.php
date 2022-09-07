@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-10">
            <a class="btn btn-sm btn-secondary mb-2 mt-2" href="{{ route('admin.dishes.edit', $dish->slug)}}">Modifica</a>
            <h2>{{ $dish->name }}</h2>
            <h5 class="text-muted">Slug : {{ $dish->slug }}</h5>
            <p>Ingredienti: {{ $dish->ingredients }}</p>
            <p>Descrizione: {{ $dish->description }}</p>
            <p class="text-secondary">Prezzo: € {{ number_format((float)$dish->price, 2, '.', '') }}</p>
            
            @if ($dish->image)
            <div class="text-center">
                <img class="show-img " src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->name }}">
             </div>
               
            @endif       
        </div>
    </div>    

</div>

@endsection
