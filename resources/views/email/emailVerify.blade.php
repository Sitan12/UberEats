Bonjour, Assalamou Alaikoum {{$user->name}}
@if($user->role == 'client')
@component('mail::button',['url' => route('verification_user',$user->is_actived)])

Validation de mon compte
@endcomponent

<p>Ou copier/coller le lien dans votre navigateur pour verifier votre adresse email</p>

<p><a href="{{route('verification_user',$user->is_actived)}}">{{route('verification_user',$user->is_actived)}}</a></p>
@endif

@if($user->role == 'livreur')
@component('mail::button',['url' => route('verification_userLivreur',$user->is_actived)])

Validation de mon compte
@endcomponent

<p>Ou copier/coller le lien dans votre navigateur pour verifier votre adresse email</p>

<p><a href="{{route('verification_userLivreur',$user->is_actived)}}">{{route('verification_userLivreur',$user->is_actived)}}</a></p>
@endif

@if($user->role == 'restaurant')
@component('mail::button',['url' => route('verification_userRestaurant',$user->is_actived)])

Validation de mon compte
@endcomponent

<p>Ou copier/coller le lien dans votre navigateur pour verifier votre adresse email</p>

<p><a href="{{route('verification_userRestaurant',$user->is_actived)}}">{{route('verification_userRestaurant',$user->is_actived)}}</a></p>
@endif
Merci, Djereudjef, <br>
{{ config('app.name') }}

