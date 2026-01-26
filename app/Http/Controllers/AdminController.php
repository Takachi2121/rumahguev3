<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function editUser($id, Request $request){
        $request->validate([
            'namaUser' => 'required',
            'emailUser' => 'required|email|unique:users,email,' . $id,
        ],[
            'namaUser.required' => 'Nama Tidak Boleh Kosong',
            'emailUser.required' => 'Email Tidak Boleh Kosong',
            'emailUser.unique' => 'Email Sudah Terdaftar',
        ]);

        $user = User::findOrFail($id);

        $user->nama = $request->namaUser;
        $user->email = $request->emailUser;
        $user->is_mitra = 0;

        $user->update();

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diubah'
        ]);
    }


    public function hapusUser($id){
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Dihapus'
        ]);
    }

    public function tambahUser(Request $request){
        $request->validate([
            'namaUser' => 'required',
            'emailUser' => 'required|email|unique:users,email',
        ],[
            'namaUser.required' => 'Nama Tidak Boleh Kosong',
            'emailUser.required' => 'Email Tidak Boleh Kosong',
            'emailUser.unique' => 'Email Sudah Terdaftar',
        ]);

        $user = new User();
        $user->nama = $request->namaUser;
        $user->email = $request->emailUser;
        $user->password = Hash::make('password');
        $user->is_mitra = 0;

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Ditambahkan'
        ]);
    }
}
