<?php

namespace App\Http\Controllers;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class ProfilVisitorController extends Controller
{
    public function index(){
        $IdVisitor = Session::get('nik_visitor');
        //dd($IdVisitor);
        $Visitor = Visitor::find($IdVisitor)->first();
    
        return view('visitor.profil')->with('Visitor',$Visitor);
    }
}
