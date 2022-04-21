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
        $CekVisitor = DB::table('Visitor')->where('email_visitor','=',$Email)->get();
        $CekPetugasDC = DB::table('Petugas_DC')->where('email_petugas','=',$Email)->get();
        // dd($request,$Email,$CekPetugasDC,$CekVisitor[0]);
        if(isset($CekVisitor[0]) && empty($CekPetugasDC[0])){
            if($Password ==  decrypt($CekVisitor[0]->password_visitor)){
                //dd($Password,)
                Session::put('User',$CekVisitor[0]->nama_lengkap_visitor);
                return view('visitor.dashboard-visitor');
            }else{
                return back()->with('alert','Gagal Masuk! Password Salah');
            }
        }else if(empty($CekVisitor[0]) && isset($CekPetugasDC[0])){
            if($Password ==  $CekPetugasDC[0]->password_petugas){
                Session::put('User',$CekPetugasDC[0]->nama_lengkap_petugas);
                return view('petugas-dc.approval-check-in');
            }else{
                return back()->with('alert','Gagal Masuk! Password Salah');
            }
        }else{
            return back()->with('alert','Gagal masuk! Pengguna tidak ditemukan');
        }
        
 
    }
    
}
