<?php

use App\Http\Controllers\Dashboard\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;
use App\Http\Middleware\Authenticate;
use GuzzleHttp\Middleware;
use GuzzleHttp\Promise\Create;
/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

Route::group(['namespace'=>'App\Http\Controllers\Dashboard','middleware'=>'auth:admin','prefix' => 'admin'], function(){

//         // Route::get('/users',function(){
//         //     return "in admin";
//         // });
        Route::get('dashboard','DashboardController@index')-> name('admin.dashboard');
      

});
Route::group(['namespace'=>'App\Http\Controllers\Dashboard','middleware'=>'guest:admin','prefix'=> 'admin'], function(){
//         // Route::get('login', function(){
//         //     return "please login with the admin account";
//         // })-> name('admin.login');
    Route::get('login' , 'LoginController@login')-> name('admin.login');
    Route::post('savelogin' , 'LoginController@checkAdminLogin')-> name('save.admin.login');
});