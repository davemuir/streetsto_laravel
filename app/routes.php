<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
//get the user
$user =Auth::user();
//login routes
Route::get('/',  ["as" => "Login","uses" => "UserController@view"]);
Route::get("/login", ["as" => "login","uses" => "UserController@view"]);
Route::post("/login", ["as" => "login form","uses" => "UserController@loginForm"]);
Route::get("/logout", ["as" => "user/logout", "uses" => "UserController@logoutAction"]);
Route::post("/register", ["as" => "register form","uses" => "UserController@registerForm"]);
Route::get("/passwordReset", ["as" => "Reset Password", "uses" => "UserController@passwordView"]);
//email calls
Route::any("/autoAdd/{fname?}/{lname?}/{email?}/{company?}",["as" => "Auto Add User", "uses" => "UserController@autoAddUser"]);
Route::post('/beacons/filemaker/{value?}',  ["as" => "import beacons","uses" => "BeaconsController@import"]);
Route::any("/import/company",["as" => "import company", "uses" => "UserController@importCompany"]);

//dashboard
Route::group(["before" => "auth"], function () {
Route::get("/dashboard", ["as" => "dashboard", "uses" => "DashboardController@view"] );
Route::get("/analytics/index", ["as" => "Analytics", "uses" => "AnalyticsController@view"]);
Route::get("/beacons", ["as" => "Beacons", "uses" => "BeaconsController@view"] );
//cms routes
Route::get("/cms/index", ["as" => "CMS", "uses" => "PerksController@cms"] );
Route::get("/cms/edit/{perkID?}", ["as" => "edit perk", "uses" => "PerksController@edit"]);
Route::put("/cms/edit/{perkID?}", ["as" => "update perk", "uses" => "PerksController@updatePerk"]);
Route::get("/cms/new", ["as" => "new perk", "uses" => "PerksController@newPerk"]);
Route::post("/cms/new", ["as" => "store new perk", "uses" => "PerksController@storeNewPerk"]);
Route::any("/cms/remove/{perkID?}", ["as" => "remove perk", "uses" => "PerksController@removePerk"]);

//beacons
Route::get("/beacons/index", ["as" => "beacons", "uses" => "BeaconsController@view"]);
Route::post("/beacons/store", ["as" => "Save Beacons", "uses" => "BeaconsController@store"]);
//beacon vendor list
Route::get("/vendorlist", function(){
$beacons = DB::connection('mysql')->table('ap1_beacons')->get();
return \Response::json($beacons);
});


//offering
//Route::resource('campaigns', 'CampaignController');
Route::get("/perks/index", ["as" => "Perks", "uses" => "PerksController@view"] );
Route::get('/perks/edit/{offerID}', ["as" => 'edit offer', "uses" =>'PerksController@editOffer']);
Route::get('/perks/create', ["as" => 'create offer', "uses" =>'PerksController@create']);
Route::post('/perks/store', ["as" => 'store offer', "uses" =>'PerksController@store']);
});
