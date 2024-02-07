<?php

use App\Http\Controllers\Dashboard\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;
use App\Http\Middleware\Authenticate;
use GuzzleHttp\Middleware;
use GuzzleHttp\Promise\Create;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

    Route::group(['namespace'=>'App\Http\Controllers\Dashboard','middleware'=>'auth:admin','prefix' => 'admin'], function(){
        Route::get('logout','LoginController@logout')-> name('admin.logout');
        Route::get('dashboard','DashboardController@index')-> name('admin.dashboard');
        Route::group(['prefix'=>'settings'],function(){
            Route::get('shipping-methods/{type}','SettingsController@editShippingMethods')->name('edit.shippings.methods');
            Route::PUT('shipping-methods/{id}','SettingsController@updateShippingMethods')->name('update.shippings.methods');
        });
        ###########################Categories routes#######################################
        Route::group(['prefix'=>'main_categories'],function(){
            Route::get('/','MainCategoriesController@index')-> name('admin.maincategories');
            Route::get('edit/{id}','MainCategoriesController@edit')-> name('admin.maincategories.edit');
            Route::PUT('update/{id}','MainCategoriesController@update')-> name('admin.maincategories.update');
            Route::get('create','MainCategoriesController@create')-> name('admin.maincategories.create');
            Route::PUT('store','MainCategoriesController@store')-> name('admin.maincategories.store');
            Route::get('delete/{id}','MainCategoriesController@delete')-> name('admin.maincategories.delete');
        });
        ###########################End Categories routes###################################
        ################################## sub categories routes ######################################
        Route::group(['prefix' => 'sub_categories'], function () {
            Route::get('/', 'SubCategoriesController@index')->name('admin.subcategories');
            Route::get('create','SubCategoriesController@create')->name('admin.subcategories.create');
            Route::PUT('store', 'SubCategoriesController@store')->name('admin.subcategories.store');
            Route::get('edit/{id}', 'SubCategoriesController@edit')->name('admin.subcategories.edit');
            Route::PUT('update/{id}', 'SubCategoriesController@update')->name('admin.subcategories.update');
            Route::get('delete/{id}', 'SubCategoriesController@delete')->name('admin.subcategories.delete');
        });
        ################################## end Sub categories    #######################################
        ################################## Brands routes ######################################
        Route::group(['prefix' => 'Brands'], function () {
            Route::get('/', 'BrandsController@index')->name('admin.brands');
            Route::get('create', 'BrandsController@create')->name('admin.brands.create');
            Route::PUT('store', 'BrandsController@store')->name('admin.brands.store');
            Route::get('edit/{id}', 'BrandsController@edit')->name('admin.brands.edit');
            Route::PUT('update/{id}', 'BrandsController@update')->name('admin.brands.update');
            Route::get('delete/{id}', 'BrandsController@delete')->name('admin.brands.delete');
        });
        ################################## end Brands    #######################################
        ################################## Tags routes ######################################
        Route::group(['prefix' => 'Tags'], function () {
            Route::get('/', 'TagsController@index')->name('admin.tags');
            Route::get('create', 'TagsController@create')->name('admin.tags.create');
            Route::PUT('store', 'TagsController@store')->name('admin.tags.store');
            Route::get('edit/{id}', 'TagsController@edit')->name('admin.tags.edit');
            Route::PUT('update/{id}', 'TagsController@update')->name('admin.tags.update');
            Route::get('delete/{id}', 'TagsController@delete')->name('admin.tags.delete');
        });
        ################################## end Tags    #######################################
        ################################## Products routes ######################################
        Route::group(['prefix' => 'Products'], function () {
            Route::get('/','ProductsController@index')->name('admin.products');
            Route::get('general-information', 'ProductsController@create')->name('admin.products.general.create');
            Route::post('store-general-information', 'ProductsController@store')->name('admin.products.general.store');
            Route::get('delete/{id}', 'ProductsController@delete')->name('admin.products.delete');


            Route::get('price/{id}', 'ProductsController@getPrice')->name('admin.products.price');
            Route::post('price', 'ProductsController@saveProductPrice')->name('admin.products.price.store');

            Route::get('stock/{id}', 'ProductsController@getStock')->name('admin.products.stock');
            Route::match(['get', 'post'],'stock', 'ProductsController@saveProductStock')->name('admin.products.stock.store');

            Route::get('images/{id}', 'ProductsController@addImages')->name('admin.products.images');
            Route::post('images', 'ProductsController@saveProductImages')->name('admin.products.images.store');
            Route::post('images/db', 'ProductsController@saveProductImagesDB')->name('admin.products.images.store.db');
        });
        ################################## end Products    #######################################
        ################################## attrributes routes ######################################
        Route::group(['prefix' => 'attributes'], function () {
            Route::get('/', 'AttributesController@index')->name('admin.attributes');
            Route::get('create', 'AttributesController@create')->name('admin.attributes.create');
            Route::post('store', 'AttributesController@store')->name('admin.attributes.store');
            Route::get('delete/{id}', 'AttributesController@destroy')->name('admin.attributes.delete');
            Route::get('edit/{id}', 'AttributesController@edit')->name('admin.attributes.edit');
            Route::PUT('update/{id}', 'AttributesController@update')->name('admin.attributes.update');
        });
        ################################## end attributes    #######################################
        ################################## attributes options ######################################
         Route::group(['prefix' => 'options'], function () {
            Route::get('/', 'OptionsController@index')->name('admin.options');
            Route::get('create', 'OptionsController@create')->name('admin.options.create');
            Route::post('store', 'OptionsController@store')->name('admin.options.store');
            Route::get('delete/{id}','OptionsController@delete') -> name('admin.options.delete');
            Route::get('edit/{id}', 'OptionsController@edit')->name('admin.options.edit');
            Route::post('update/{id}', 'OptionsController@update')->name('admin.options.update');
        });
        ################################## end options    #######################################
        ################################## sliders ######################################
        Route::group(['prefix' => 'sliders'], function () {
            Route::get('/', 'SliderController@addImages')->name('admin.sliders.create');
            Route::post('images', 'SliderController@saveSliderImages')->name('admin.sliders.images.store');
            Route::post('images/db', 'SliderController@saveSliderImagesDB')->name('admin.sliders.images.store.db');

        });
        ################################## end sliders    #######################################
        ################################## roles ######################################
        Route::group(['prefix' => 'roles'], function () {
            Route::get('/', 'RolesController@index')->name('admin.roles.index');
            Route::get('create', 'RolesController@create')->name('admin.roles.create');
            Route::post('store', 'RolesController@saveRole')->name('admin.roles.store');
            Route::get('/edit/{id}', 'RolesController@edit') ->name('admin.roles.edit') ;
            Route::post('update/{id}', 'RolesController@update')->name('admin.roles.update');
         });
        ################################## end roles ######################################
    });

    Route::group(['namespace'=>'App\Http\Controllers\Dashboard','middleware'=>'guest:admin','prefix'=> 'admin'], function(){
//         // Route::get('login', function(){
//         //     return "please login with the admin account";
//         // })-> name('admin.login');
    Route::get('login' , 'LoginController@login')-> name('admin.login');
    Route::post('savelogin' , 'LoginController@checkAdminLogin')-> name('save.admin.login');
});
});
