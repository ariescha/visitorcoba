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
                if($this->level_user == 0){
                    return $next($request);
                }else{
                    return abort(401);
                }
            }
        });
       
        
    }
    public function index(){
        date_default_timezone_set("Asia/Bangkok");
        //session and get data visitor
        $nikVisitor = Session::get('nik_visitor');
        // dd($nikVisitor);
        $Visitor = Visitor::whereRaw('nik_visitor = ?', [$nikVisitor])->first();

        return view('visitor.profil')->with('DataVisitor',$Visitor);
    }

    public function updateProfil(Request $request){
        date_default_timezone_set("Asia/Bangkok");
        //session
        $nikVisitorSession = Session::get('nik_visitor');

        //get data for check change instansi
        $Visitor = Visitor::whereRaw('nik_visitor = ?', [$nikVisitorSession])->first();
        $asalInstansiVisitorDB = $Visitor->asal_instansi_visitor;

        //define request
        $namaLengkapVisitorUpdate = $request->namaLengkapVisitor;
        $nikVisitorUpdate = $request->nikVisitor;
        $nomorHpVisitorUpdate = $request->nomorHpVisitor;
        $asalInstansiVisitorUpdate = $request->asalInstansiVisitor;

        //update db
        DB::table('visitor')->where('nik_visitor',$nikVisitorSession)
        ->update([
            'nik_visitor' => $nikVisitorUpdate
        ]);

        //IF ASAL INSTANSI CHANGE -> WAITING APPROVAL
        if ($asalInstansiVisitorUpdate!=$asalInstansiVisitorDB){

            DB::table('visitor')->where('nik_visitor',$nikVisitorUpdate)
                ->update([
                    'nama_lengkap_visitor' => $namaLengkapVisitorUpdate,
                    'nomor_hp_visitor' => $nomorHpVisitorUpdate,
                    'asal_instansi_visitor' => $asalInstansiVisitorUpdate,
                    'status_nda_visitor' => 2
                ]);

            DB::table('nda')->where('nik_visitor',$nikVisitorUpdate)
                ->update([
                    'status_nda' => 2
                ]);
        }else{
            DB::table('visitor')->where('nik_visitor',$nikVisitorUpdate)
                ->update([
                    'nama_lengkap_visitor' => $namaLengkapVisitorUpdate,
                    'nomor_hp_visitor' => $nomorHpVisitorUpdate,
                    'asal_instansi_visitor' => $asalInstansiVisitorUpdate,
                    // 'status_visitor' => 0
                ]);
        }

        //put new nik visitor session
        if ($nikVisitorUpdate!=$nikVisitorSession){
            Session::put('nik_visitor',$nikVisitorUpdate);
        }

        //log activity update profile visitor
        log_activity::create([
            'activity' => 'update profile visitor',
            'id_actor' => $nikVisitorUpdate //nik visitor
            // 'id_object' => $VisitorCheckIn->id_checkin, //id checkin
        ]);

        return redirect('profil-visitor');
    }
}