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
        return view('lupa-password');
    }

    public function send(Request $request){
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

        return back()->with('alert', 'We have e-mailed your password reset link!');
    }

    public function resetform($token) { 
        return view('reset-password-form', ['token' => $token]);
     }

    public function reset(Request $request){
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

        return redirect('/login')->with('alert', 'Your password has been changed!');
    
    }

}
