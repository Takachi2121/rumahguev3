<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function editUser($id, Request $request){
        $request->validate([
            'namaUser' => 'required',
            'emailUser' => 'required|email|unique:users,email,' . $id,
            'roleUser' => 'required|in:0,1,2'
        ],[
            'namaUser.required' => 'Nama Tidak Boleh Kosong',
            'emailUser.required' => 'Email Tidak Boleh Kosong',
            'emailUser.unique' => 'Email Sudah Terdaftar',
            'roleUser.required' => 'Status Tidak Boleh Kosong',
        ]);

        $user = User::findOrFail($id);

        $user->nama = $request->namaUser;
        $user->email = $request->emailUser;
        $user->is_mitra = $request->roleUser;

        $user->update();

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diubah'
        ]);
    }
}
