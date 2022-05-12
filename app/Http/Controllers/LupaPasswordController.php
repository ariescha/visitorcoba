<?php

namespace App\Http\Controllers;
use Mail;
use Carbon\Carbon;
use App\Models\Visitor;
use App\Models\Petugas_DC;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Mail\ResetPasswordMail;
use DB;

class LupaPasswordController extends Controller
{
    public function index(){
        date_default_timezone_set("Asia/Bangkok");
        return view('lupa-password');
    }

    public function send(Request $request){
        date_default_timezone_set("Asia/Bangkok");
        $email = $request->email;
        
        $token = Str::random(64);

        DB::table('reset_password')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
          ]);

        // Mail::send('email-lupa-password', ['token' => $token], function($message) use($request){
        //     $message->to($request->email);
        //     $message->subject('Reset Password');
        // });
        Mail::to($request->email)->send(new ResetPasswordMail($token));

        return back()->with('alert', 'Link reset password berhasil dikirimkan ke email anda. Segera periksa email anda!');
    }

    public function resetform($token){ 
        date_default_timezone_set("Asia/Bangkok");
        $email = DB::table('reset_password')->where(['token'=> $token])->select('email')->first();
        if($email !== null){
            return view('reset-password-form', ['token' => $token,'email'=>$email]);
        }else{
            return ("Mohon maaf, waktu ganti password anda sudah habis! Silahkan request ganti password ulang!");
        }
     }

    public function reset(Request $request){
        date_default_timezone_set("Asia/Bangkok");
        // $request->validate([
        //     'email' => 'required|email|exists:users',
        //     'password' => 'required|string|min:6|confirmed',
        //     'password_confirmation' => 'required'
        // ]);

        $updatePassword = DB::table('reset_password')
                            ->where([
                              'email' => $request->email, 
                              'token' => $request->token
                            ])
                            ->first();

        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $Visitor = Visitor::where('email_visitor', $request->email)
                    ->update(['password_visitor' => Hash::make($request->password)]);
        
        if(!$Visitor){
            $Petugas_DC = Petugas_DC::where('email_petugas', $request->email)
                    ->update(['password_petugas' => Hash::make($request->password)]);
        }

        DB::table('reset_password')->where(['email'=> $request->email])->delete();

        return redirect('/login')->with('alert', 'Password berhasil diubah!');
    
    }

}
