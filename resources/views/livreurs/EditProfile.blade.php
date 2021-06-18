@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Informations Personnelles') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('livreur.updateProfile', $user) }}" enctype = "multipart/form-data">
                        @csrf
                        @method('PATCH')
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
                        
                        @foreach( $profiles as $profile)
                        @if($user->id === $profile->user_id)
                        <div class="form-group row">
                            <label for="nom" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>

                            <div class="col-md-6">
                                <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom') ?? $profile->nom }}"  autocomplete="nom">

                                @error('nom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="prenom" class="col-md-4 col-form-label text-md-right">{{ __('Prenom') }}</label>

                            <div class="col-md-6">
                                <input id="prenom" type="text" class="form-control @error('prenom') is-invalid @enderror" name="prenom" value="{{ old('prenom') ?? $profile->prenom }}"  autocomplete="prenom">

                                @error('prenom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="adresse" class="col-md-4 col-form-label text-md-right">{{ __('Adresse') }}</label>

                            <div class="col-md-6">
                                <input id="adresse" type="text" class="form-control @error('adresse') is-invalid @enderror" name="adresse" value="{{ old('adresse') ?? $profile->adresse }}"  autocomplete="adresse">

                                @error('adresse')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telephone" class="col-md-4 col-form-label text-md-right">{{ __('Telephone') }}</label>

                            <div class="col-md-6">
                                <input id="telephone" type="tel" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ old('telephone') ?? $profile->telephone }}"  autocomplete="telephone">

                                @error('telephone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="CNI" class="col-md-4 col-form-label text-md-right">{{ __('Numero de carte identité') }}</label>

                            <div class="col-md-6">
                                <input id="CNI" type="text" class="form-control @error('CNI') is-invalid @enderror" name="CNI" value="{{ old('CNI') ?? $profile->CNI }}"  autocomplete="CNI">

                                @error('CNI')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-5">
                            <label for="password" class="">{{ __('Longitude') }}</label>

                                <input id="longitude" type="text" class="form-control @error('longitude') is-invalid @enderror" name="longitude" value="{{ old('longitude') ?? $profile->longitude }}">

                                @error('longitude')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-5 ">
                                <label for="password" class="">{{ __('Latitude') }}</label>

                                <input id="latitude" type="text" class="form-control @error('latitude') is-invalid @enderror" name="latitude" value="{{ old('latitude') ?? $profile->latitude }}">

                                    @error('latitude')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                            </div>

                            <div class="col-md-2 py-4">
                                <a  class="btn btn-success" id="location" class="btn btn-primary">
                                <i class="fa fa-location-arrow" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="transport" class="col-md-4 col-form-label text-md-right">{{ __('Moyen de Transport') }}</label>

                            <div class="col-md-6">
                            <select id="transport" type="text" class="form-control @error('transport') is-invalid @enderror" name="transport" autocomplete="transport">
                                <option value="{{ old('transport') ?? $profile->transport }}">{{  $profile->transport ?? "choisir un moyen de transport" }}</option>
                                <option value="vehicule">Vehicule</option>
                                <option value="moto">Moto</option>
                                <option value="velo">Velo</option>
                            </select>

                                @error('transport')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8 offset-md-2 justify-content-center custom-file">

                                <input id="validatedCustomFile" type="file" class="custom-file-input @error('photo') is-invalid @enderror" name="photo" value="{{ old('photo') ?? $profile->photo  }}" >
                                <label for="validatedCustomFile" class="custom-file-label">{{ __('Choisir une Photo pour votre profile') }}</label>
                                @error('photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                             
                            </div>
                        </div>

                    @endif
                     @endforeach
                       

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
<script>
    $(document).ready(function(){
    let button = document.getElementById("location");
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

@endsection
