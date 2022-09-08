@extends('layouts.main')

@section('content')
<div class="container">
  <h2 class="mt-2">Ciao {{$user->name}}. Questa è la home di amministrazione </h2>
  <div class="row row-cols-10">
    <h3 class="font-weight-bold">{{$user->restaurant_name}}</h3>
    <p>Qui potrai gestire la tua attività</p>
    <h3><a href="/admin/dishes/">Visualizza e modifica qui i piatti che venderai da asporto!</a></h3>
    <img src="/storage/app/public/uploads/{{ $user->image }}" alt="">  
  </div> 
</div>


@endsection