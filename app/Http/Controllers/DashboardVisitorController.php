<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Visitor;
use App\Models\list_checkin;
use App\Models\Petugas_DC;
use App\Models\log_activity;


class DashboardVisitorController extends Controller
{

    // function logHistory($input){
    //     dd($input);
    // }
    public function index()
    {

        // logHistory("fauzi");
        //get session nik visitor
        $nikVisitor = Session::get('nik_visitor');

        $VisitorCheckIn = list_checkin::whereRaw('nik_visitor = ?',[$nikVisitor])->latest()->first();
        // dd($VisitorCheckIn);
        // $DataVisitor = Session::get('DataVisitor');
        // $DataCheckIn = Session::get('DataCheckIn');
        // dd($uzi, $DataVisitor, $DataCheckIn);

    	//get data petugas
    	$dataPetugas = DB::table('petugas_dc')->get();
        
        //get status visitor
        // $statusVisitor = (Visitor::whereRaw('nik_visitor = ?', [$nikVisitor])->first()) -> status_visitor;
        $DataVisitor = Visitor::whereRaw('nik_visitor = ?', [$nikVisitor])->first();
        // dd($DataVisitor);
        
        // dd($nikVisitor);
        $tableHistory = DB::table('list_checkin')
                        ->where('list_checkin.nik_visitor', $nikVisitor)
                        ->leftjoin('petugas_dc','list_checkin.id_petugas','=','petugas_dc.id_petugas')
                        ->select('list_checkin.created_at','petugas_dc.nama_lengkap_petugas',
                        'list_checkin.keperluan_visit','list_checkin.barang_bawaan',
                        'list_checkin.checkin_time','list_checkin.checkout_time')
                        ->orderBy('created_at', 'DESC')
                        ->get();

    	// mengirim data pegawai ke view index
    	return view('visitor.dashboard-visitor',['dataPetugas' => $dataPetugas, 'DataVisitor' => $DataVisitor,'tableHistory' => $tableHistory, 'DataCheckIn' => $VisitorCheckIn]);
    }

    //checkin
    public function store(Request $request){
        
        $nikVisitor = Session::get('nik_visitor');

        //get data visitor
    	$dataVisitor = Visitor::whereRaw('nik_visitor = ?', [$nikVisitor])->first();
        // Visitor::update()

        $idPetugas = $request->daftarPic;
        $barangBawaan = $request->barangBawaan;
        $keperluanVisit = $request->keperluanVisit;
        // $dateCheckin = $request->dateCheckin;
        $dateCheckin = date('Y-m-d');
        $dateCheckinTimestamp = date('Y-m-d H:i:s');
        // dd($idPetugas,$barangBawaan,$keperluanVisit,$nikVisitor,$dateCheckin, $dataVisitor, $dataVisitor->status_visitor);

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
        $nikVisitorSession = Session::get('nik_visitor');

        //get data visitor
    	// $dataVisitor = Visitor::whereRaw('nik_visitor = ?', [$nikVisitor])->first();

        $namaLengkapVisitor = $request->namaLengkapVisitor;
        $nikVisitor = $request->nikVisitor;
        $nomorHpVisitor = $request->nomorHpVisitor;
        $asalInstansiVisitor = $request->asalInstansiVisitor;
        //foto
        $Current = date('His-dmY');
        $FotoKtpVisitor = $request->file('foto_ktp');
        
        if ($FotoKtpVisitor==null){
            // dd('data foto kosong');
            
            DB::table('visitor')->where('nik_visitor',$nikVisitorSession)
                ->update([
                    'nik_visitor' => $nikVisitor
                ]);

            DB::table('visitor')->where('nik_visitor',$nikVisitor)
                ->update([
                    'nama_lengkap_visitor' => $namaLengkapVisitor,
                    'nomor_hp_visitor' => $nomorHpVisitor,
                    'asal_instansi_visitor' => $asalInstansiVisitor,
                    // 'foto_ktp_visitor' => $FotoKtpVisitorsName,
                    'status_visitor' => 0
                ]);
            
            return redirect('/dashboard-visitor');
        }else{
            $FotoKtpVisitorsName = $Current.'-'.$FotoKtpVisitor->getClientOriginalName();
            $FotoKtpVisitor->move('dokumen',$FotoKtpVisitorsName);
        
            // if (is_null($nomorHpVisitor)){
            //     return back()->with('alert','nomor hp kosong');
            // }

            // dd($nikVisitorSession, $namaLengkapVisitor, $nikVisitor, $nomorHpVisitor, $asalInstansiVisitor, $FotoKtpVisitorsName);


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

            return redirect('/dashboard-visitor');
        }
        
    }

    public function checkoutVisitor(){
        $nikVisitorSession = Session::get('nik_visitor');
        // dd('masukk', $nikVisitorSession);

        $VisitorCheckIn = list_checkin::whereRaw('nik_visitor = ?',[$nikVisitorSession])->latest()->first();
        
        $idCheckin = $VisitorCheckIn -> id_checkin;
        // $checkinTime = $VisitorCheckIn -> checkin_time;
        // dd($idCheckin); 

        $dateCheckout = date('Y-m-d');
        $dateCheckoutTimestamp = date('Y-m-d H:i:s');

        DB::table('list_checkin')->where('id_checkin',$idCheckin)
                ->update([
                    'checkout_time' => $dateCheckoutTimestamp,
                    'status_checkin' => 3
                ]);


        // dd($VisitorCheckIn, $dateCheckout, $dateCheckoutTimestamp);

        return redirect('/dashboard-visitor');
    }

    
}