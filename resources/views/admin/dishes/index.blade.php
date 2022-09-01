@extends('layouts.main')

@section('content')
<div class="container">
    @if (session('message'))
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="col-12">
                            <div class="alert alert-info">{{ session('message') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif    
    <h1 class="mt-2 mb-1">Elenco dei tuoi piatti</h1>
    <a class="btn btn-success mb-3" href="/admin/dishes/create">Crea un nuovo piatto</a>
    <div class="row row-cols-4">
        @foreach ($dishes as $dish)
            <div class="col">
            <div class="card mb-4">
                @if ($dish->image)
                    <img class="card-img-top" src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->name }}">  
                @endif
                <div class="card-body">
                    <h5 class="card-title mb-2">{{ $dish->name }}</h5>
                    <p class="text-success mb-2">€ {{ $dish->price }}</p>
                    <p class="text-info">{{ $dish->ingredients }}</p>
                    <p class="text-muted">{{ $dish->description }}</p>
                    <a href="{{ route('admin.dishes.show', ['slug' =>$dish->slug]) }}" class="btn btn-primary">Dettagli piatto</a>
                </div>
            </div>
            </div>
        @endforeach
    </div>    
</div>
@endsection
