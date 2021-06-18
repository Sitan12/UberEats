<?php

namespace App\Http\Controllers;

use App\Models\Plat;
use App\Models\User;
use App\Models\Commande;
use Illuminate\Http\Request;
use App\Models\Notifications;
use App\Models\ProfileRestaurant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Notifications\CommandeAffectedToLivreur;

class CommandeController extends Controller
{

    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $commande = new Commande();
        $commande->user_id = Auth::user()->id;
        $commande->plat_id = $request->plat_id;
        $commande->restaurant_id = $request->restaurant_id;
        $commande->livreur_id=null;
        $commande->quantite = $request->quantite;

        $commande->save();
        $notification = new Notifications();
        $notification->type = 'commander';
        $notification->sender = $commande->user_id;
        $notification->recipient = $commande->restaurant_id;
        $notification->sending_date = date('Y-m-d');
        $notification->save();
        notify()->success("Commande effectuée <span class='badge badge-dark'> #$commande->user_id </span>!!!");
        return back();
    }

    public function panier()
    {
        $commandes = Commande::where('user_id', Auth::user()->id)->get();
        return view('panier.index',compact('commandes'));
    }

    public function pagePaiement(){
        return view('panier.paiement');
    }

    public function updateQte(Request $request){

        $rowId = $request->rowId;
        $commandes = Commande::find($rowId);
        $commandes->quantite = $request->newQte;
        
        $commandes->update();
        notify()->success("Mise a jour de la quantité");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commande $commande)
    {
        $commande->livreur_id = $request->livreur_id;
        
        $commande->update();
        
        $notification = new Notifications();
        $notification->type = 'livraison';
        $notification->sender = $commande->restaurant_id;
        $notification->recipient = $commande->livreur_id;
        $notification->sending_date = date('Y-m-d');
        $notification->save();

        notify()->success("Atturibution du livreur avec succés");
        return back();  
    }
    public function deleteCommande($id){
        $commande = Commande::find($id);
       if($commande!=null){
           $commande->delete(); 
       }

       notify()->success('La commande a été supprimé!!!');
       return back();
    }

    public function show(Commande $commande){
        if($commande->livreur_id === null){
            $commande->livreur_id = Auth::user()->id;
            $commande->update();
    
            $notification = new Notifications();
            $notification->type = 'client';
            $notification->sender = $commande->livreur_id;
            $notification->recipient = $commande->user_id;
            $notification->sending_date = date('Y-m-d');
            $notification->save();
    
            notify()->success("Atturibution du livreur avec succés");
        }else{
            notify()->error("OOPS Livraison déja choisi!!!");

        }
       
        return back();  
    }
}
