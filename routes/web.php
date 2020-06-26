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
Route::group(['prefix'=>'auth','namespace'=>'Auth','middleware'=>'chekage'],function (){
    Route::get('adult','CustomAuthController@adult')->name('auth.adult');
});



Route::group(['namespace'=>'Auth'],function (){
    Route::get('site','CustomAuthController@site')->name('auth.site')->middleware('auth:web');
    Route::get('admin/page','CustomAuthController@admin')->name('auth.admin')->middleware('auth:admin');
    Route::get('admin/login','CustomAuthController@adminLogin')->name('auth.admin.login');
    Route::post('admin/Save','CustomAuthController@saveAdminLogin')->name('auth.admin.save');
});



########################## ---------------------  #############################


##########################  Begin Reletions Routes  #############################
Route::group(['namespace'=>'Relations'],function () {
    Route::get('user', 'RelationsController@oneToOneRelationWhereHas');
});
##########################   End Reletions Routes   #############################

##########################  Begin Reletion One To Routes  #############################
Route::group(['namespace'=>'Relations'],function () {
    Route::get('hospitals', 'RelationsController@hospitals')->name('hospitals');
    Route::get('doctors/{hospital_id}', 'RelationsController@doctors')->name('hospital.doctors');
    Route::get('delete-hospital/{hospital_id}', 'RelationsController@deleteHospital')->name('delete.hospital');
    Route::get('hospital-has-doctor', 'RelationsController@hospitalHasDoctor');
    Route::get('hospital-has-male-doctor', 'RelationsController@hospitalHasOnlyMaleDoctors');
    Route::get('doctor/services','RelationsController@getDoctorServices')->name('doctor.services');
    Route::get('services','RelationsController@getAllServices')->name('services');
    Route::post('save-services-to-doctor','RelationsController@saveServicesToDoctor')->name('save.services.to.doctor');

    ########################## Has One Through ###############################
    Route::get('patient-doctor/{id}','RelationsController@patientDoctor')->name('patient-doctor');
    ########################## Has One Through ###############################

    ########################## accessor ###############################

    Route::get('accessor', 'RelationsController@getDoctors');


});
##########################   End Reletion One To Routes   #############################


