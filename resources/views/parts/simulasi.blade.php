<link rel="stylesheet" href="{{ asset('assets/css/simulasi.css') }}">

<section id="simulasi-rumah">
    <div class="container my-4">

        <h1 class="text-center fw-bold mb-4">
            Simulasi Bangun Rumah
        </h1>

        <div class="row simulasi p-4 rounded-4">

            <!-- FORM -->
            <div class="col-lg-5 mb-4 mb-lg-0">
                <div class="simulasi-form">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Simulasi Rumahgue.id</h5>

                        <a href="#" class="text-dark">
                            <i class="fa-solid fa-arrow-right fa-lg"></i>
                        </a>
                    </div>

                    <form>

                        <div class="mb-3">
                            <label class="form-label">
                                Pilih lokasi strategis :
                            </label>

                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-outline-danger w-50">
                                    Pinggir Jalan
                                </button>

                                <button type="button" class="btn btn-outline-danger w-50">
                                    Hook Jalan
                                </button>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-6 mb-3">
                                <label>Panjang tanah :</label>
                                <div class="position-relative">
                                    <input
                                    type="text" oninput="this.value = this.value.replace(/[^0-9]/g, '', '');"
                                    class="form-control"
                                    name="panjangTanah"
                                    placeholder="Masukan angka..."
                                    >
                                    <span class="position-absolute end-0 top-50 translate-middle pe-1 text-black-50">m</span>
                                </div>
                            </div>

                            <div class="col-6 mb-3">
                                <label>Lebar tanah :</label>
                                <div class="position-relative">
                                    <input
                                    type="text" oninput="this.value = this.value.replace(/[^0-9]/g, '', '');"
                                    class="form-control"
                                    name="lebarTanah"
                                    placeholder="Masukan angka..."
                                    >
                                    <span class="position-absolute end-0 top-50 translate-middle pe-1 text-black-50">m</span>
                                </div>
                            </div>

                        </div>

                        <div class="mb-3">
                            <label>Luas tanah :</label>
                            <div class="position-relative">
                                <input
                                type="text" oninput="this.value = this.value.replace(/[^0-9]/g, '', '')"
                                class="form-control"
                                name="luasTanah"
                                placeholder="Masukan angka..."
                                >
                                <span class="position-absolute end-0 top-50 translate-middle pe-1 text-black-50">m<sup>2</sup></span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Luas rekomendasi bangunan :</label>
                            <div class="position-relative">
                                <input
                                type="text" oninput="this.value = this.value.replace(/[^0-9]/g, '', '')"
                                class="form-control"
                                name="luasRekomendasi"
                                placeholder="Masukan angka..."
                                >
                                <span class="position-absolute end-0 top-50 translate-middle pe-1 text-black-50">m<sup>2</sup></span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Luas carport :</label>
                            <div class="position-relative">
                                <input
                                type="text" oninput="this.value = this.value.replace(/[^0-9]/g, '', '')"
                                name="luasCarport"
                                class="form-control"
                                placeholder="Masukan angka..."
                                >
                                <span class="position-absolute end-0 top-50 translate-middle pe-1 text-black-50">m<sup>2</sup></span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Luas ruang terbuka hijau :</label>
                            <div class="position-relative">
                                <input
                                type="text" oninput="this.value = this.value.replace(/[^0-9]/g, '', '')"
                                name="luasRuangan"
                                class="form-control"
                                placeholder="Masukan angka..."
                                >
                                <span class="position-absolute end-0 top-50 translate-middle pe-1 text-black-50">m<sup>2</sup></span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Lantai :</label>

                            <select class="form-select" name="Lantai">
                                <option selected disabled hidden>Pilih</option>
                                <option value="1 Lantai">1 Lantai</option>
                                <option value="2 Lantai">2 Lantai</option>
                                <option value="3 Lantai">3 Lantai</option>
                            </select>
                        </div>

                        <button class="btn btn-danger w-100 btn-simulasi">
                            Coba Simulasikan
                        </button>

                    </form>

                </div>
            </div>


            <!-- HERO TEXT -->
            <div class="col-lg-7 simulasi-hero d-flex align-items-end">

                <div class="hero-content">

                    <h2>
                        Simulasikan Rumah Impian
                        Loe Sekarang!
                    </h2>

                    <p>
                        RumahGue akan bantu menghitung estimasi biaya pembangunan
                        serta waktu pengerjaan secara jelas, realistis, dan transparan —
                        tanpa tebakan, tanpa kejutan di tengah jalan.
                    </p>

                </div>

            </div>

        </div>

    </div>
</section>
