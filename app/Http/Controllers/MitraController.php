<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Session;

class MitraController extends Controller
{
    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'passUser' => 'required|current_password',
            'newPassUser' => 'required',
            'passUserRepeat' => 'required|same:newPassUser'
        ],[
            'passUser.required' => 'Password Saat Ini wajib diisi',
            'newPassUser.required' => 'Password Baru wajib diisi',
            'newPassUser.min' => 'Password Baru minimal 8 karakter',
            'passUserRepeat.required' => 'Konfirmasi Password Baru wajib diisi',
            'passUserRepeat.same' => 'Konfirmasi Password Baru tidak sesuai',
            'passUser.current_password' => 'Password Saat Ini tidak sesuai'
        ]);

        if (!Hash::check($request->passUser, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Password Saat Ini Salah'
            ]);
        }

        $otp = rand(100000, 999999);

        Session::put('pending_password', [
            'email' => $user->email,
            'new_password' => $request->newPassUser,
            'otp' => $otp
        ]);

        Mail::send('email.change-password', [
            'user_name' => $user->nama,
            'otp' => $otp
        ], function ($msg) use ($user) {
            $msg->to($user->email)
                ->subject('Perubahan Password Mitra');
        });

        return response()->json([
            'success' => true,
            'message' => 'OTP telah dikirimkan ke email Anda'
        ]);
    }

    public function newPassword(Request $request)
    {
        $request->validate([
            'otp' => 'required'
        ]);

        $sessionData = Session::get('pending_password');

        if (!$sessionData || $request->otp != $sessionData['otp']) {
            return response()->json([
                'success' => false,
                'message' => 'OTP salah atau kadaluarsa'
            ]);
        }

        User::where('email', $sessionData['email'])->update([
            'password' => Hash::make($sessionData['new_password'])
        ]);

        Session::forget('pending_password');
        Auth::logout();

        return response()->json([
            'success' => true,
            'redirect' => route('login')
        ]);
    }
}
