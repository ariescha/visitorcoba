<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Petugas_DC;
use Illuminate\Support\Facades\Hash;

class ManagePetugasController extends Controller
{
    public function index(){
        $PetugasDC = Petugas_DC::all();
        // dd($PetugasDC);
        return view('petugas-dc.manajemen-petugas')->with('PetugasDC',$PetugasDC);
    }
    public function store(Request $request){
        // dd($request);
        Petugas_DC::create([
            'nama_lengkap_petugas' => $request->nama_lengkap_petugas,
            'npp_petugas' => $request->npp_petugas,
            'email_petugas' => $request->email_petugas,
            'nomor_hp_petugas' => $request->no_hp_petugas,
            'status_petugas' => $request->status_petugas,
            'password_petugas' => Hash::make($request->password_petugas),
        ]);
        return back();
    }
    public function update(Request $request){
        //dd($request);
        $PetugasDC = Petugas_DC::find($request->edit_id_petugas);
        $PetugasDC -> nama_lengkap_petugas = $request->edit_nama_lengkap_petugas;
        $PetugasDC -> npp_petugas = $request->edit_npp_petugas;        
        $PetugasDC -> nomor_hp_petugas = $request->edit_no_hp_petugas;
        $PetugasDC -> status_petugas = $request->edit_status_petugas;
        $PetugasDC -> save();
        return redirect('manajemen-petugas');
    }
}
