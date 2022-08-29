@extends('layouts.main')

@section('content')
<div class="container">
  <h2 class="mt-2">Ciao {{$user->name}}. Questa è la home di amministrazione </h2>
  <div class="row row-cols-10">
    <h5 class="font-weight-bold">{{$user->restaurant_name}}</h5>
    <p>Qui puoi gestire la tua attività</p>
    <img src="storage/{{ $user->image }}" alt="">  
  </div> 
</div>


@endsection