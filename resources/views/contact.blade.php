@extends('layouts.app')

@section('content')
    <div class="container py-4">
    <h1 class="text-center py-4">Plus d'informations? Contactez-nous</h1>
    <div class="col-lg-12 mt-5">
            <div class="card-body">
                <div>
                    <form method="post" action="" enctype="multipart/form-data">
                                @csrf
                        <div class="form-row">
                                <div class="form-group col-lg-6 col-md-12 col-sm-12 col-12">
                                    <input type="text" placeholder="Nom" name="name" class="form-control" style="background-color: #E2E2E2; padding:30px;background: #E2E2E2;border-radius: 20px;" />
                                </div>

                                <div class="form-group col-lg-6 col-md-12 col-sm-12 col-12">
                                    <input type="text" placeholder="Email" name="email" class="form-control" style="background-color: #E2E2E2; padding:30px;background: #E2E2E2;border-radius: 20px;" />
                                </div>

                                <div class="form-group col-lg-6 col-md-12 col-sm-12 col-12">
                                    <input type="text" placeholder="Numero" name="number" class="form-control" style="background-color: #E2E2E2; padding:30px;background: #E2E2E2;border-radius: 20px;" />
                                </div>

                                <div class="form-group col-lg-6 col-md-12 col-sm-12 col-12">
                                    <input type="text" placeholder="Sujet" name="sujet" class="form-control" style="background-color: #E2E2E2; padding:30px;background: #E2E2E2;border-radius: 20px;" />
                                </div>

                                <textarea class="form-control mb-3" placeholder="Message" name="message" cols="10" rows="5" id="" style="background-color: #E2E2E2; padding:30px;background: #E2E2E2;border-radius: 20px;"></textarea>
                                    <div class="form-group offset-5">
                                        <button class="btn btn bg-primary form-control" style="color:white;height:50px; background: rgba(235, 100, 28, 0.698039);box-shadow: 2px 10px 12px rgba(100, 100, 100, 0.498039);border-radius: 20px;"><span style="font-style: normal;font-weight: normal;font-size: 20px;line-height: 5px; margin-bottom:-20px" class="p-4">Soumettre</span></button>
                                    </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection