<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\Petugas_DC;
use App\Models\log_activity;
class RegisterController extends Controller
{
    public function index(){
        return view('register');
    }

    public function store(Request $request){
        $Current = date('His-dmY');
        $Email = $request->email;
        $Nik = $request->nik;
        $CekEmailVisitor = Visitor::whereRaw('email_visitor = ?', [$Email])->first();
        $CekNikVisitor = Visitor::whereRaw('nik_visitor = ?', [$Nik])->first();
        $CekEmailPetugas = Petugas_DC::whereRaw('email_petugas = ?',[$Email])->first();
        $FotoKtpVisitor = $request->file('foto_ktp');
        $FotoKtpVisitors = $Current.'-'.$FotoKtpVisitor->getClientOriginalName();
        $FotoKtpVisitor->move('dokumen',$FotoKtpVisitors);
        if(!isset($CekEmailVisitor) && !isset($CekNikVisitor) && !isset($CekEmailPetugas)){
        
                Visitor::create([
                    'nama_lengkap_visitor' => $request->nama_lengkap,
                    'nik_visitor'          => $request->nik,
                    'nomor_hp_visitor'     => $request->no_hp,
                    'asal_instansi_visitor'=> $request->asal_instansi,
                    'email_visitor'        => $Email,
                    'password_visitor'     => Hash::make($request->password),
                    'foto_ktp_visitor'     => $FotoKtpVisitors,
                    'status_visitor'       => 0,
                ]);

                log_activity::create([
                    'activity' => 'register',
                    'id_actor' => $request->nik,
                    'id_object' => null,
                ]);
                return redirect('/login');
        
        }
        else{
            return back()->with('alert','Akun anda telah terdaftar, Silahkan log in!');
            
        }
        
 
    }
}
