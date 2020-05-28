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
| *** Developed by Nurzatilimani binti Muhamad Ahwan 
| *** Date: 22/10/2019 
| *** Last Update: 17/12/2019
*/

Route::get('/', function () {
    return view('auth.login');
});
 
Route::group(['middleware' => 'revalidate'], function()
{
    Auth::routes();
});
Route::middleware(['auth','revalidate'])->group(function () {
    // Home
    Route::get('/home', 'HomeController@index');
     // Check Status
     Route::get('/checkavailables','CheckAvailableController@view');
  Route::resource('checkavailable','CheckAvailableController');
    // Chair
   Route::resource('statustable','StatusTableController');
     // Table
     Route::get('/tables','TableController@view');
     Route::resource('table','TableController');
   // Audit Trail
    Route::get('/audittrails','AudittrailController@view');
    Route::resource('audittrail','AudittrailController');
  

    
});
