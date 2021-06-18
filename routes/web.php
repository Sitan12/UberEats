<?php

use App\Models\Plat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RestaurantController;
use App\Models\ProfileRestaurant;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(User $user){
    $restaurants = ProfileRestaurant::has('user')->get();
    return view('welcome',compact('restaurants','user'));
});

Route::get('/apropos', function(){
        return view('apropos');
})->name('apropos');

Route::get('/autre-route', function(){
    return view('restos.test');
})->name('autre');



Route::get('/contact', function(){
    return view('contact');
})->name('contact');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/verification/{verification}',[RegisterController::class, 'verify'])->name('verification_user');
Route::get('/verification/livreur/{verification}','App\Http\Controllers\LivreurController@verify')->name('verification_userLivreur');
Route::get('/verification/restaurant/{verification}','App\Http\Controllers\RestaurantController@verify')->name('verification_userRestaurant');

Route::get('/profiles/{user}', 'App\Http\Controllers\ProfileController@show')->name('profiles.show');
Route::get('/profiles/{user}/edit',  'App\Http\Controllers\ProfileController@edit')->name('profiles.edit');
Route::put('/profiles/{user}',  'App\Http\Controllers\ProfileController@update')->name('profiles.update');

Route::get('/restaurant/login',  'App\Http\Controllers\RestaurantController@login')->name('restos.login');
Route::post('/restaurant/login/add',  'App\Http\Controllers\RestaurantController@addLogin')->name('restos.addLogin');

Route::get('/livreur/login',  'App\Http\Controllers\LivreurController@login')->name('livreur.login');
Route::post('/livreur/login/add',  'App\Http\Controllers\LivreurController@addLogin')->name('livreur.addLogin');

Route::get('/restaurant/profile/{user}', 'App\Http\Controllers\ProfileRestaurantController@show')->name('restaurant.profile');
Route::get('/restaurant/{user}/editProfile',  'App\Http\Controllers\ProfileRestaurantController@edit')->name('restaurant.EditProfile');
Route::patch('/restaurant/{user}',  'App\Http\Controllers\ProfileRestaurantController@update')->name('restaurant.updateProfile');

// Plats
Route::post('/restaurant/plat/', 'App\Http\Controllers\RestaurantController@AjoutPlat')->name('plat.add');
Route::get('/restaurant/{user}', 'App\Http\Controllers\RestaurantController@affichPlats')->name('plat.liste');
Route::resource('restaurant', 'App\Http\Controllers\RestaurantController');


//Commande
Route::resource('commande', 'App\Http\Controllers\CommandeController');
Route::get('/panier/update', "App\Http\Controllers\CommandeController@updateQte");
Route::get('/panier/paiement', "App\Http\Controllers\CommandeController@pagePaiement");

//panier
Route::get('/panier','App\Http\Controllers\CommandeController@panier')->name('panier');
Route::delete('/panier/commande/{id}','App\Http\Controllers\CommandeController@deleteCommande')->name('panier.delete');

//Route::post('/panier/ajouter','App\Http\Controllers\CartController@store')->name('cart.store');

Route::get('/livreur/profile/{user}', 'App\Http\Controllers\ProfileLivreurController@show')->name('livreur.profile');
Route::get('/livreur/{user}/edit',  'App\Http\Controllers\ProfileLivreurController@edit')->name('livreur.EditProfile');
Route::patch('/livreur/{user}',  'App\Http\Controllers\ProfileLivreurController@update')->name('livreur.updateProfile');
Route::resource('livreurCommandeClient', 'App\Http\Controllers\ProfileLivreurController');
Route::resource('livreur', 'App\Http\Controllers\LivreurController');

Route::resource('clients', 'App\Http\Controllers\ClientController');

Route::resource('isadmins', 'App\Http\Controllers\IsAdminController')->middleware('App\Http\Middleware\IsAdmin');

Route::get('/notification','App\Http\Controllers\NotificationController@show')->name('notification');
Route::get('/notification/delete/{id}','App\Http\Controllers\NotificationController@destroy')->name('notification.delete');





