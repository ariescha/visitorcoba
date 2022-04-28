<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Petugas_DC;
class ProfilPetugasDCController extends Controller
{
    public function index(){
        $IdPetugasDC = Session::get('id_petugas');
        //dd($IdPetugasDC);
        $PetugasDC = Petugas_DC::find($IdPetugasDC)->first();
       
        return view('petugas-dc.profil')->with('PetugasDC',$PetugasDC);
    }
    public function update(Request $request){
        //dd($request);
        $PetugasDC = Petugas_DC::find($request->edit_id_petugas);
        $PetugasDC -> nama_lengkap_petugas = $request->edit_nama_lengkap_petugas;
        $PetugasDC -> npp_petugas = $request->edit_npp_petugas;        
        $PetugasDC -> nomor_hp_petugas = $request->edit_nomor_hp_petugas;
        $PetugasDC -> save();
        return redirect('profil-petugas-dc');
    }
}
