<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Petugas_DC;
use App\Models\log_activity;
use Illuminate\Support\Facades\Hash;

class ManagePetugasController extends Controller
{
    public function index(){
        $PetugasDC = Petugas_DC::all();
        // dd($PetugasDC);
        return view('petugas-dc.manajemen-petugas')->with('PetugasDC',$PetugasDC);
    }
    public function store(Request $request){
        $id_petugas_superadmin = Session::get('id_petugas');
        // dd($request);
        $PetugasDC = new Petugas_DC;
        $PetugasDC -> nama_lengkap_petugas = $request->nama_lengkap_petugas;
        $PetugasDC -> npp_petugas = $request->npp_petugas;     
        $PetugasDC -> email_petugas = $request->email_petugas;   
        $PetugasDC -> nomor_hp_petugas = $request->no_hp_petugas;
        $PetugasDC -> status_petugas = $request->status_petugas;
        $PetugasDC -> password_petugas = Hash::make($request->password_petugas);
        $PetugasDC -> save();
        $request->request->add(['saved_petugas_id'=>$PetugasDC->id_petugas]);
        // Petugas_DC::create([
        //     'nama_lengkap_petugas' => $request->nama_lengkap_petugas,
        //     'npp_petugas' => $request->npp_petugas,
        //     'email_petugas' => $request->email_petugas,
        //     'nomor_hp_petugas' => $request->no_hp_petugas,
        //     'status_petugas' => $request->status_petugas,
        //     'password_petugas' => Hash::make($request->password_petugas),
        // ]);
        log_activity::create([
            'activity' => 'add admin',
            'id_actor' => $id_petugas_superadmin,
            'id_object' => $request->saved_petugas_id,
        ]);
        return back();
    }
    public function update(Request $request){
        //dd($request);
        $id_petugas_superadmin = Session::get('id_petugas');

        $PetugasDC = Petugas_DC::find($request->edit_id_petugas);
        $PetugasDC -> nama_lengkap_petugas = $request->edit_nama_lengkap_petugas;
        $PetugasDC -> npp_petugas = $request->edit_npp_petugas;        
        $PetugasDC -> nomor_hp_petugas = $request->edit_no_hp_petugas;
        $PetugasDC -> status_petugas = $request->edit_status_petugas;
        $PetugasDC -> save();
        $request->request->add(['saved_petugas_id'=>$PetugasDC->id_petugas]);
        log_activity::create([
            'activity' => 'update admin',
            'id_actor' => $id_petugas_superadmin,
            'id_object' => $request->saved_petugas_id,
        ]);
        return redirect('manajemen-petugas');
    }
}
