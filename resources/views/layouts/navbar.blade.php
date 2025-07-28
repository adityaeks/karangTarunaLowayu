<!-- Tambahkan CSS khusus (bisa diletakkan di file CSS eksternal atau di dalam tag <style> di head) -->
<style>
    .sticky-logo {
        display: flex;
        align-items: center;
    }

    .sticky-logo img {
        width: 60px;
        /* Atur ukuran logo sesuai kebutuhan */
        height: auto;
    }

    .sticky-logo .nav-link {
        font-size: 21px;
        /* Sama dengan teks menu navigasi */
        color: #e74c3c;
        /* Sesuaikan dengan warna teks menu navigasi */
        font-weight: 700;
        /* Sama dengan teks menu navigasi */
        text-transform: none;
        /* Agar huruf tidak otomatis diubah */
        margin-left: 0.5rem;
        /* Jarak antara logo dan teks */
    }
</style>

<!-- Bagian Navbar di header -->
<div class="header-area">
    <div class="main-header">
        <!-- Bagian header-top (misalnya untuk info cuaca dan tanggal) -->
        <div class="header-top black-bg d-none d-md-block">
            <div class="container">
                <div class="col-xl-12">
                    <div class="row d-flex justify-content-between align-items-center">
                        <div class="header-info-left">
                            <ul>
                                <!-- Elemen untuk suhu -->
                                <li>
                                    <img src="{{ asset('assets/img/icon/header_icon1.png') }}" alt="">
                                    <span id="current-temp"></span>
                                </li>
                                <!-- Elemen untuk tanggal -->
                                <li>
                                    <img src="{{ asset('assets/img/icon/header_icon1.png') }}" alt="">
                                    <span id="current-date"></span>
                                </li>
                            </ul>
                        </div>
                        <div class="header-info-right">
                            <ul class="header-social">
                                <li><a href="https://web.facebook.com/katar.lowayu"><i class="fab fa-facebook"></i></a></li>
                                <li><a href="https://www.instagram.com/galow.tunas.bangsa"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="https://api.whatsapp.com/send/?phone=%2B6285183260964&text&type=phone_number&app_absent=0"><i class="fab fa-whatsapp"></i></a></li>
                                <li><a href="https://www.tiktok.com/@galow.tunas.bangsa">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon-tiktok" aria-label="TikTok" style="width: 16px; height: 16px;">
                                        <path fill="currentColor" d="M16.6 5.82s.51.5 0 0A4.28 4.28 0 0 1 15.54 3h-3.09v12.4a2.59 2.59 0 0 1-2.59 2.5c-1.42 0-2.6-1.16-2.6-2.6c0-1.72 1.66-3.01 3.37-2.48V9.66c-3.45-.46-6.47 2.22-6.47 5.64c0 3.33 2.76 5.7 5.69 5.7c3.14 0 5.69-2.55 5.69-5.7V9.01a7.35 7.35 0 0 0 4.3 1.38V7.3s-1.88.09-3.24-1.48"/>
                                    </svg>
                                </a></li>
                                <li><a href="mailto:galowtunasbangsa@gmail.com"><i class="fas fa-envelope"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Bagian header-bottom dan sticky header -->
        <div class="header-bottom header-sticky">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-10 col-lg-10 col-md-12 header-flex">
                        <!-- Sticky Logo dengan teks di samping icon -->
                        <div class="sticky-logo">
                            <a href="{{ url('/') }}" class="d-flex align-items-center text-decoration-none" style="height:50px">
                                <img src="{{ asset('assets/img/logo/logo-utama-header.png') }}" alt="Logo" style="width: 120px; height: auto;">
                                <!--<span class="nav-link"> </span>-->
                            </a>
                        </div>
                        <!-- Main-menu -->
                        <div class="main-menu d-none d-md-block">
                            <nav>
                                <ul id="navigation">
                                    <li><a href="{{ url('/') }}">Home</a></li>
                                    <li><a href="{{ url('/blog') }}">Berita</a></li>
                                    <li>
                                        <a href="#">Tentang Galow</a>
                                        <ul class="submenu">
                                            <li><a href="{{ url('/about') }}">Profil</a></li>
                                            <li><a href="{{ url('/structur') }}">Struktur</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="{{ url('/organisasi') }}">Organisasi Kepemudaan</a></li>
                                    <li><a href="{{ url('/halo.galow.pengaduan') }}">Halo! GALOW Pengaduan</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- Mobile Menu -->
                    <div class="col-12">
                        <div class="mobile_menu d-block d-md-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Fungsi untuk memperbarui tanggal
    function updateDate() {
        const now = new Date();
        // Format tanggal, misalnya: "Tuesday, 18th June, 2019"
        // Anda bisa mengubah locale dan opsi format sesuai kebutuhan
        const options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        const dateString = now.toLocaleDateString('en-US', options);
        document.getElementById('current-date').innerText = dateString;
    }

    // Fungsi untuk memperbarui suhu
    function updateTemperature() {
        // Jika ingin menggunakan API untuk suhu, lakukan fetch ke API eksternal di sini.
        // Contoh: mengganti dengan suhu dan kondisi secara statis untuk simulasi.
        const temperature = "34ºc, Sunny";
        document.getElementById('current-temp').innerText = temperature;
    }

    // Panggil fungsi saat halaman pertama kali dimuat
    updateDate();
    updateTemperature();

    // Perbarui tanggal setiap menit (60000 milidetik)
    setInterval(updateDate, 60000);

    // Jika menggunakan API untuk suhu, Anda bisa mengatur interval update juga.
    // setInterval(updateTemperature, 60000);
</script>
