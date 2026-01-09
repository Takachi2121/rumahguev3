<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function loginPage(){
        return view('auth.login');
    }

    public function registerUser(Request $request){
        $request->validate([
            'namaUser' => 'required',
            'emailUser' => 'required|email',
            'passwordUser' => 'required|min:6',
            'passwordUserRepeat' => 'required|same:passwordUser'
        ]);

        $otp = rand(10000,99999);

        Session::put('register_data', [
            'nama' => $request->namaUser,
            'email' => $request->emailUser,
            'password' => bcrypt($request->passwordUser),
            'otp' => $otp
        ]);

        Mail::send('auth.otp', ['otp' => $otp], function($message) use ($request){
            $message->to($request->emailUser);
            $message->subject('Kode OTP Gue');
        });

        return response()->json(['success' => true]);
    }

    public function verifyOTP(Request $request){
        $request->validate([
            'otp' => 'required'
        ]);

        if(!Session::has('register_data')){
            return response()->json(['success' => false]);
        }

        if($request->otp == Session::get('register_data')['otp']){
            $user = User::create([
                'name' => Session::get('register_data')['nama'],
                'email' => Session::get('register_data')['email'],
                'password' => Session::get('register_data')['password']
            ]);
            Session::forget('register_data');
            return response()->json(['success' => true]);
        }else{
            return response()->json(['success' => false]);
        }
    }
}
