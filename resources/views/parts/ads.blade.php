<link rel="stylesheet" href="{{ asset('assets/css/ads.css') }}">

<div class="container px-0">
    <div class="swiper hero-swiper">
        <div class="swiper-wrapper">
            @php
                $data = [
                    ['path' => asset('assets/img/LandingPage/ads/Kontruksi.png'), 'jasa' => 'Jasa Tukang', 'caption' => 'Lihat apakah saat ini sedang ada penawaran menarik untuk jasa tukang dan wujudkan rumah impian Anda dengan biaya lebih terjangkau.', 'promo' => 'TukangPromo', 'title' => 'Pembangunan Rumah'],
                    ['path' => asset('assets/img/LandingPage/ads/Interior.png'), 'jasa' => 'Jasa Interior', 'caption' => 'Temukan desain interior yang sesuai dengan gaya hidup Anda dan wujudkan ruang yang nyaman.', 'promo' => 'InteriorPromo', 'title' => 'Desain Interior'],
                    ['path' => asset('assets/img/LandingPage/ads/Arsitek.png'), 'jasa' => 'Jasa Arsitek', 'caption' => 'Dapatkan layanan arsitektur profesional untuk merancang rumah impian Anda dengan fungsi dan estetika yang optimal.', 'promo' => 'ArsitekPromo', 'title' => 'Jasa Arsitek'],
                ]
            @endphp
            @foreach ($data as $item)
            <div class="swiper-slide">
                <div class="row slide-content" style="background-color: red;">
                    <div class="col-md-6 col ms-5 mt-5 mb-5 align-self-center">
                        <h1 class="text-white fw-bolder">Cek Promo <br>{{ $item['title'] }}</h1>
                        <p class="text-white fw-light">
                            {{ $item['jasa'] }}
                        </p>
                        <p class="fw-light text-white w-75">
                            {{ $item['caption'] }}
                        </p>
                        <br>
                        <a href="{{ route('jasa', ['promo' => $item['promo']]) }}" class="text-decoration-none">
                            Cek Promo
                        </a>
                    </div>
                    <div class="col-md-6 d-lg-inline  w-25 align-self-end">
                        <img src="{{ $item['path'] }}" height="440px" alt="Ads 1" class="d-lg-block d-md-block d-sm-none d-none">
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- dots -->
        <div class="swiper-pagination"></div>
    </div>
</div>

<script>
    const swiper = new Swiper('.hero-swiper', {
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
</script>

