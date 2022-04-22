<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});
Route::get('approval-check-in','ManageCheckInController@index')->name('approval-check-in');
Route::get('approval-registrasi','ManageRegisterController@index')->name('approval-registrasi');
Route::get('login','LoginController@index')->name('login');
Route::post('login-post','LoginController@store')->name('login-post');
Route::get('logout','LoginController@logout')->name('logout');
Route::get('register','RegisterController@index')->name('register');
Route::post('register-post','RegisterController@store')->name('register-post');
Route::get('profil-petugas-dc','ProfilPetugasDCController@index')->name('profil-petugas-dc');


Route::get('/dashboard-visitor', function () {
    return view('visitor.dashboard-visitor');
})->name('dashboard-visitor');

