@extends('layouts.app')

@section('content')
    <div class="container py-4">
    <div class="row g-2">
    @foreach ($plats as $plat)
        <div class="col-md-3 mr-5">
          <div class="card" style="width: 18rem;">
            <img src="{{asset('photoPlat').'/'.$plat->image}}" class="card-img-top" alt="plat">
            <div class="card-body">
              <h5 class="card-title">{{$plat->title}}</h5>
              <p class="card-text">{{$plat->prix}} CFA</p>
              <p class="card-text"><span style="float:right; color:orangered">#{{$plat->user->name}}</span></p>
               <!-- Commande FOOD -->
               <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$plat->id}}">
                {{ __('Commander') }}
               </button>
                <!-- Modal -->
              <div class="modal fade" id="exampleModal-{{$plat->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Commande</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form method="post" action="{{route('commande.store')}}" enctype="multipart/form-data">
                            @csrf
                                <div class="modal-body">
                                    <h1>{{$plat->title}}</h1>
                                    <img src="{{asset('photoPlat').'/'.$plat->image}}" class="" width="100" alt="plat"><br/>
                                    <h1>Prix: {{$plat->prix}}</h1>
                                    <input id="title" type="hidden" class="form-control" value="{{$plat->id}}" name="plat_id" autocomplete="plat_id" autofocus>
                                    <input id="title" type="hidden" class="form-control" value="{{$plat->user_id}}" name="restaurant_id" autocomplete="plat_id" autofocus>
                                    <label>Quantite</label>
                                   
                                    <input type="number" class="form-control" value="1" name="quantite" >

                                   <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                        <button type="submit" class="btn btn-primary" value="">
                                            {{ __('Ajouter au panier') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
        @endforeach
    </div>
    </div>
@endsection