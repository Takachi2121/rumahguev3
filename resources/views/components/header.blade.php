<div class="container mt-4 px-0">
    <nav class="navbar-glass w-75 d-flex position-fixed justify-content-between align-items-center">

        <!-- LEFT LOGO -->
        <div class="navbar-logo">
            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="logoRumahgue">
        </div>

        <!-- CENTER MENU -->
        <div>
            <a href="#" class="text-decoration-none item-nav">Beranda</a>
            <a href="#" class="text-decoration-none item-nav">Tentang Kami</a>
            <a href="#" class="text-decoration-none item-nav">Kategori</a>
        </div>

        <!-- RIGHT BUTTON -->
        <a href="{{ route('login') }}" class="btn-signin text-white text-decoration-none">Sign In</a>
    </nav>
</div>
