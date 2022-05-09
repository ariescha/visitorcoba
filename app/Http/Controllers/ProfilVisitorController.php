<?php

namespace App\Http\Controllers;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\list_checkin;
use App\Models\Petugas_DC;
use App\Models\log_activity;

class ProfilVisitorController extends Controller
{
    public function index(){
        //session and get data visitor
        $nikVisitor = Session::get('nik_visitor');
        // dd($nikVisitor);
        $Visitor = Visitor::whereRaw('nik_visitor = ?', [$nikVisitor])->first();

        return view('visitor.profil')->with('DataVisitor',$Visitor);
    }

    public function updateProfil(Request $request){
        //session
        $nikVisitorSession = Session::get('nik_visitor');

        //define request
        $namaLengkapVisitor = $request->namaLengkapVisitor;
        $nikVisitor = $request->nikVisitor;
        $nomorHpVisitor = $request->nomorHpVisitor;
        $asalInstansiVisitor = $request->asalInstansiVisitor;

        //update db
        DB::table('visitor')->where('nik_visitor',$nikVisitorSession)
        ->update([
            'nik_visitor' => $nikVisitor
        ]);

        DB::table('visitor')->where('nik_visitor',$nikVisitor)
        ->update([
            'nama_lengkap_visitor' => $namaLengkapVisitor,
            'nomor_hp_visitor' => $nomorHpVisitor,
            'asal_instansi_visitor' => $asalInstansiVisitor,
            'status_visitor' => 0
            // 'foto_ktp_visitor' => $FotoKtpVisitorsName
        ]);

        //put new nik visitor session
        if ($nikVisitor!=$nikVisitorSession){
            Session::put('nik_visitor',$nikVisitor);
        }
        //log activity update profile visitor
        log_activity::create([
            'activity' => 'update profile visitor',
            'id_actor' => $nikVisitor //nik visitor
            // 'id_object' => $VisitorCheckIn->id_checkin, //id checkin
        ]);

        return redirect('profil-visitor');
    }
}
