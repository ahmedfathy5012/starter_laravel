<?php

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


use Illuminate\Support\Facades\App;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {

    return view('landing')->with(['data'=>2,'text'=>'ahmed']);
});


Route::prefix('users')->namespace('Front')->group(function (){
    Route::get('name','UserController@showUserName');
});



Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/redirect/{service}', 'SocialController@redirect');
Route::get('/callback/{service}', 'SocialController@callback');

Route::prefix('offers')->group(function (){

    Route::get('create','CRUDController@create');
    Route::get('edit/{offer_id}','CRUDController@editOffer');
    Route::post('store', 'CrudController@store')->name('offers.store');
    Route::get('all','CRUDController@getAllOffers');
    Route::get('update/{offer_id}','CRUDController@updateOffer')->name('offers.update');
});


Route::prefix('offers')->group(function (){

    Route::get('create','CRUDController@create');
    Route::get('edit/{offer_id}','CRUDController@editOffer');
    Route::post('store', 'CrudController@store')->name('offers.store');
    Route::get('all','CRUDController@getAllOffers')->name('offers.all');
    Route::get('update/{offer_id}','CRUDController@updateOffer')->name('offers.update');
    Route::get('delete/{offer_id}','CRUDController@deleteOffer')->name('offers.delete');
});


Route::middleware('auth')->group(function (){
    Route::get('youtube','CRUDController@getVideo');
});


########################## Begin Ajax Routes #############################
Route::group(['prefix'=>'ajax-offers'],function (){
    Route::get('create','OfferController@create');
    Route::post('store','OfferController@store')->name('ajax.offers.store');
    Route::get('index','OfferController@index')->name('ajax.offers.index');
    Route::post('delete','OfferController@delete')->name('ajax.offers.delete');
    Route::get('edit/{id}','OfferController@edit')->name('ajax.offers.edit');
    Route::post('update','OfferController@update')->name('ajax.offers.update');
});
##########################  End Ajax Routes  #############################


########################## Authentication && Gaurds #############################
Route::group(['prefix'=>'ajax-offers'],function (){
    Route::get('create','OfferController@create');
    Route::post('store','OfferController@store')->name('ajax.offers.store');
    Route::get('index','OfferController@index')->name('ajax.offers.index');
    Route::post('delete','OfferController@delete')->name('ajax.offers.delete');
    Route::get('edit/{id}','OfferController@edit')->name('ajax.offers.edit');
    Route::post('update','OfferController@update')->name('ajax.offers.update');
});
########################## ---------------------  #############################
