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

Route::get('/', function () {
    return redirect('/home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');


Route::resource('expenses', 'ExpensesController')->middleware('auth');
Route::get('/changepassword', 'HomeController@change')->middleware('auth');
Route::post('/changepassword', 'HomeController@changePassword')->middleware('auth');


Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function()
{
    Route::resource('users', 'UsersController');
    Route::resource('roles', 'RolesController');
    Route::resource('categories', 'ExpenseCategoriesController');
});