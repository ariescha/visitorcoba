<?php

namespace App\Http\Controllers;
use App\Models\log_activity;
use App\Models\nda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\ResponseFactory;


class ManageRegisterController extends Controller
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
        $visitor = DB::table('visitor')
                    ->leftJoin('petugas_dc', function($join){
                        $join->on('visitor.approval_by', '=', 'petugas_dc.id_petugas')
                            ->orOn('visitor.rejected_by', '=', 'petugas_dc.id_petugas');
                    })
                    //->leftjoin->on('petugas_dc','visitor.approval_by','=','petugas_dc.id_petugas')
                    //->leftjoin('petugas_dc','visitor.rejected_by','=','petugas_dc.id_petugas')
                    //->select('visitor.*')
                    ->select('visitor.*')
                    ->selectRaw("(case when status_nda_visitor = 1 then 'Ada' when status_nda_visitor = 2 then 'kadaluwarsa' else 'Belum Ada' end) as status_nda")
                    ->selectRaw("(case when status_nda_visitor = 1 then 'Lihat File' when status_nda_visitor = 2 then 'Perbarui' else 'Unggah' end) as text_nda")
                    ->selectRaw("(case when status_visitor = 1 then concat('Diapprove Oleh ',nama_lengkap_petugas) when status_visitor = 2 then concat('Direject Oleh ',nama_lengkap_petugas) else '' end) as keterangan")
                    ->where ('status_visitor', '!=', 0)
                    ->get();
        //dd($visitor);
        $VisitorNew = DB::table('visitor')
                    ->where ('status_visitor', '=', 0)
                    ->get();

        return view('petugas-dc.approval-registrasi');
        //return view('petugas-dc.approval-registrasi',['visitor' => $visitor, 'VisitorNew' => $VisitorNew]);
    }

    public function ApproveRegister(Request $request){
        date_default_timezone_set("Asia/Bangkok");
        //nik_visitor
        $id_petugas = Session::get('id_petugas');
        $timestamp = date('Y-m-d H:i:s');
        DB::table('visitor')->where('nik_visitor',$request->NikVisitor)
        ->update([
            'approval_timestamp' => $timestamp,
            'approval_by' => $id_petugas,
            'status_visitor' => 1,
        ]);

        log_activity::create([
            'activity' => 'register approve',
            'id_actor' => $id_petugas,
            'id_object' => $request->NikVisitor,
        ]);

        return response()->json(['status' => true, 'data' => null]);
        //return redirect('/approval-registrasi');
    }

    public function RejectRegister(Request $request){
        //nik_visitor
        date_default_timezone_set("Asia/Bangkok");
        $id_petugas = Session::get('id_petugas');
        $timestamp = date('Y-m-d H:i:s');
        DB::table('visitor')->where('nik_visitor',$request->NikVisitor)
        ->update([
            'rejected_timestamp' => $timestamp,
            'rejected_by' => $id_petugas,
            'rejected_alasan' => $request->AlasanReject,
            'status_visitor' => 2,
        ]);

        log_activity::create([
            'activity' => 'register reject',
            'id_actor' => $id_petugas,
            'id_object' => $request->NikVisitor,
        ]);

        return response()->json(['status' => true, 'data' => null]);
        //return redirect('/approval-registrasi');
    }

    public function downloadktp($file_name) {
        //$file_path = public_path('dokumen/'.$file_name);
        //$file_path = '/dokumen/'.$file_name;
        date_default_timezone_set("Asia/Bangkok");
        if (Storage::disk('sftpKTP')->exists($file_name)) {
            $contents = Storage::disk('sftpKTP')->get($file_name);
            //dd($contents);
            return Storage::disk('sftpKTP')->download($file_name);
            //return response()->download($contents);
        }
        else {
            return response('', 200);
        }
        // if (file_exists($file_path)) {
            
        //     //return response('Hello World', 200);
        //     return response()->download($file_path);
        //     //return response()->json(['status' => true, 'data' => $file_path]);
        //     //return Response::json(['hello' => $value],201);
        // } else {
        //     return response('', 200);
        //     //return Response::json(['hello' => $value],201);
        //     //return redirect()->back() ->with('alert', 'File Tidak Ada!');
        //     //alert('bocah tolol');
        // }
    }

    public function UploadNDA(Request $request){
        date_default_timezone_set("Asia/Bangkok");
        $id_petugas = Session::get('id_petugas');
        //$Current = date('His-dmY');
        $FileNda = $request->file('file_nda');
        //$FileNameNda = $Current.'-'.$FileNda->getClientOriginalName();
        $Email = $request->EmailVisitor;
        $Current = date('His-dmY');
        $extension = $FileNda->getClientOriginalExtension();
        $FileNameNda = $Current.'-NDA-'.$Email.'.'.$extension;
        //.$FotoKtpVisitor->getClientOriginalName();

        Storage::disk('sftpNDA')->put($FileNameNda, fopen($FileNda, 'r+'));

        //$FileNda->move('nda',$FileNameNda);
        nda::create([
            'nik_visitor' => $request->NikVisitor,
            'id_petugas' => $id_petugas,
            'file_nda' => $FileNameNda,
            'tanggal_mulai_nda' => $request->tanggal_mulai_nda,
            'tanggal_akhir_nda' => $request->tanggal_akhir_nda,
            'status_nda' => 1,
        ]);
        DB::table('visitor')->where('nik_visitor',$request->NikVisitor)
        ->update([
            'status_nda_visitor' => 1,
        ]);
        log_activity::create([
            'activity' => 'upload nda',
            'id_actor' => $id_petugas,
            'id_object' => $request->NikVisitor,
        ]);
        
        return redirect('/approval-registrasi');
    }
    // public function GetNDA($nik)
    // {
    //     dd($nik);
    //     //$nik = $request->input('nik_visitor');
    //     $data = nda::find($nik);
    //     // $data = DB::table('nda')
    //     //             ->where ('status_visitor', '=', 0)
    //     //             ->get();
    //     return response()->json($data);
    // }
    public function GetNDA(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok");
        $nik = $request->input('nik_visitor');
        //$data = nda::find($nik);
        //DB::statement(DB::raw('set @rownum=0'));
        $data = DB::table('nda')
                    //->select(DB::raw('@rownum  := @rownum  + 1 AS rownum'))
                    ->select('nda.*')
                    ->selectraw("DATE_FORMAT(nda.tanggal_mulai_nda,'%d-%b-%Y') as tanggal_mulai_nda")
                    ->selectraw("DATE_FORMAT(nda.tanggal_akhir_nda,'%d-%b-%Y') as tanggal_akhir_nda")
                    ->where ('nik_visitor', '=', $nik)
                    ->orderBy('tanggal_akhir_nda', 'desc')
                    ->get();
        return response()->json($data);
    }
    public function DownloadNda($file_name) {
        date_default_timezone_set("Asia/Bangkok");
        if (Storage::disk('sftpNDA')->exists($file_name)) {
            //$contents = Storage::disk('sftpNDA')->get($file_name);
            return Storage::disk('sftpNDA')->download($file_name);
        }
        else {
            return response('', 200);
        }
    }
    public function LoadNewRegistrasiVisitor() {
        date_default_timezone_set("Asia/Bangkok");
        $VisitorNew = DB::table('visitor')
                    ->where ('status_visitor', '=', 0)
                    ->orderBy('created_at', 'ASC')
                    ->get();
        
        return response()->json(['status' => true, 'data' => $VisitorNew]);
        //return response()->json($data);
    }
    public function LoadRegistrasiVisitor() {
        date_default_timezone_set("Asia/Bangkok");
        $visitor = DB::table('visitor')
                    ->leftJoin('petugas_dc', function($join){
                        $join->on('visitor.approval_by', '=', 'petugas_dc.id_petugas')
                            ->orOn('visitor.rejected_by', '=', 'petugas_dc.id_petugas');
                    })
                    ->select('visitor.*')
                    ->selectRaw("(case when status_nda_visitor = 1 then 'Ada' when status_nda_visitor = 2 then 'kadaluwarsa' else 'Belum Ada' end) as status_nda")
                    ->selectRaw("(case when status_nda_visitor = 1 then 'Lihat File' when status_nda_visitor = 2 then 'Perbarui' else 'Unggah' end) as text_nda")
                    ->selectRaw("(case when status_visitor = 1 then concat('Diapprove Oleh ',nama_lengkap_petugas) when status_visitor = 2 then concat('Direject Oleh ',nama_lengkap_petugas) else '' end) as keterangan")
                    ->where ('status_visitor', '!=', 0)
                    ->orderBy('created_at', 'DESC')
                    ->get();
        
        return response()->json(['status' => true, 'data' => $visitor]);
    }
    
}
