<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;
use App\Models\Petugas_DC;
use App\Models\log_activity;
class ProfilPetugasDCController extends Controller
{
    function __construct(){
        $this->middleware(function ($request,$next) {
            // fetch session and use it in entire class with constructor
            $this->user = session()->get('user');
            $this->level_user = session()->get('level_user');

            //dd($this->user);
            //return $next($request);
            if($this->user == null){
                return redirect('login')->with('alert','Sesi anda telah habis! Silahkan masuk kembali.');
            }
            else{
                if($this->level_user == 1){
                    return $next($request);
                }else{
                    return abort(401);
                }
            }
        });
       
        
    }
    public function index(){
        date_default_timezone_set("Asia/Bangkok");
        $IdPetugasDC = Session::get('id_petugas');
        //dd($IdPetugasDC);
        $PetugasDC = Petugas_DC::find($IdPetugasDC);
       
        return view('petugas-dc.profil')->with('PetugasDC',$PetugasDC);
    }
    public function update(Request $request){
        date_default_timezone_set("Asia/Bangkok");
        //dd($request);
        $id_petugas = Session::get('id_petugas');

        $PetugasDC = Petugas_DC::find($request->edit_id_petugas);
        $PetugasDC -> nama_lengkap_petugas = $request->edit_nama_lengkap_petugas;
        $PetugasDC -> nik_petugas = $request->edit_nik_petugas;        
        $PetugasDC -> nomor_hp_petugas = $request->edit_nomor_hp_petugas;
        $PetugasDC -> instansi_petugas = $request->edit_instansi_petugas;
        
        $PetugasDC -> save();

        log_activity::create([
            'activity' => 'update profile petugas',
            'id_actor' => $id_petugas,
            'id_object' => null,
        ]);
        return redirect('profil-petugas-dc') ->with('alert', 'Data Berhasil Diperbaharui');
        //return redirect('profil-petugas-dc');

    }
}
