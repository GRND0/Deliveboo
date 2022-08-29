@extends('layouts.main')
@section('content')

<h2>Ciao {{$user->name}}. Questa è la home di amministrazione </h2>

<div class="col">
    <div class="card" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">{{$user->restaurant_name}}</h5>
          <p class="card-text">Qui puoi gestire la tua attività</p>
          <img src="storage/{{ $user->image }}" alt="">
        </div>
      </div>
    
</div> 



@endsection