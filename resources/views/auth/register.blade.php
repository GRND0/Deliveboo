@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registrati') }}</div>

                <div class="card-body">
                    <form id="formRegistrazione" method="POST" action="{{ route('register', $user) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row mb-1">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail*') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="nome@mail.com">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-1">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password*') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="la password deve essere di almeno 4 caratteri">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-1">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Conferma Password*') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Reinserisci la password">
                            </div>
                        </div>

                        <div class="form-group row mb-1">
                            <label for="name"
                                class="col-md-4 col-form-label text-md-right">{{ __('Nome*') }}</label>

                            <div class="col-md-6">

                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus
                                    placeholder="Inserire il tuo nome">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-1">
                            <label for="restaurant_name"
                                class="col-md-4 col-form-label text-md-right">{{ __('Nome Ristorante*') }}</label>

                            <div class="col-md-6">

                                <input id="restaurant_name" type="text"
                                    class="form-control @error('restaurant_name') is-invalid @enderror" name="restaurant_name"
                                    value="{{ old('restaurant_name') }}" required autocomplete="restaurant_name" autofocus
                                    placeholder="Inserire il tuo nome ristorante">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-1">
                            <label for="restaurant_phone"
                                class="col-md-4 col-form-label text-md-right">{{ __('Telefono Ristorante*') }}</label>

                            <div class="col-md-6">

                                <input id="restaurant_phone" type="text"
                                    class="form-control @error('restaurant_phone') is-invalid @enderror" name="restaurant_phone"
                                    value="{{ old('restaurant_phone') }}" required autocomplete="restaurant_phone" autofocus
                                    placeholder="Inserire il numero di telefono del ristorante">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-1">
                            <label for="address"
                                class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo*') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text"
                                    class="form-control @error('address') is-invalid @enderror" name="address"
                                    value="{{ old('address') }}" required autocomplete="address" autofocus
                                    placeholder="Inserire l'indirizzo dell'attività">

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-1">
                            <label for="p_iva"
                                class="col-md-4 col-form-label text-md-right">{{ __('P. IVA*') }}</label>

                            <div class="col-md-6">

                                <input id="p_iva" type="text"
                                    class="form-control @error('p_iva') is-invalid @enderror" name="p_iva"
                                    value="{{ old('p_iva') }}" required autocomplete="p_iva" autofocus
                                    placeholder="Inserire la P. IVA">

                                @error('p_iva')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-1">
                            <label for="image"
                                class="col-md-4 col-form-label text-md-right">{{ __('image (.png)*') }}</label>

                            <div class="col-md-6">
                                <input id="image" type="file" accept="image/png"
                                    class="form-control @error('image') is-invalid @enderror" name="image"
                                    value="{{ ('image') }}" autocomplete="image" autofocus>

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-1">
                            <label for="link_social_media"
                                class="col-md-4 col-form-label text-md-right">{{ __('Link social media*') }}</label>

                            <div class="col-md-6">
                                <input id="link_social_media" type="text"
                                    class="form-control @error('link_social_media') is-invalid @enderror" name="link_social_media"
                                    value="{{ old('link_social_media') }}" required autocomplete="link_social_media" autofocus
                                    placeholder="Inserire un link">

                                @error('link_social_media')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-1">
                            <label for="types"
                                class="col-md-4 col-form-label text-md-right">{{ __('Categorie*') }}</label>

                            <div class="col-md-6">
                                @foreach ($categories as $category)
                                    <div class="form-check">
                                        <input 
                                            name="categories[]"
                                            class="form-check-input" 
                                            type="checkbox" 
                                            value="{{ $category->id }}"
                                            {{ in_array( $category->id, old('categories', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="categories">
                                            {{ ucfirst($category->name) }}
                                        </label>
                                    </div>
                                @endforeach

                                @error('category')
                                    <div class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="submit" type="submit" class="btn btn-primary">
                                    {{ __('Registrati') }}
                                </button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

