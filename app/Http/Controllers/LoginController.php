<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\Petugas_DC;
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
        //dd($request,$Email,$CekPetugasDC,$CekVisitor);
        if(isset($CekVisitor) && empty($CekPetugasDC)){
            if($Password ==  decrypt($CekVisitor->password_visitor)){
                Session::put('user',$CekVisitor->nama_lengkap_visitor);
                Session::put('nik_visitor',$CekVisitor->nik_visitor);
                return view('visitor.dashboard-visitor');
            }else{
                return back()->with('alert','Gagal Masuk! Password Salah');
            }
        }else if(empty($CekVisitor) && isset($CekPetugasDC)){
            if($Password ==  $CekPetugasDC->password_petugas){
                Session::put('user',$CekPetugasDC->nama_lengkap_petugas);
                Session::put('id_petugas',$CekPetugasDC->id_petugas);
                return view('petugas-dc.approval-check-in');
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
