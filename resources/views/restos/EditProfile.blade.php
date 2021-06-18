@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Informations Personnelles') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('restaurant.updateProfile', $user) }}" enctype = "multipart/form-data">
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

                        @foreach($profiles as $profile)
                         @if($user->id === $profile->user_id)

                        <div class="form-group row">
                            <label for="telephone" class="col-md-4 col-form-label text-md-right">{{ __('Telephone') }}</label>

                            <div class="col-md-6 ">
                                <input id="telephone" type="tel" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ old('telephone') ?? $profile->telephone }}"  autocomplete="telephone" autofocus>

                                @error('telephone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="adresse" class="col-md-4 col-form-label text-md-right">{{ __('Adresse') }}</label>

                            <div class="col-md-6">
                                <input id="adresse" type="adresse" class="form-control @error('adresse') is-invalid @enderror" name="adresse" value="{{ old('adresse') ?? $profile->adresse }}"  autocomplete="adresse">

                                @error('adresse')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="socialnetwork" class="col-md-4 col-form-label text-md-right">{{ __('Reseaux Sociaux') }}</label>

                            <div class="col-md-6">
                                <input id="socialnetwork" type="text" class="form-control @error('socialnetwork') is-invalid @enderror" name="socialnetwork" value="{{ old('socialnetwork')?? $profile->socialnetwork }}" autocomplete="socialnetwork">

                                @error('socialnetwork')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="categorie" class="col-md-4 col-form-label text-md-right">{{ __(' Categorie') }}</label>

                            <div class="col-md-6">
                                <select id="categorie" type="text" class="form-control @error('categorie') is-invalid @enderror" name="categorie" value="{{ old('categorie') ?? $profile->categorie  }}"  autocomplete="categorie">
                                    <option value="{{ old('categorie') ?? $profile->categorie  }}" >{{ $profile->categorie ?? "Choisir une Categorie" }}</option>
                                    <option value="online">En ligne</option>
                                    <option value="physique">Physique</option>
                                </select>
                                @error('categorie')
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
                        <div class="form-group row">
                            <div class="col-md-8 offset-md-2 justify-content-center">

                            <label for="description " class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea name="description" placeholder="Description..." class="form-control @error('title') is-invalid @enderror" rows="10">{{ old('description') ?? $profile->description  }}</textarea>
                                @error('description')
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
                                <a  class="btn btn-success" id="btnLocalisation" class="btn btn-primary">
                                <i class="fa fa-location-arrow" aria-hidden="true"></i>
                                </a>
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
    var button = document.getElementById('btnLocalisation');
    var latitude = document.getElementById('latitude');
    var longitude = document.getElementById('longitude');

    button.addEventListener('click', function(){
        navigator.geolocation.getCurrentPosition(function(pos){
            let lat = pos.coords.latitude;
            let long = pos.coords.longitude;

            latitude.value = lat;
            longitude.value = long
        });  
    });
    });



</script>
@endsection
