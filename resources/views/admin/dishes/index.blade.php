@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-1">Elenco dei tuoi piatti</h1>
    <a class="btn btn-success mb-3" href="/admin/dishes/create">Crea un nuovo piatto</a>
    <div class="row row-cols-4">
        @foreach ($dishes as $dish)
            <div class="col">
            <div class="card mb-4">
                @if ($dish->image)
                    <img class="card-img-top" src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->name }}">  
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $dish->name }}</h5>
                    <a class="btn btn-sm btn-secondary" href="{{ route('admin.dishes.edit', $dish)}}">Modifica</a>
                    <p class="text-success">€{{ $dish->price }}</p>
                    <p class="text-info">{{ $dish->ingredients }}</p>
                    <p class="text-muted">{{ $dish->description }}</p>
                </div>
            </div>
            </div>
        @endforeach
    </div>    
</div>
@endsection
