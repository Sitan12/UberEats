@extends('layouts.app')

@section('content')
    <div class="container" id="message">
        <h1 class="text-center">Listes de vos Commandes</h1>
        <div class="table-responsive py-4">
        @if(isset($msg))
            <div class="alert alert-success" id="msg">{{$msg}}</div>
        @endif
            <table class="table" id="table">
            <h1>Panier: {{count($com)}} plat(s)</h1>
                <thead>
              
                    <tr>
                        <th scope="col">Produits</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Quantite</th>
                        <th scope="col">Total</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                @php $total = 0 @endphp
                 @foreach ($commandes as $key => $commande )
                @if (Auth::user()->id === $commande->user_id)

                    <tr class="inputTable">
                        @php $total += $commande->plat->prix * $commande->quantite @endphp
                            <th scope="row"><img src="{{asset('photoPlat').'/'.$commande->plat->image}}" width="100"/></th>
                            <td id="prix">{{$commande->plat->prix}}</td>
                            <td>
                                    <input type="hidden" value="{{$commande->id}}" id="rowId{{$commande->id}}" >
                                    <input type="number" id="quantite{{$commande->id}}" value="{{$commande->quantite}}"  class="form-control mr-2" style="width: 80px" >
						    </td>
                        
                            <td>
                                <!-- Le total du produit = prix * quantité -->
                                {{ $commande->plat->prix * $commande->quantite}} CFA
						    </td>
                            <td>
                                <form method="post" action="{{route('panier.delete', $commande->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>

                                </form>                           
                            </td>
                    </tr>    
                @endif

                @endforeach
        
                </tbody>
            </table>
            <br/><br/>
            <a href="{{url('/')}}" class="btn btn-dark">Poursuivre vos commandes</a>
            <a class="btn btn-success" href="{{url('/panier/paiement')}}">Passer a la caisse</a>
            <h1 class="float-right" id="total">Montant: {{$total}} CFA</h1>
         
        </div>
    </div>

<script>
$(document).ready(function(){
    $("#msg").hide()
   @foreach ($commandes as $commande)
    $('#quantite{{$commande->id}}').on('change keyup', function(){
            var newQte = $('#quantite{{$commande->id}}').val()
            var rowId = $('#rowId{{$commande->id}}').val()
            $.ajax({
                url:"{{url('/panier/update')}}",
                data: 'rowId=' + rowId +'&newQte='+ newQte,
                type:'GET',
                beforeSend: function (xhr) {
            var token = $('meta[name="csrf_token"]').attr('content');

            if (token) {
                  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
            }
        },
                success:function(response){
                    $("#msg").show()
                    console.log(response);
                    document.location.reload();
                    $("#msg").html(response)
                },
                error:function(response){
                    console.log('error');
                }
            })
        });
    
   @endforeach
})
  
//    function load_panier(){
//     $('#message').load('panier');
//    }
    
   </script>
@endsection
