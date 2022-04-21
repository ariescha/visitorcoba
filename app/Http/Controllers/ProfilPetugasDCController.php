<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilPetugasDCController extends Controller
{
    public function index(){
        return view('petugas-dc.profil');
    }
}
