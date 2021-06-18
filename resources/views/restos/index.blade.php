@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Assistant_Restaurant-Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Vous etes connecté!') }}

                    <a href="{{url('/')}}" class="btn btn-success">
                    {{ __('VOIR FOOD') }}
                    </a>

                    <!-- ADD FOOD -->
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    {{ __('AJOUT FOOD') }}
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ __('AJOUT FOOD') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                            <form method="post" action="{{route('plat.add')}}" enctype="multipart/form-data">
                            @csrf
                                <div class="modal-body">
                                    <div class="form-group row justify-content-center">
                                        <div class="col-md-8">
                                            <input id="title" type="text" class="form-control @error('name') is-invalid @enderror" name="title" placeholder="Nom" autocomplete="title" autofocus>

                                            @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row justify-content-center">
                                        <div class="col-md-8">
                                            <input id="prix" type="text" class="form-control @error('email') is-invalid @enderror" name="prix" placeholder="Prix"  autocomplete="prix" autofocus>

                                            @error('prix')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                    <div class="form-group row justify-content-center">
                                        <div class="col-md-8">
                                            <textarea name="description" placeholder="Description..." class="form-control @error('title') is-invalid @enderror" placeholder="Description" rows="8"></textarea>
                                                @error('descrition')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-8 offset-md-2 justify-content-center">
                                            <label for="file-ip-1" class="fileLabel">Image</label>
                                            <input type="file" id="file-ip-1" onchange="showPrevent(event);" class="inputImg @error('image') is-invalid @enderror" name="image">
                                            @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            <div class="preview">
                                                <img id="file-ip-1-preview" class="imgFile" />
                                            </div>
                
                                    </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                   <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Ajouter') }}
                                        </button>
                                   </div>
                                </div>
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

    </tr>
  </thead>
  <tbody>
  @foreach ($commandes as $commande)
  @if(Auth::user()->id === $commande->restaurant_id)
  <tr>
      <th scope="row">{{$commande->id}}</th>
      <td>{{$commande->plat->title}}</td>
      <td>{{$commande->plat->prix}}</td>
      <td><img src="{{asset('photoPlat'.'/'.$commande->plat->image)}}" width="100"></td>
      <td>{{$commande->user->name}}</td>
    </tr>
    @endif
  @endforeach
   
  </tbody>
        </table>
    </div>
   
</div>
<script>
    function showPrevent(event){
        if(event.target.files.length > 0){
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById('file-ip-1-preview');
            preview.src = src;
            preview.style.display = "block";
        }
    }

</script>
@endsection
