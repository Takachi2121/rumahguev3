<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function beranda()
    {
        return view('parts.beranda');
    }

    public function jasa()
    {
        $jasa = Mitra::with('user:id,nama')
            ->get(['id', 'user_id', 'harga', 'foto_profil', 'keahlian', 'lokasi']);
        $lokasi = Mitra::select('lokasi')->distinct()->get();
        return view('pages.jasa', compact('jasa', 'lokasi'));
    }

     public function jasaDetail($id)
        {
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
}
