@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Informations Personnelles') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('profiles.update', $user) }}" enctype = "multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $user->name }}"  autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $user->email }}"  autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="numero" class="col-md-4 col-form-label text-md-right">{{ __('Telephone') }}</label>

                            <div class="col-md-6 ">
                                <input id="numero" type="text" class="form-control @error('numero') is-invalid @enderror" name="numero" value="{{ old('numero') ?? $user->profile->numero }}"  autocomplete="numero" autofocus>

                                @error('numero')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="adresse" class="col-md-4 col-form-label text-md-right">{{ __('Adresse') }}</label>

                            <div class="col-md-6">
                                <input id="adresse" type="adresse" class="form-control @error('adresse') is-invalid @enderror" name="adresse" value="{{ old('adresse') ?? $user->profile->adresse }}"  autocomplete="adresse">

                                @error('adresse')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8 offset-md-2 justify-content-center custom-file">

                                <input id="validatedCustomFile" type="file" class="custom-file-input @error('photo') is-invalid @enderror" name="photo" value="{{old('photo') ?? $user->profile->photo}}" >
                                <label for="validatedCustomFile" class="custom-file-label">{{ __('Choisir une Photo pour votre profile') }}</label>
                                @error('photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                             
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-5">
                            <label for="password" class="">{{ __('Longitude') }}</label>

                                <input id="longitude" type="text" class="form-control @error('longitude') is-invalid @enderror" name="longitude" value="{{ old('longitude') ?? $user->profile->longitude }}">

                                @error('longitude')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-5 ">
                                <label for="password" class="">{{ __('Latitude') }}</label>

                                <input id="latitude" type="text" class="form-control @error('latitude') is-invalid @enderror" name="latitude" value="{{ old('latitude') ?? $user->profile->latitude }}">

                                    @error('latitude')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                            </div>

                            <div class="col-md-2 py-4">
                                <a  class="btn btn-success" id="get-location" class="btn btn-primary">
                                <i class="fa fa-location-arrow" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Modifier') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<<<<<<< HEAD
=======
<script>
    $(document).ready(function(){
        let button = document.getElementById("get-location");
        let latText = document.getElementById("latitude");
        let longText = document.getElementById("longitude");
​
        button.addEventListener("click", function() {
            navigator.geolocation.getCurrentPosition(function(position) {
                let lat = position.coords.latitude;
                let long = position.coords.longitude;
​
                latText.value = lat;
                longText.value = long;
                // event.preventDefault();
            });
            });
​
        });
    </script>
>>>>>>> 5cc7f2269f7c869858743f706e3ce78f83fb0bae
@endsection
