<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SD Bhayangkari 1 Surabaya</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    {{-- <link rel="stylesheet" href="../../css/web_style.css"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('lte/dist/css/style.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('web_assets/style.css') }}">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container py-2">
            <a class="navbar-brand" href="#"><img src="{{ asset('web_assets/img/logo_sekolah.png') }}"
                    alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                </ul>
                <ul class="navbar-nav my-2 my-lg-0 me-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#ekskul">Ekstrakurikuler</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#prestasi">Prestasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#FaQ">FaQ</a>
                    </li>
                    <li class="ml-4">
                        <a class="nav-link btn-daftar text-light px-3" href="{{url('loginWali')}}"
                            >Masuk</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero-section d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="top-content col-md-6">
                    <h2 class=" font-weight-bolder pb-2">SD Kemala <br> Bhayangkari 1 Surabaya</h2>
                    <p class="pb-4">Mencetak anak didik yang berpendidikan tinggi, cakap dalam
                        berbagai keterampilan, mandiri, dan memiliki akhlak mulia. Selain itu, kami juga menanamkan rasa
                        peduli terhadap lingkungan sehingga mereka tumbuh menjadi individu yang bertanggung jawab dan
                        mampu memberikan kontribusi positif bagi masyarakat. </p>

                    @foreach ($landing_page as $item)
                        @if ($item->status == 'on')
                            <a class="nav-link btn-daftar text-light p-0" href="{{route('ads_siswa.create')}}" data-status="{{ $item->status }}">
                                <button class="btn btn-warning rounded-pill px-4">Daftar disini...</button>
                            </a>
                        @else
                            <a class="nav-link btn-daftar text-light p-0" href="#" data-status="{{ $item->status }}">
                                <button class="btn btn-warning rounded-pill px-4">Lihat Selanjutnya...</button>
                            </a>
                        @endif
                    @endforeach
                </div>

                <div class="col-md-6 text-center align-content-center">
                    <img src="{{ asset('web_assets/img/Hero-sec.png') }}" alt="">
                </div>
            </div>
        </div>
    </section>

    <section class="content-2" id="content-2">
        <div class="container">
            <div class="top-content">
                <h2 class="text-center">Kenapa harus SD Kemala <br> Bhayangkari 1 Surabaya?</h2>
                {{-- <p class="text-center pt-2">Vorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis
                    molestie, dictum est a, mattis</p> --}}
            </div>
            <div class="second-content pt-4">
                <div class="card-deck">
                    <div class="card border-0" style="background-color: transparent">
                        <img src="{{asset('web_assets/img/ikon-1.png')}}" class="card-img-top mx-auto" alt="..." style="border-radius: 12px; width:120px">
                        <div class="card-body">
                            <h5 class="card-title text-center">Fasilitas Lengkap</h5>
                        </div>
                    </div>
                    <div class="card border-0" style="background-color: transparent">
                        <img src="{{asset('web_assets/img/ikon-2.png')}}" class="card-img-top mx-auto" alt="..." style="border-radius: 12px; width:120px">
                        <div class="card-body">
                            <h5 class="card-title text-center">Lingkungan Nyaman</h5>
                        </div>
                    </div>
                    <div class="card border-0" style="background-color: transparent">
                        <img src="{{asset('web_assets/img/ikon-3.png')}}" class="card-img-top mx-auto" alt="..." style="border-radius: 12px; width:120px">
                        <div class="card-body">
                            <h5 class="card-title text-center">Pengajar Kompeten</h5>
                        </div>
                    </div>
                    <div class="card border-0" style="background-color: transparent">
                        <img src="{{asset('web_assets/img/ikon-4.png')}}" class="card-img-top mx-auto" alt="..." style="border-radius: 12px; width:120px">
                        <div class="card-body">
                            <h5 class="card-title text-center">Polisi Cilik</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content-3 ">
        <div class="container align-content-center">
            <div class="row align-content-center">
                <div class="content-left col-md-5">
                    <div class="card border-0 text-center">
                        <img src="{{ asset('web_assets/img/Kepsek.png') }}" class="card-img-top" alt="...">
                    </div>
                </div>
                <div class="content-right col-md-7">
                    <p class="mb-0">Sambutan</p>
                    <h3 class="pb-2">Kepala Sekolah</h3>
                    <p>
                        "SD Bhayangkari 1 Surabaya adalah sekolah dasar swasta berakreditasi A dan yang bernaung dibawah
                        yayasan Kemala Bhayangkari Cabang
                        Pim Staf Daerah Jawa Timur. SD Kemala Bhayangkari 1 didirikan pada tgl 8 Januari 1968. Anak
                        didik dari SD Kemala Bhayangkari 1 Surabaya memiliki berbagai prestasi membanggakan, dan bebagai
                        ekstrakurikuler diadakan untuk melatih keaktifan anak didik. Visi Terwujudnya sekolah unggul
                        berprestasi berdasarkan iman dan taqwa, cerdas, terampil, mandiri, dan berbudi pekerti luhur
                        Misi Mempersiapkan anak mandiri dalam kehidupan melalui pembelajaran efektif yang profesional
                        dengan meningkatkan imtaq, kedisiplinan, tata tertib, penguasaan ilmu pengetahuan teknologi
                        ketrampilan serta mengembangkan kreatifitas." <br><br>-Siti Nurhayati
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="jumlah-siswa">
        <div class="container py-5">
            <div class="row mx-auto">
                <div class="col-md-4 mx-auto">
                    <p class="mb-1">Jumlah</p>
                    <h3>Siswa Kami</h3>
                </div>
                <div class="col-md-2 mx-auto">
                    <p class="mb-1 text-center">Total</p>
                    <h3 class="text-center">2000</h3>
                </div>
                <div class="col-md-2 mx-auto">
                    <p class="mb-1 text-center">Laki Laki</p>
                    <h3 class="text-center">1500</h3>
                </div>
                <div class="col-md-2 mx-auto">
                    <p class="mb-1 text-center">Perempuan</p>
                    <h3 class="text-center">500</h3>
                </div>
            </div>
        </div>
    </section>

    <section class="content-program" id="ekskul">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-md-6">
                    <div class="top">
                        <p class="mb-0">Program</p>
                        <h3 class="pb-3">Ekstrakurikuler</h3>
                        <p>Jangan lewatkan kesempatan untuk mengembangkan bakat dan minat Anda melalui berbagai kegiatan
                            ekstrakurikuler yang kami tawarkan. Dapatkan pengalaman berharga, teman baru, dan
                            keterampilan tambahan yang akan mendukung kesuksesan Anda di masa depan. Daftar sekarang dan
                            mulailah perjalanan Anda bersama kami!.</p>
                    </div>
                    <div class="bottom">
                        <div class="row">
                            <div class="col-md-6">
                                <ul>
                                    <li>Polisi Cilik,</li>
                                    <li>Pramuka,</li>
                                    <li>TPA,</li>
                                    <li>Perkusi,</li>
                                    <li>Seni Tari,</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul>
                                    <li>Seni Lukis,</li>
                                    <li>Pencak Silat,</li>
                                    <li>Seni Teater,</li>
                                    <li>English Club,</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <img src="{{ asset('web_assets/img/prestasi.png') }}" class="card-img-top" alt="...">
                </div>
            </div>
        </div>
    </section>

    <section class="prestasi d-flex align-items-center" id="prestasi">
        <div class="container">
            <p class="mb-0">Dokumentasi</p>
            <h3 class="pb-0">Prestasi Kami</h3>

            <div class="slide-container swiper">
                <div class="slide-content">
                    <div class="card-wrapper swiper-wrapper">

                        @foreach ($DataPrestasi as $DP)
                            <div class="card swiper-slide">
                                <div class="image-content">
                                    <span class="overlay"></span>

                                    <div class="card-image">
                                        {{-- <img src="{{ asset('web_assets/img/Kepsek.png') }}" alt="" class="card-img"> --}}
                                        <img class="card-img" id="preview_thumbnail"
                                            src="{{ asset('storage/gambar_thumbnail/' . $DP->gambar_thumbnail) }}"
                                            alt="Preview Gambar">

                                    </div>
                                </div>

                                <div class="card-content p-2">
                                    {{-- <p class="mb-1">{{$DP->tgl_prestasi}}</p> --}}
                                    <p class="mb-1">
                                        {{ \Carbon\Carbon::parse($DP->tgl_prestasi)->locale('id')->translatedFormat('l, d F Y') }}
                                    </p>

                                    <h2 class="name">{{ $DP->nama_prestasi }}</h2>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

                <div class="swiper-button-next swiper-navBtn"></div>
                <div class="swiper-button-prev swiper-navBtn"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <section class="galeri pb-5" id="galeri">
        <div class="title text-center pt-5 pb-3">
            <p class="mb-0">Dokumentasi</p>
            <h3>Kegiatan Kami</h3>
        </div>
        <div class="card-group">
            <div class="card">
                <!-- <img src="./assets/img/kegiatan/1.jpeg" class="card-img-top" alt="..."> -->
                <img src="{{ asset('web_assets/img/kegiatan/1.jpeg') }}" class="card-img-top" alt="...">
            </div>
            <div class="card">
                <img src="{{ asset('web_assets/img/kegiatan/2.jpg') }}" class="card-img-top" alt="...">
            </div>
            <div class="card">
                <img src="{{ asset('web_assets/img/kegiatan/3.jpg') }}" class="card-img-top" alt="...">
            </div>
            <div class="card">
                <img src="{{ asset('web_assets/img/kegiatan/4.jpg') }}" class="card-img-top" alt="...">
            </div>
        </div>
    </section>

    <section class="FaQ d-flex align-items-center" id="FaQ">
        <div class="container">
            <div class="title mb-4">
                <p class="mb-0">Pertanyaan Kamu</p>
                <h3>Frequently Asked Questions</h3>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <div class="accordion" id="accordionExample">
                        <div class="card border-0 mb-3">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-block text-left" type="button" data-toggle="collapse"
                                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Bagaimana prosedur pendaftaran anak saya ke sekolah SD ini?
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    Anda dapat melakukan pandaftaran dengan mengambil formulir pendaftaran dari sekolah
                                    atau melalui situs web resmi kami. Kemudian, lengkapi formulir tersebut dan
                                    kembalikan dengan dokumen yang diperlukan
                                </div>
                            </div>
                        </div>

                        <div class="card border-0 mb-3">
                            <div class="card-header" id="headingTwo">
                                <h2 class="mb-0">
                                    <button class="btn btn-block text-left collapsed" type="button"
                                        data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                        aria-controls="collapseTwo">
                                        Apa syarat dan dokumen yang diperlukan untuk mendaftarkan anak saya?
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseTwo" class="collapse " aria-labelledby="headingTwo"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    Anda dapat melengkapi akta kelahiran anak, kartu identitas orang tua/wali, bukti
                                    alamat, serta biaya pendaftaran.
                                </div>
                            </div>
                        </div>

                        <div class="card border-0 mb-3">
                            <div class="card-header" id="headingThree">
                                <h2 class="mb-0">
                                    <button class="btn btn-block text-left collapsed" type="button"
                                        data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        Bagaimana sistem penilaian di sekolah ini?
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    Sistem penilaian kami didasarkan pada kurikulum nasional dan mungkin melibatkan
                                    ujian, tugas, dan penilaian lainnya. Rincian lebih lanjut dapat ditemukan dalam
                                    panduan pendidikan kami.
                                </div>
                            </div>
                        </div>

                        <div class="card border-0 mb-3">
                            <div class="card-header" id="headingThree">
                                <h2 class="mb-0">
                                    <button class="btn btn-block text-left collapsed" type="button"
                                        data-toggle="collapse" data-target="#collapseFour" aria-expanded="false"
                                        aria-controls="collapseFour">
                                        Apa Akreditasi SDS Kemala Bhayangkari 1 Surabaya?
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseFour" class="collapse" aria-labelledby="headingThree"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    Saat ini SDS Kemala Bhayangkari 1 Surabaya telah terakreditasi "A"
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container py-5 text-light">
            <div class="row justify-content-between">
                <div class="col-md-5">
                    <h2>SD Kemana Bhayangkari 1 Surabaya</h2>
                    <p>SD Bhayangkari 1 Surabaya adalah sekolah dasar swasta berakreditasi A dan yang bernaung dibawah
                        yayasan Kemala Bhayangkari Cabang Pim Staf Daerah Jawa Timur.</p>

                </div>
                <div class="col-md-3">
                    <h5>Navigasi</h5>
                    <ul class="pt-3">
                        <li>Home</li>
                        <li>Ekstrakurikuler</li>
                        <li>Prestasi</li>
                        <li>Kegiatan</li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Sosial Media</h5>
                    <ul class="pt-3">
                        <li>Satu</li>
                        <li>Satu</li>
                        <li>Satu</li>
                        <li>Satu</li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>



    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script> -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- JavaScript -->
    <script src="{{ asset('web_assets/script.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.navbar-nav .nav-item .nav-link').on('click', function() {
                $('.navbar-nav .nav-item').removeClass('active');
                $(this).parent().addClass('active');
            });
        });
    </script>

</body>

</html>
