<?php

namespace App\Http\Controllers;
use App\Models\log_activity;
use App\Models\nda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\ResponseFactory;
class ManageCheckInController extends Controller
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
                if($this->level_user == 1){
                    return $next($request);
                }else{
                    return abort(401);
                }
            }
        });
       
        
    }
    public function index(){
        date_default_timezone_set("Asia/Bangkok");
        // $id_petugas = Session::get('id_petugas');
        // $approval_checkin = DB::table('list_checkin')
        //                 ->where('id_petugas','=',$id_petugas)
        //                 ->where('status_checkin','=',0)
        //                 ->leftjoin('visitor','list_checkin.nik_visitor','=','visitor.nik_visitor')
        //                 ->select('list_checkin.id_checkin','list_checkin.created_at','list_checkin.keperluan_visit','list_checkin.barang_bawaan','visitor.nama_lengkap_visitor','visitor.nomor_hp_visitor')
        //                 ->get();
        
        // $data_checkin = DB::table('list_checkin')
        //                 ->where('list_checkin.id_petugas','=',$id_petugas)
        //                 ->where('status_checkin','=',1)
        //                 ->leftjoin('visitor','list_checkin.nik_visitor','=','visitor.nik_visitor')
        //                 ->leftjoin('petugas_dc','list_checkin.id_petugas','=','petugas_dc.id_petugas')
        //                 ->select('list_checkin.id_checkin','visitor.nama_lengkap_visitor','list_checkin.tanggal_checkin','list_checkin.keperluan_visit','list_checkin.barang_bawaan','list_checkin.approval_timestamp','petugas_dc.nama_lengkap_petugas','visitor.status_nda_visitor')
        //                 ->get();

        // $history_checkin = DB::table('list_checkin')
        //                 ->where('status_checkin','=',2)
        //                 ->orwhere('status_checkin','=',3)
        //                 ->leftjoin('visitor','list_checkin.nik_visitor','=','visitor.nik_visitor')
        //                 ->leftjoin('petugas_dc','list_checkin.id_petugas','=','petugas_dc.id_petugas')
        //                 ->select('list_checkin.id_checkin','visitor.nama_lengkap_visitor','list_checkin.tanggal_checkin','list_checkin.keperluan_visit','list_checkin.barang_bawaan','list_checkin.approval_timestamp','petugas_dc.nama_lengkap_petugas','list_checkin.checkin_time','list_checkin.checkout_time')
        //                 ->selectRaw("(case when status_checkin = 3 then concat('Diapprove Oleh ',nama_lengkap_petugas) when status_checkin = 2 then concat('Direject Oleh ',nama_lengkap_petugas) end) as keterangan")
        //                 ->get();               
        // return view('petugas-dc.approval-check-in',['approval_checkin' => $approval_checkin,'data_checkin'=>$data_checkin,'history_checkin'=>$history_checkin]);
        return view('petugas-dc.approval-check-in');

    }

    public function approve(Request $request){
        date_default_timezone_set("Asia/Bangkok");
        $id_petugas = Session::get('id_petugas');
        $Current = date('His-dmY');

        $data = $request->gambar_visitor;
        $email = $request->email_visitor;
        //dd($email);
        $FileFoto = $request->file('foto_user');
        //dd($FileFoto);

        //define('UPLOAD_DIR','dokumen/');
        // list($type,$data) = explode(';',$data);
        // list(, $data) = explode(',',$data);
        // $data = str_replace(' ', '+', $data);
        // $data = base64_decode($data);
        // $img_name = $Current.'-Foto-'.$email.'.jpeg';
        //file_put_contents(UPLOAD_DIR.$img_name.".jpeg", $data);

        //$Current = date('His-dmY');
        //$extension = $FileNda->getClientOriginalExtension();
        //$FileNameNda = $Current.'-NDA-'.$Email.'.'.$extension;
        //.$FotoKtpVisitor->getClientOriginalName();

        $extension = $FileFoto->getClientOriginalExtension();
        $img_name = $Current.'-Foto-'.$email.'.'.$extension;
        Storage::disk('sftpFoto')->put($img_name, fopen($FileFoto, 'r+'));
        //Storage::disk('sftpFoto')->put($img_name, $FileFoto);

        // $FotoKtpVisitor = $request->file('file');
        // $FotoKtpVisitors = $Current.'-'.$FotoKtpVisitor->getClientOriginalName();
        // $FotoKtpVisitor->move('dokumen',$FotoKtpVisitors);
        DB::table('list_checkin')->where('id_checkin',$request->id_approval_checkin)
        ->update([
            'nomor_tag_visitor' => $request->nomor_visitor_tag,
            'foto_visitor' => $img_name,
            'status_checkin' => 1,
            'approval_timestamp' => date('Y-m-d H:i:s'),
        ]);

        log_activity::create([
            'activity' => 'checkin approve',
            'id_actor' => $id_petugas,
            'id_object' => $request->id_approval_checkin,
        ]);
        
        return response()->json(['status' => true, 'data' => null]);
        //return redirect('/approval-check-in');
    }

    public function reject(Request $request){
        date_default_timezone_set("Asia/Bangkok");
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
    return response()->json(['status' => true, 'data' => null]);
    //return redirect('/approval-check-in');
    }

    public function checkout(Request $request){
    date_default_timezone_set("Asia/Bangkok");
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
            
            return response()->json(['status' => true, 'data' => null]);
            
        }
        else{
            return response()->json(['status' => false, 'data' => 'Tidak bisa Checkout Karena NDA Expired']);
            
        }
    }

    public function CheckoutPetugas(Request $request){
        date_default_timezone_set("Asia/Bangkok");
        $id_petugas = Session::get('id_petugas');    
        //dd($id_petugas);
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
                
                return response()->json(['status' => true, 'data' => null]);
                
            }
            else{
                return response()->json(['status' => false, 'data' => 'Tidak bisa Checkout Karena NDA Expired']);
                
            }
    }
    

    public function LoadNewApprovalCheckin() {
        date_default_timezone_set("Asia/Bangkok");
        $id_petugas = Session::get('id_petugas');
        $approval_checkin = DB::table('list_checkin')
                        ->where('id_petugas','=',$id_petugas)
                        ->where('status_checkin','=',0)
                        ->leftjoin('visitor','list_checkin.nik_visitor','=','visitor.nik_visitor')
                        ->select('list_checkin.id_checkin','list_checkin.created_at','list_checkin.keperluan_visit','list_checkin.barang_bawaan','visitor.nama_lengkap_visitor','visitor.nomor_hp_visitor','visitor.email_visitor')
                        ->selectraw("DATE_FORMAT(list_checkin.approval_timestamp,'%d-%b-%Y %H:%i') as approval_timestamp")
                        ->selectraw("DATE_FORMAT(list_checkin.checkin_time,'%d-%b-%Y') as checkin_time")
                        ->selectraw("DATE_FORMAT(list_checkin.checkout_time,'%d-%b-%Y %H:%i') as checkout_time")
                        ->orderBy('created_at', 'ASC')
                        ->get();

        return response()->json(['status' => true, 'data' => $approval_checkin]);
    }

    public function LoadApprovalCheckinHistory() {
        date_default_timezone_set("Asia/Bangkok");
        $history_checkin = DB::table('list_checkin')
                        ->where('status_checkin','=',2)
                        ->orwhere('status_checkin','=',3)
                        ->leftjoin('visitor','list_checkin.nik_visitor','=','visitor.nik_visitor')
                        ->leftjoin('petugas_dc','list_checkin.id_petugas','=','petugas_dc.id_petugas')
                        ->select('list_checkin.id_checkin','visitor.nama_lengkap_visitor','list_checkin.tanggal_checkin','list_checkin.keperluan_visit','list_checkin.barang_bawaan','petugas_dc.nama_lengkap_petugas')
                        ->selectRaw("(case when status_checkin = 3 then concat('Diapprove Oleh ',nama_lengkap_petugas) when status_checkin = 2 then concat('Direject Oleh ',nama_lengkap_petugas) end) as keterangan")
                        ->selectraw("DATE_FORMAT(list_checkin.approval_timestamp,'%d-%b-%Y %H:%i') as approval_timestamp")
                        ->selectraw("DATE_FORMAT(list_checkin.checkin_time,'%d-%b-%Y') as checkin_time")
                        ->selectraw("DATE_FORMAT(list_checkin.checkout_time,'%d-%b-%Y %H:%i') as checkout_time")
                        ->orderBy('checkout_time', 'DESC')
                        ->get();   
        
        return response()->json(['status' => true, 'data' => $history_checkin]);
    }

    public function LoadApprovalCheckin() {
        date_default_timezone_set("Asia/Bangkok");
        $id_petugas = Session::get('id_petugas');
        $data_checkin = DB::table('list_checkin')
                        ->where('list_checkin.id_petugas','=',$id_petugas)
                        ->where('status_checkin','=',1)
                        ->leftjoin('visitor','list_checkin.nik_visitor','=','visitor.nik_visitor')
                        ->leftjoin('petugas_dc','list_checkin.id_petugas','=','petugas_dc.id_petugas')
                        ->select('list_checkin.id_checkin','visitor.nama_lengkap_visitor','list_checkin.tanggal_checkin','list_checkin.keperluan_visit','list_checkin.barang_bawaan','list_checkin.approval_timestamp','petugas_dc.nama_lengkap_petugas','visitor.status_nda_visitor','list_checkin.nomor_tag_visitor', 'list_checkin.foto_visitor')
                        ->selectraw("DATE_FORMAT(list_checkin.approval_timestamp,'%d-%b-%Y %H:%i') as approval_timestamp")
                        ->selectraw("DATE_FORMAT(list_checkin.checkin_time,'%d-%b-%Y') as checkin_time")
                        ->selectraw("DATE_FORMAT(list_checkin.checkout_time,'%d-%b-%Y %H:%i') as checkout_time")
                        ->orderBy('checkin_time', 'DESC')
                        ->get();

        return response()->json(['status' => true, 'data' => $data_checkin]);
    }

    public function DownloadFoto($file_name) {
        date_default_timezone_set("Asia/Bangkok");
        if (Storage::disk('sftpFoto')->exists($file_name)) {
            //$contents = Storage::disk('sftpNDA')->get($file_name);
            return Storage::disk('sftpFoto')->download($file_name);
        }
        else {
            return response('', 200);
        }
    }
}
