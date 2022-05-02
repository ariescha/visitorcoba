<?php

namespace App\Http\Controllers;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\list_checkin;
use App\Models\Petugas_DC;

class ProfilVisitorController extends Controller
{
    public function index(){
        $nikVisitor = Session::get('nik_visitor');

        // dd($nikVisitor);
        $Visitor = Visitor::whereRaw('nik_visitor = ?', [$nikVisitor])->first();

        // dd($Visitor);
        return view('visitor.profil')->with('DataVisitor',$Visitor);
    }

    public function updateProfil(Request $request){
        $nikVisitorSession = Session::get('nik_visitor');

        $namaLengkapVisitor = $request->namaLengkapVisitor;
        $nikVisitor = $request->nikVisitor;
        $nomorHpVisitor = $request->nomorHpVisitor;
        $asalInstansiVisitor = $request->asalInstansiVisitor;

        DB::table('visitor')->where('nik_visitor',$nikVisitorSession)
        ->update([
            'nik_visitor' => $nikVisitor
        ]);

        DB::table('visitor')->where('nik_visitor',$nikVisitor)
        ->update([
            'nama_lengkap_visitor' => $namaLengkapVisitor,
            'nomor_hp_visitor' => $nomorHpVisitor,
            'asal_instansi_visitor' => $asalInstansiVisitor
            // 'foto_ktp_visitor' => $FotoKtpVisitorsName
        ]);

        return redirect('profil-visitor');
    }
}