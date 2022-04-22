<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Petugas_DC;
class ProfilPetugasDCController extends Controller
{
    public function index(){
        $IdPetugasDC = Session::get('id_petugas');
        $PetugasDC = Petugas_DC::find($IdPetugasDC)->get();
        return view('petugas-dc.profil')->with('PetugasDC',$PetugasDC);
    }
}
