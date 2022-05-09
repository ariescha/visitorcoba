<?php

namespace App\Http\Controllers;
use App\Models\log_activity;
use App\Models\nda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\ResponseFactory;

class ManageRegisterController extends Controller
{
    public function index(){
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
        $file_path = public_path('dokumen/'.$file_name);
        //$file_path = '/dokumen/'.$file_name;

        if (file_exists($file_path)) {
            //return response('Hello World', 200);
            return response()->download($file_path);
            //return response()->json(['status' => true, 'data' => $file_path]);
            //return Response::json(['hello' => $value],201);
        } else {
            return response('', 200);
            //return Response::json(['hello' => $value],201);
            //return redirect()->back() ->with('alert', 'File Tidak Ada!');
            //alert('bocah tolol');
        }
    }

    public function UploadNDA(Request $request){
        $id_petugas = Session::get('id_petugas');
        $Current = date('His-dmY');
        $FileNda = $request->file('file_nda');
        $FileNameNda = $Current.'-'.$FileNda->getClientOriginalName();
        $FileNda->move('nda',$FileNameNda);
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
        $nik = $request->input('nik_visitor');
        //$data = nda::find($nik);
        //DB::statement(DB::raw('set @rownum=0'));
        $data = DB::table('nda')
                    //->select(DB::raw('@rownum  := @rownum  + 1 AS rownum'))
                    ->where ('nik_visitor', '=', $nik)
                    ->orderBy('tanggal_akhir_nda', 'desc')
                    ->get();
        return response()->json($data);
    }
    public function DownloadNda($file_name) {
        //dd($file_name);
        $file_path = public_path('nda/'.$file_name);

        if (file_exists($file_path)) {
            return response()->download($file_path);
        } else {
            return response('', 200);
            //return redirect()->back() ->with('alert', 'File Tidak Ada!');
            //alert('bocah tolol');
        }
    }
    public function LoadNewRegistrasiVisitor() {
        $VisitorNew = DB::table('visitor')
                    ->where ('status_visitor', '=', 0)
                    ->get();
        
        return response()->json(['status' => true, 'data' => $VisitorNew]);
        //return response()->json($data);
    }
    public function LoadRegistrasiVisitor() {
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
                    ->get();
        
        return response()->json(['status' => true, 'data' => $visitor]);
    }
    
}
