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
Route::post('edit-profil-petugas-dc','ProfilPetugasDCController@update')->name('edit-profil-petugas-dc');

Route::get('profil-visitor','ProfilVisitorController@index')->name('profil-visitor');
Route::get('manajemen-petugas','ManagePetugasController@index')->name('manajemen-petugas');
Route::post('add-petugas','ManagePetugasController@store')->name('add-petugas');
Route::post('edit-petugas','ManagePetugasController@update')->name('edit-petugas');

Route::get('lupa-password','LupaPasswordController@index')->name('lupa-password');
Route::post('lupa-password-send','LupaPasswordController@send')->name('lupa-password-send');
Route::get('reset-password-form/{token}','LupaPasswordController@resetform')->name('reset-password-form');
Route::post('reset-password-send','LupaPasswordController@reset')->name('reset-password-send');




Route::get('/dashboard-visitor', function () {
    return view('visitor.dashboard-visitor');
})->name('dashboard-visitor');

