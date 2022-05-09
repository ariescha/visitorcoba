<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Visitor;
use App\Models\list_checkin;
use App\Models\Petugas_DC;
use App\Models\log_activity;


class DashboardVisitorController extends Controller{

    public function index(){
        //session
        $nikVisitor = Session::get('nik_visitor');

        //get data checkin terakhir
        $VisitorCheckIn = list_checkin::whereRaw('nik_visitor = ?',[$nikVisitor])->latest()->first();

        //Visitor Checkin for user table history checkin null
        if ($VisitorCheckIn==null){
          $VisitorCheckIn = new \stdClass();
          $VisitorCheckIn->checkin_time = date('Y-m-d H:i:s');
          //status if null
          $VisitorCheckIn->status_checkin = 3;
          $VisitorCheckIn->approval_timestamp = null;
          $VisitorCheckIn->rejected_alasan = null;
        } 

    	//get data petugas
    	$dataPetugas = DB::table('petugas_dc')->get();
        
        //get data visitor
        $DataVisitor = Visitor::whereRaw('nik_visitor = ?', [$nikVisitor])->first();
        
        //get table histor checkin
        $tableHistory = DB::table('list_checkin')
                        ->where('list_checkin.nik_visitor', $nikVisitor)
                        ->leftjoin('petugas_dc','list_checkin.id_petugas','=','petugas_dc.id_petugas')
                        ->select('list_checkin.created_at','petugas_dc.nama_lengkap_petugas',
                        'list_checkin.keperluan_visit','list_checkin.barang_bawaan',
                        'list_checkin.checkin_time','list_checkin.checkout_time')
                        ->orderBy('created_at', 'DESC')
                        ->get();
<<<<<<< Updated upstream

    	// return view with data
=======
        //dd($DataVisitor);
    	// mengirim data pegawai ke view index
>>>>>>> Stashed changes
    	return view('visitor.dashboard-visitor',['dataPetugas' => $dataPetugas, 'DataVisitor' => $DataVisitor,'tableHistory' => $tableHistory, 'DataCheckIn' => $VisitorCheckIn]);
    }


    //checkin
    public function store(Request $request){
        //session
        $nikVisitor = Session::get('nik_visitor');

        //get data visitor
    	$dataVisitor = Visitor::whereRaw('nik_visitor = ?', [$nikVisitor])->first();

        //define request form
        $idPetugas = $request->daftarPic;
        $barangBawaan = $request->barangBawaan;
        $keperluanVisit = $request->keperluanVisit;
        $dateCheckin = date('Y-m-d');
        $dateCheckinTimestamp = date('Y-m-d H:i:s');

        //insert checkin data to list checkin
        if(isset($dataVisitor)){
            if($dataVisitor->status_visitor == 1){
                
                list_checkin::create([
                    'nik_visitor'       => $nikVisitor,
                    'id_petugas'        => $idPetugas,
                    'tanggal_checkin'   => $dateCheckin,
                    'checkin_time'      => $dateCheckinTimestamp,
                    'keperluan_visit'   => $keperluanVisit,
                    'barang_bawaan'     => $barangBawaan,
                    'status_checkin'    => 0
                ]);
            }else{
                return back()->with('alert','Tidak bisa Checkin, akun anda belum approve register/rejected/masih checkin');
            }
        }

        //log activity checkin visitor
        $VisitorCheckIn = list_checkin::whereRaw('nik_visitor = ?',[$nikVisitor])->latest()->first();
        log_activity::create([
            'activity' => 'checkin',
            'id_actor' => $nikVisitor, //nik visitor
            'id_object' => $VisitorCheckIn->id_checkin, //id checkin
        ]);

        return redirect('/dashboard-visitor');
    }

    public function revisiRegister(Request $request){
        //session
        $nikVisitorSession = Session::get('nik_visitor');

        //define request data
        $namaLengkapVisitor = $request->namaLengkapVisitor;
        $nikVisitor = $request->nikVisitor;
        $nomorHpVisitor = $request->nomorHpVisitor;
        $asalInstansiVisitor = $request->asalInstansiVisitor;
        //foto
        $Current = date('His-dmY');
        $FotoKtpVisitor = $request->file('foto_ktp');
        
        //revisi without ktp
        if ($FotoKtpVisitor==null){            
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
                ]);
            
        }else{
            //revisi with ktp
            $FotoKtpVisitorsName = $Current.'-'.$FotoKtpVisitor->getClientOriginalName();
            $FotoKtpVisitor->move('dokumen',$FotoKtpVisitorsName);
        
            DB::table('visitor')->where('nik_visitor',$nikVisitorSession)
                ->update([
                    'nik_visitor' => $nikVisitor
                ]);

            DB::table('visitor')->where('nik_visitor',$nikVisitor)
                ->update([
                    'nama_lengkap_visitor' => $namaLengkapVisitor,
                    'nomor_hp_visitor' => $nomorHpVisitor,
                    'asal_instansi_visitor' => $asalInstansiVisitor,
                    'foto_ktp_visitor' => $FotoKtpVisitorsName,
                    'status_visitor' => 0
                ]);
        }

        //put new nik visitor session
        if ($nikVisitor!=$nikVisitorSession){
            Session::put('nik_visitor',$nikVisitor);
        }
        
        //log activity revisi register visitor
        log_activity::create([
            'activity' => 'revisi register',
            'id_actor' => $nikVisitor //nik visitor
            // 'id_object' => $VisitorCheckIn->id_checkin, //id checkin
        ]);

        return redirect('/dashboard-visitor');
    }

    public function checkoutVisitor(){
        //session
        $nikVisitorSession = Session::get('nik_visitor');

        //get last id checkin
        $VisitorCheckIn = list_checkin::whereRaw('nik_visitor = ?',[$nikVisitorSession])->latest()->first();
        $idCheckin = $VisitorCheckIn -> id_checkin;

        //date for checkout time
        $dateCheckout = date('Y-m-d');
        $dateCheckoutTimestamp = date('Y-m-d H:i:s');

        DB::table('list_checkin')->where('id_checkin',$idCheckin)
                ->update([
                    'checkout_time' => $dateCheckoutTimestamp,
                    'status_checkin' => 3
                ]);

        //log activity (checkout by self) visitor
        log_activity::create([
            'activity' => 'checkout by self',
            'id_actor' => $nikVisitorSession, //nik visitor
            'id_object' => $idCheckin //id checkin
        ]);

        return redirect('/dashboard-visitor');
    }
}