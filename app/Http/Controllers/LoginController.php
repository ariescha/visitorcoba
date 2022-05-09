<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\Petugas_DC;
use App\Models\list_checkin;
use App\Models\log_activity;
use DB;
class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function store(Request $request){
        $Email = $request->email;
        $Password = $request->password;
        $CekVisitor = Visitor::whereRaw('email_visitor = ?', [$Email])->first();
        $CekPetugasDC = Petugas_DC::whereRaw('email_petugas = ?', [$Email])->first();
        if(isset($CekVisitor) && empty($CekPetugasDC)){
                if(Hash::check($Password,$CekVisitor->password_visitor)){
                    Session::put('user',$CekVisitor->nama_lengkap_visitor);
                    Session::put('nik_visitor',$CekVisitor->nik_visitor);
                    //$VisitorCheckIn = list_checkin::whereRaw('nik_visitor = ?',[$CekVisitor->nik_visitor])->first();
                    
                    log_activity::create([
                        'activity' => 'login',
                        'id_actor' => $CekVisitor->nik_visitor,
                        'id_object' => null,
                    ]);
                    //return view('visitor.dashboard-visitor',['DataVisitor'=>$CekVisitor,'DataCheckIn'=>$VisitorCheckIn]);
                    return redirect('dashboard-visitor');
                }else{
                    return back()->with('alert','Gagal Masuk! Password Salah');
                }
          
            
        }else if(empty($CekVisitor) && isset($CekPetugasDC)){
            if($Password ==  $CekPetugasDC->password_petugas && $CekPetugasDC->status_petugas == 1){
                Session::put('user',$CekPetugasDC->nama_lengkap_petugas);
                Session::put('id_petugas',$CekPetugasDC->id_petugas);
                Session::put('status_petugas',$CekPetugasDC->is_superadmin);
                return redirect('approval-check-in');
                //return view('petugas-dc.approval-check-in');
            }else{
                return back()->with('alert','Gagal Masuk! Password Salah');
            }
        }else{
            return back()->with('alert','Gagal masuk! Pengguna tidak ditemukan');
        }
        
        
 
    }

    public function logout(){
        Session::flush();
        return redirect('login')->with('alert','Anda berhasil logout');
    }
    
    
}
