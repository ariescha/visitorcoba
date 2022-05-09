<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\log_activity;

class ManageCheckInController extends Controller
{
    function __construct(){
        $this->middleware(function ($request,$next) {
            // fetch session and use it in entire class with constructor
            $this->user = session()->get('user');
            //dd($this->user);
            //return $next($request);
            if($this->user == null){
            
                return redirect('login')->with('alert','Sesi anda telah habis! Silahkan masuk kembali.');
                
            }
            else{
                return $next($request);
            }
        });
       
        
    }
    public function index(){
        $id_petugas = Session::get('id_petugas');
        $approval_checkin = DB::table('list_checkin')
                        ->where('id_petugas','=',$id_petugas)
                        ->where('status_checkin','=',0)
                        ->leftjoin('visitor','list_checkin.nik_visitor','=','visitor.nik_visitor')
                        ->select('list_checkin.id_checkin','list_checkin.created_at','list_checkin.keperluan_visit','list_checkin.barang_bawaan','visitor.nama_lengkap_visitor','visitor.nomor_hp_visitor')
                        ->get();
        
        $data_checkin = DB::table('list_checkin')
                        ->where('list_checkin.id_petugas','=',$id_petugas)
                        ->where('status_checkin','=',1)
                        ->leftjoin('visitor','list_checkin.nik_visitor','=','visitor.nik_visitor')
                        ->leftjoin('petugas_dc','list_checkin.id_petugas','=','petugas_dc.id_petugas')
                        ->select('list_checkin.id_checkin','visitor.nama_lengkap_visitor','list_checkin.tanggal_checkin','list_checkin.keperluan_visit','list_checkin.barang_bawaan','list_checkin.approval_timestamp','petugas_dc.nama_lengkap_petugas','visitor.status_nda_visitor')
                        ->get();

        $history_checkin = DB::table('list_checkin')
                        ->where('status_checkin','=',2)
                        ->orwhere('status_checkin','=',3)
                        ->leftjoin('visitor','list_checkin.nik_visitor','=','visitor.nik_visitor')
                        ->leftjoin('petugas_dc','list_checkin.id_petugas','=','petugas_dc.id_petugas')
                        ->select('list_checkin.id_checkin','visitor.nama_lengkap_visitor','list_checkin.tanggal_checkin','list_checkin.keperluan_visit','list_checkin.barang_bawaan','list_checkin.approval_timestamp','petugas_dc.nama_lengkap_petugas','list_checkin.checkin_time','list_checkin.checkout_time')
                        ->selectRaw("(case when status_checkin = 3 then concat('Diapprove Oleh ',nama_lengkap_petugas) when status_checkin = 2 then concat('Direject Oleh ',nama_lengkap_petugas) end) as keterangan")
                        ->get();               
        return view('petugas-dc.approval-check-in',['approval_checkin' => $approval_checkin,'data_checkin'=>$data_checkin,'history_checkin'=>$history_checkin]);

    }

    public function approve(Request $request){
        $id_petugas = Session::get('id_petugas');
        $Current = date('His-dmY');
        $FotoKtpVisitor = $request->file('foto_visitor');
        $FotoKtpVisitors = $Current.'-'.$FotoKtpVisitor->getClientOriginalName();
        $FotoKtpVisitor->move('dokumen',$FotoKtpVisitors);
        DB::table('list_checkin')->where('id_checkin',$request->id_approval_checkin)
        ->update([
            'nomor_tag_visitor' => $request->nomor_visitor_tag,
            'foto_visitor' => $FotoKtpVisitors,
            'status_checkin' => 1,
            'approval_timestamp' => date('Y-m-d H:i:s'),
        ]);

        log_activity::create([
            'activity' => 'checkin approve',
            'id_actor' => $id_petugas,
            'id_object' => $request->id_approval_checkin,
        ]);
        return redirect('/approval-check-in');
        // return view('petugas-dc.approval-check-in');
        
    }

    public function reject(Request $request){
        $id_petugas = Session::get('id_petugas');
        DB::table('list_checkin')->where('id_checkin',$request->id_rejection_checkin)
        ->update([
        'rejected_alasan' => $request->alasan_reject,
        'status_checkin' => 2,
        'rejected_timestamp' => date('Y-m-d H:i:s'),
    ]);

        log_activity::create([
        'activity' => 'checkin reject',
        'id_actor' => $id_petugas,
        'id_object' => $request->id_rejection_checkin,
    ]);
    return redirect('/approval-check-in');
    }

    public function checkout(Request $request){
    $id_petugas = Session::get('id_petugas');    
    $temp_list = DB::table('list_checkin')
        ->where('id_checkin','=',$request->id_data_checkin)
        ->leftjoin('visitor','list_checkin.nik_visitor','=','visitor.nik_visitor')
        ->select('visitor.*')
        ->first();

        if($temp_list->status_nda_visitor == 1){
            DB::table('list_checkin')->where('id_checkin',$request->id_data_checkin)
            ->update([
            'status_checkin' => 3,
            'checkout_time' => date('Y-m-d H:i:s'),]);    
            log_activity::create([
                'activity' => 'checkout by pic',
                'id_actor' => $id_petugas,
                'id_object' => $request->id_data_checkin,]);
            return redirect('/approval-check-in');
        }
        else{
            return redirect()->back() ->with('alert', 'Tidak bisa Checkout Karena NDA Expired');
            //return redirect('/approval-check-in');
        }
    }
}
