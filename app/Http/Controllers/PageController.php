<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use App\Models\MitraNotification;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Session;

class PageController extends Controller
{
    public function beranda()
    {
        return view('parts.beranda');
    }


    public function jasa(Request $request)
    {
        if(!Auth::check()){
            return redirect()->route('login')->with('error', 'Silahkan login terlebih dahulu');
        }

        $kategori = $request->query('kategori');

        if($kategori == 'Interior'){
            $title = 'Jasa Interior';
            $subtitle = 'Temukan Mitra Terbaik untuk Desain Interior Impian Anda';
        }elseif($kategori == 'Arsitek'){
            $title = 'Jasa Arsitek';
            $subtitle = 'Wujudkan Bangunan Impian Anda dengan Bantuan Arsitek Profesional';
        }elseif($kategori == 'Tukang'){
            $title = 'Jasa Tukang';
            $subtitle = 'Mitra Tukang Terpercaya untuk Semua Kebutuhan Perbaikan Rumah Anda';
        }

        $jasa = Mitra::with('user:id,nama')
            ->where('keahlian', 'LIKE', "%$kategori%")
            ->get(['id', 'user_id', 'harga', 'foto_profil', 'keahlian', 'lokasi']);
        $lokasi = Mitra::select('lokasi')->distinct()->get();
        return view('pages.jasa', compact('jasa', 'lokasi', 'title', 'subtitle'));
    }

    public function jasaDetail($id)
    {
        if(!Auth::check()){
            return redirect()->route('login')->with('error', 'Silahkan login terlebih dahulu');
        }

        $jasa = Mitra::findOrFail($id);

        $sliderImages = array_filter([
            $jasa->foto_profil ? [
                'path' => 'assets/img/Profile/',
                'file' => $jasa->foto_profil
            ] : null,

            $jasa->portfolio ? [
                'path' => 'assets/img/Portfolio/Ray/',
                'file' => $jasa->portfolio
            ] : null,

            $jasa->portfolio2 ? [
                'path' => 'assets/img/Portfolio/Ray/',
                'file' => $jasa->portfolio2
            ] : null,

            $jasa->portfolio3 ? [
                'path' => 'assets/img/Portfolio/Ray/',
                'file' => $jasa->portfolio3
            ] : null,

            $jasa->portfolio4 ? [
                'path' => 'assets/img/Portfolio/Ray/',
                'file' => $jasa->portfolio4
            ] : null,

            $jasa->portfolio5 ? [
                'path' => 'assets/img/Portfolio/Ray/',
                'file' => $jasa->portfolio5
            ] : null,
        ]);

        $relatedJasa = Mitra::where('id', '!=', $id)
            ->where('lokasi', 'LIKE', '%' . $jasa->lokasi . '%')
            ->where('keahlian', 'LIKE', '%' . $jasa->keahlian . '%')
            ->get();

        return view('pages.detail', compact('jasa', 'sliderImages', 'relatedJasa'));
    }

    public function mitraHome()
    {
        if(!Auth::check() || Auth::user()->is_mitra != 1){
            return redirect()->route('login')->with('error', 'Silahkan login terlebih dahulu');
        }

        $mitra = Mitra::where('user_id', Auth::id())->firstOrFail();

        return view('mitra.data', compact('mitra'));
    }

    public function mitraSettings()
    {
        if(!Auth::check()){
            return redirect()->route('login')->with('error', 'Silahkan login terlebih dahulu');
        }

        return view('mitra.pengaturan');
    }

    public function mitraPortfolio()
    {
        if (!Auth::check() || Auth::user()->is_mitra != 1) {
            return redirect()->route('login')
                ->with('error', 'Silahkan login terlebih dahulu');
        }
        $mitra = Mitra::with('user:id,nama')->where('user_id', Auth::id())->firstOrFail();

        // dd($mitra);

        return view('mitra.porto', compact('mitra'));
    }

    public function adminUser()
    {
        if (!Auth::check() || Auth::user()->is_mitra != 2) {
            return redirect()->route('login')
                ->with('error', 'Silahkan login terlebih dahulu');
        }

        $users = User::where('is_mitra', '0')->orderBy('is_mitra', 'desc')->get();
        return view('admin.user', compact('users'));
    }

    public function pengaturan(){
        if(!Auth::check()){
            return redirect()->route('login')->with('error', 'Silahkan login terlebih dahulu');
        }

        $data = User::find(Auth::id());

        return view('pages.pengaturan', compact('data'));
    }

    public function pengaturanUpdate(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'namaUser' => 'required',
            'emailUser' => 'required|email|unique:users,email,' . $user->id,
            'passUser' => 'required',
            'newPassUser' => 'nullable|min:6',
            'passUserRepeat' => 'same:newPassUser',
        ],[
            'passUserRepeat.same' => 'Password Tidak Sama',
            'namaUser.required' => 'Nama Tidak Boleh Kosong',
            'emailUser.required' => 'Email Tidak Boleh Kosong',
            'passUser.required' => 'Isi Password Sekarang untuk melakukan perubahan',
            'emailUser.unique' => 'Email Sudah Terdaftar',
            'newPassUser.min' => 'Password minimal 6 karakter',
        ]);

        if (!Hash::check($request->passUser, $user->password)) {
            return response()->json(['message' => 'Password lama salah'], 422);
        }

        $otp = rand(100000, 999999);

        Session::put('pending_data', [
            'nama' => $request->namaUser,
            'email' => $request->emailUser,
            'password' => $request->newPassUser,
            'otp' => $otp,
            'created_at' => now()
        ]);

        Mail::send('email.change-user', [
            'user_name' => $user->name,
            'otp' => $otp
        ], function($msg) use ($request) {
            $msg->to($request->emailUser)->subject('Verifikasi Perubahan Data Diri Rumahgue');
        });

        return response()->json(['success' => true]);
    }

    public function pengaturanVerif(Request $request)
    {
        $data = Session::get('pending_data');
        if (!$data || $request->otp != $data['otp']) {
            return response()->json(['message' => 'OTP tidak valid'], 422);
        }

        $user = Auth::user();
        $user->update([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'password' => $data['password']
                ? Hash::make($data['password'])
                : $user->password
        ]);

        Session::forget('pending_data');

        return response()->json(['success' => true]);
    }

    public function adminMitra(){
        $mitras = Mitra::with('user:id,nama,email,is_mitra')
            ->whereHas('user', function($query) {
                $query->where('is_mitra', 1);
            })
            ->get();
        return view('admin.mitra', compact('mitras'));
    }

}
