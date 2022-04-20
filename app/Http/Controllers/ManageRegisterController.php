<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManageRegisterController extends Controller
{
    public function index(){
        return view('petugas-dc.approval-registrasi');
    }
}
