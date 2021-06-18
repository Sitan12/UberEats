@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <h1>{{ __('Mes informations') }}</h1>
        <div class="col-md-2">
            @if ($user->profile->photo!=null)
                <img src="/photoProfile/{{ $user->profile->photo }}" alt="" class="ronded-circle ml-5" width="100px" >
            @else
                <img src="{{asset('photoProfile/default.jpg')}}" alt="" class="ronded-circle ml-5" width="100px" >
            @endif
         </div>
         <div class="col-md-8">
                <div>
                    <h3 class="mr-3">{{ $user->name }}</h3>
                    <div>Votre Adresse Email: {{ $user->email }}</div>
                    <div>Votre Adresse Tel: {{ $user->profile->numero }}</div>
                    <div>Votre Adresse Adresse: {{ $user->profile->adresse }}</div>
                    <div>{{ $user->profile->photo }}</div>
                    <div>Latitude: {{ $user->profile->latitude }}</div>
                    <div>Longitude: {{ $user->profile->longitude }}</div>
                
                    <a href="{{ route('profiles.edit', [$user->name]) }}" class="btn btn-primary">Mettre A Jour</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
