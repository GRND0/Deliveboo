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
    <span>(i piatti visualizzati in rosso non sono disponibili per l'acquisto)</span><br>
    <a class="btn btn-success mt-2 mb-3" href="/admin/dishes/create">Crea un nuovo piatto</a>
    <div class="row row-cols-4">
        @foreach ($dishes as $dish)
            <div class="col-12 col-sm-6 col-lg-3 card-group">
                <div class="card mb-4">
                    @if ($dish->image)
                        <img class="card-img-top" src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->name }}">
                    @else
                        <img src="https://images.ctfassets.net/84wm3hhxw4gx/0sxerdVddcgpnd69VcMsx/414cb6a014fc90e5d96e07fef8022ccf/foodplaceholder.png" alt="placeholder">      
                    @endif
                    {{-- se il piatto è reso non acquistabile ai guest, allora dal lato admin viene visualizzato in rosso --}}
                    <div class="card-body @if ($dish->available == false) bg-danger @endif">
                        <h5 class="card-title mb-2">{{ $dish->name }}</h5>
                        <p class="text-success mb-2">€ {{ number_format((float)$dish->price, 2, '.', '') }}</p>
                        <p class="text-info">{{ $dish->ingredients }}</p>
                        <p class="text-muted">{{ $dish->description }}</p>
                        <a href="{{ route('admin.dishes.show', ['slug' =>$dish->slug]) }}" class="btn btn-primary align-bottom">Dettagli piatto</a>
                    </div>
                </div>                
            </div>
        @endforeach
    </div>    
</div>
@endsection
