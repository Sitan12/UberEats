@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
    <h1 class="text-center">{{ __('Notifications') }} <span class="badge bg-primary">{{count($notifications)}}</span></h1>
    @foreach ($notifications as $notification) 
    @if(count($notifications) == 0)
            <p>AUCUNE NOTIFICATION</p>
            @endif
         <div class="col-md-8 p-2 justify-content-center">
         <table class="table">
            <tbody>
            @if($notification->type === "livraison")
                <tr> 
                    @foreach($users as $user)
                    @if($user->id === $notification->sender)
                    <td> {{ $user->name }} vous a attribué une livraison le  {{ $notification->sending_date}} </td>
                    <td><a href = "{{ route('notification.delete',$notification->id) }}" class="btn btn-danger">Supprimer</a></td>
                    @endif
                    @endforeach
                </tr>
             @endif 
            @if($notification->type === "commander")  
                <tr>
                    @foreach($users as $user)
                    @if($user->id === $notification->sender)
                    <td>{{ $user->name }}  a passé une commande le {{ $notification->sending_date}} </td>
                    <td><a href = "{{ route('notification.delete',$notification->id) }}" class="btn btn-danger">Supprimer</a></td>
                    @endif
                    @endforeach
                </tr> 
            @endif
            @if($notification->type === "client")  
                <tr>
                    @foreach($users as $user)
                    @if($user->id === $notification->sender)
                    <td>{{ $user->name }}  va livré la commande ce {{ $notification->sending_date}}<br/> Telephone: {{$user->profileLivreur->telephone}}<br/> <span class="text-primary"> Merci a la prochaine!!!</span> </td>
                    <td><a href = "{{ route('notification.delete',$notification->id) }}" class="btn btn-danger">Supprimer</a></td>
                    @endif
                    @endforeach
                </tr> 
            @endif
     @endforeach 
          </tbody>
        </table>
        </div>
    </div>
</div>
@endsection