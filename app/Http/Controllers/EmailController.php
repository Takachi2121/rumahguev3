<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Mail\SendRABMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmailController
{
    public function send(Request $request){
        if(!Auth::check()){
            return redirect()->route('login')->with('error', 'Silahkan login terlebih dahulu');
        }

        $request->validate([
            'rab' => 'required|array'
        ]);

        $target = Auth::user()->email;
        if(!$target){
            return redirect()->route('login')->with('error', 'Silahkan login terlebih dahulu');
        }

        Mail::to($target)->send(new SendRABMail($request->rab));

        return response()->json([
            'status' => true,
            'message' => 'Email terkirim'
        ]);
    }

    public function previewPDF(Request $request)
{
    $rab = $request->input('rab');
    $user = Auth::user();

    // load dulu
    $pdf = Pdf::loadView('PDF.rab', compact('rab','user'))
        ->setPaper('a4','portrait');

    // render dulu
    $dompdf = $pdf->getDomPDF();
    $dompdf->render();

    // ambil jumlah halaman
    $jumlah_halaman = $dompdf->get_canvas()->get_page_count();

    // load ulang view dengan jumlah halaman
    $pdf = Pdf::loadView('PDF.rab', [
        'rab' => $rab,
        'user' => $user,
        'jumlah_halaman' => $jumlah_halaman
    ])->setPaper('a4','portrait');

    return $pdf->stream('rab.pdf');
}
}
