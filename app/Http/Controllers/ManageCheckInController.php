<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManageCheckInController extends Controller
{
    public function index(){
        return view('petugas-dc.approval-check-in');
    }
}
