@extends('admin.main')

@section('title', 'Portofolio')
@section('subtitle', 'Kelola portofolio mitra Anda di sini.')

@section('mainContent')
<div class="container-fluid">

    @php
        // Ambil 5 slot portofolio milik 1 mitra, filter yang tidak kosong
        $portfolios = collect([
            $mitra->portfolio,
            $mitra->portfolio2,
            $mitra->portfolio3,
            $mitra->portfolio4,
            $mitra->portfolio5,
        ])->filter();

        $nama = $mitra->user->nama;

        $portfolioCount = $portfolios->count();
    @endphp

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0">Daftar Portofolio</h5>

        <a href="{{ $portfolioCount >= 5 ? '#' : '#' }}"
           class="btn btn-primary {{ $portfolioCount >= 5 ? 'disabled' : '' }}">
            <i class="fa-solid fa-plus"></i> Tambah Portofolio
        </a>
    </div>

    {{-- Alert batas --}}
    @if($portfolioCount >= 5)
        <div class="alert alert-warning text-center">
            <i class="fa-solid fa-triangle-exclamation me-2"></i>
            Maksimal 5 portofolio diperbolehkan.
        </div>
    @endif

    {{-- Grid Portofolio --}}
    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-4 g-4">
        @forelse($portfolios as $index => $gambar)
            <div class="col">
                <div class="card h-100 shadow-sm portfolio-card border-0 rounded-4 overflow-hidden"
                    style="transition: transform 0.3s ease, box-shadow 0.3s ease;">
                    <div class="position-relative overflow-hidden" style="height: 200px;">
                        <img src="{{ asset('assets/img/Portfolio/'.$nama.'/'.$gambar) }}"
                             alt="Portofolio {{ $index + 1 }}"
                             class="w-100 h-100 object-fit-cover"
                             style="transition: transform 0.4s ease;"
                             onmouseover="this.style.transform='scale(1.1)'"
                             onmouseout="this.style.transform='scale(1)'">
                    </div>

                    <div class="card-body">
                        <h6 class="card-title fw-semibold">
                            Portofolio {{ $index + 1 }}
                        </h6>
                        <p class="text-muted small mb-0" style="min-height: 3em;">
                            {{ Str::limit($mitra->deskripsi, 60) }}
                        </p>
                    </div>

                    <div class="card-footer bg-transparent border-0 d-flex gap-2 px-3 pb-3 pt-0">
                        <a href="#"
                           class="btn btn-sm btn-outline-warning flex-fill">
                            <i class="bi bi-pencil-fill me-1"></i> Edit
                        </a>

                        <form method="POST"
                              action="#"
                              onsubmit="return confirm('Hapus portofolio ini?')"
                              class="flex-fill">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger w-100">
                                <i class="bi bi-trash-fill me-1"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center text-muted py-5">
                    <i class="bi bi-images fs-1 mb-3"></i>
                    <p class="fs-5">Belum ada portofolio</p>
                    <p class="small">Silahkan tambahkan portofolio untuk menampilkan karya terbaik Anda.</p>
                </div>
            </div>
        @endforelse
    </div>

</div>

{{-- Tambahkan CSS khusus untuk responsive dan efek --}}
<style>
    .portfolio-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0,0,0,0.15);
    }
    .object-fit-cover {
        object-fit: cover;
    }
</style>
@endsection
