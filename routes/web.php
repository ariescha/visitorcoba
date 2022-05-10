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

//Approval Registrasi Visitor
Route::get('approval-registrasi','ManageRegisterController@index')->name('approval-registrasi');
Route::get('LoadNewRegistrasiVisitor','ManageRegisterController@LoadNewRegistrasiVisitor')->name('LoadNewRegistrasiVisitor');
Route::get('LoadRegistrasiVisitor','ManageRegisterController@LoadRegistrasiVisitor')->name('LoadRegistrasiVisitor');
Route::post('approve-registrasi','ManageRegisterController@ApproveRegister')->name('approve-registrasi');
Route::post('reject-registrasi','ManageRegisterController@RejectRegister')->name('reject-registrasi');
Route::post('upload-nda','ManageRegisterController@UploadNDA')->name('upload-nda');
Route::post('get-nda','ManageRegisterController@GetNDA')->name('get-nda');
Route::get('/downloadNda/{filename}', 'ManageRegisterController@DownloadNda')->name('DownloadNda');
Route::get('/downloadktp/{filename}', 'ManageRegisterController@DownloadKtp')->name('DownloadKtp');

//Approval Checkin
Route::post('CheckoutPetugas','ManageCheckInController@CheckoutPetugas')->name('CheckoutPetugas');
Route::get('approval-check-in','ManageCheckInController@index')->name('approval-check-in');
Route::get('LoadNewApprovalCheckin','ManageCheckInController@LoadNewApprovalCheckin')->name('LoadNewApprovalCheckin');
Route::get('LoadApprovalCheckin','ManageCheckInController@LoadApprovalCheckin')->name('LoadApprovalCheckin');
Route::get('LoadApprovalCheckinHistory','ManageCheckInController@LoadApprovalCheckinHistory')->name('LoadApprovalCheckinHistory');
Route::post('approve-check-in','ManageCheckInController@approve')->name('approve-check-in');
Route::post('reject-check-in','ManageCheckInController@reject')->name('reject-check-in');

Route::get('login','LoginController@index')->name('login');
Route::post('login-post','LoginController@store')->name('login-post');
Route::get('logout','LoginController@logout')->name('logout');
Route::get('register','RegisterController@index')->name('register');
Route::post('register-post','RegisterController@store')->name('register-post');

//Admin Profil
Route::get('profil-petugas-dc','ProfilPetugasDCController@index')->name('profil-petugas-dc');
Route::post('edit-profil-petugas-dc','ProfilPetugasDCController@update')->name('edit-profil-petugas-dc');

//Managemen petugas
Route::get('manajemen-petugas','ManagePetugasController@index')->name('manajemen-petugas');
Route::post('add-petugas','ManagePetugasController@store')->name('add-petugas');
Route::post('edit-petugas','ManagePetugasController@update')->name('edit-petugas');

Route::get('lupa-password','LupaPasswordController@index')->name('lupa-password');
Route::post('lupa-password-send','LupaPasswordController@send')->name('lupa-password-send');
Route::get('reset-password-form/{token}','LupaPasswordController@resetform')->name('reset-password-form');
Route::post('reset-password-send','LupaPasswordController@reset')->name('reset-password-send');

//Visitor Checkin
Route::get('/dashboard-visitor','DashboardVisitorController@index')->name('dashboard-visitor');
Route::post('checkin-post','DashboardVisitorController@store')->name('checkin-post');
Route::post('revisi-register','DashboardVisitorController@revisiRegister')->name('revisi-register');
Route::get('checkout-visitor','DashboardVisitorController@checkoutVisitor')->name('checkout-visitor');

//Profil Visitor
Route::get('profil-visitor','ProfilVisitorController@index')->name('profil-visitor');
Route::post('update-profil-visitor','ProfilVisitorController@updateProfil')->name('update-profil-visitor');

