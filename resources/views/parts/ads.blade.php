<link rel="stylesheet" href="{{ asset('assets/css/ads.css') }}">

<div class="container px-0">
    <div class="swiper hero-swiper">
        <div class="swiper-wrapper">
            @for ($i = 0; $i < 4; $i++)
            <div class="swiper-slide">
                <div class="row slide-content" style="background-color: red;">
                    <div class="col-md-6 col ms-5 mt-5 mb-5 align-self-center">
                        <h1 class="text-white fw-bolder">Promo 50%<br>Pembangungan Rumah</h1>
                        <p class="text-white fw-light">
                            Jasa Kontruksi
                        </p>
                        <p class="fw-light text-white">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laborum cumque doloribus amet ipsam molestias eveniet, est cupiditate, facere eaque fugit reiciendis labore totam sed quas, ducimus velit aspernatur suscipit ipsa.
                        </p>
                        <br>
                        <a href="" class="text-decoration-none fw-medium">
                            Lihat Promo
                        </a>
                    </div>
                    <div class="col-md-6 d-lg-inline  w-25 align-self-end">
                        <img src="{{ asset('assets/img/LandingPage/Ads.png') }}" width="511px" height="440px" alt="Ads 1" class="d-lg-block d-md-block d-sm-none d-none">
                    </div>
                </div>
            </div>
            @endfor
        </div>

        <!-- dots -->
        <div class="swiper-pagination"></div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

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
