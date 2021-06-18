@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard Livreur') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Vous etes connecté!') }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="table py-4">
        <h1>Commandes</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Commande</th>
                    <th scope="col">Plat</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Image</th>
                    <th scope="col">Client</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($commandes as $commande)
                <tr>
                    <th scope="row">{{$commande->id}}</th>
                    <td>{{$commande->plat->title}}</td>
                    <td>{{$commande->plat->prix}}</td>
                    <td><img src="{{asset('photoPlat'.'/'.$commande->plat->image)}}" width="100"></td>
                    <td>{{$commande->user->name}}</td>
                    
                    <td>
                    @if($commande->livreur_id === null)
                        <a href="{{route('commande.show',$commande->id)}}" class="btn btn-primary">Livrer</a>
                    @else
                    <a href="{{route('commande.show',$commande->id)}}" class="btn btn-success"> Livraison en cours</a>
                    @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
