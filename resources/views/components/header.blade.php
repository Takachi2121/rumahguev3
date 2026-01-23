<div class="container mt-4 px-0">
    <nav class="navbar-glass w-100 d-flex fixed-top justify-content-evenly align-items-center">

        <!-- LEFT LOGO -->
        <div class="navbar-logo">
            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="logoRumahgue">
        </div>

        <!-- CENTER MENU -->
        <div class="me-5 pe-3 d-lg-inline d-md-none d-sm-none navbar-menu">
            <a href="{{ route('rumahgue') }}" class="text-decoration-none item-nav">Beranda</a>
            <a href="javascript:void(0);" onclick="upcoming()" class="text-decoration-none item-nav">Simulasi Rumah</a>
            <a href="javascript:void(0);" onclick="upcoming()" class="text-decoration-none item-nav">Berita</a>
        </div>

        <script>
            function upcoming() {
                Swal.fire({
                    icon: 'info',
                    title: 'Fitur Segera Hadir',
                    text: 'Fitur ini sedang dalam pengembangan dan akan segera hadir. Terima kasih atas kesabaran Anda!',
                    confirmButtonText: 'OK'
                });
            }
        </script>

        <!-- RIGHT BUTTON -->
        @auth
            <div class="dropdown">
                <button class="btn-signin fw-semibold text-white text-decoration-none dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->nama }}
                </button>
                <ul class="dropdown-menu gap-2" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item d-lg-none d-md-block d-sm-block" href="{{ route('rumahgue') }}">Beranda</a></li>
                    <li><a class="dropdown-item d-lg-none d-md-block d-sm-block" href="{{ route('jasa') }}">Jasa Kami</a></li>
                    <li><a class="dropdown-item" href="#">Pengaturan Akun</a></li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}">Keluar</a></li>
                </ul>
            </div>
        @else
            <a href="{{ route('login') }}" class="btn-signin text-white text-decoration-none">Masuk</a>
        @endif
    </nav>
</div>
