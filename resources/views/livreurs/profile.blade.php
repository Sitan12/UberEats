@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <h1>{{ __('Mon Profile') }}</h1>
    <div class="col-md-2">
        @if($user->profileLivreur->photo != null)
            <img src="/photoProfile/{{ $user->profileLivreur->photo }}" alt="" class="ronded-circle ml-5" width="100px" >
        @else
        <img src="{{asset('photoProfile/default.jpg')}}" alt="" class="ronded-circle ml-5" width="100px" >
        @endif
         </div>
         <div class="col-md-8">
                    <h3 class="mr-3">{{ $user->name }}</h3>
            
                    @foreach( $profiles as $profile)
                    @if($user->id === $profile->user_id)
                    <div>Nom: {{ $profile->nom }}</div>
                    <div>Prenom: {{ $profile->prenom }}</div>
                    <div>Adresse: {{ $profile->adresse }}</div>
                    <div>Adresse Email: {{ $user->email }}</div>
                    <div>Telephone: {{ $profile->telephone }}</div>
                    <div>Numero d'identité: {{ $profile->CNI }}</div>
                    <div>Moyen de transport: {{ $profile->transport }}</div>
                    <div>Latitude: {{ $profile->latitude }}</div>
                    <div>Longitude: {{ $profile->longitude }}</div>
                    @endif
                    @endforeach
                    <a href="{{ route('livreur.EditProfile', [$user->name]) }}" class="btn btn-primary mt-3">Mettre A Jour</a>
                    
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
