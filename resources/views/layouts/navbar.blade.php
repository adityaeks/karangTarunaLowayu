<!-- ====== NAVBAR GALOW (SIMPLE & CLEAN) ====== -->

<style>
    /* Navbar Container */
    .header-area {
        position: relative;
    }

    /* Header Top (bar hitam) */
    .header-top {
        background: #0b0b0b;
        color: #fff;
    }

    .header-top ul {
        list-style: none;
        margin: 0;
        padding: 10px 0;
    }

    .header-top a {
        color: #fff;
    }

    /* Saat navbar fixed, header-top disembunyikan di desktop */
    @media (min-width: 768px) {
        body.nav-fixed .header-top {
            display: none !important;
        }
    }

    /* Header-bottom = navbar */
    .header-bottom {
        position: relative;
        background: #fff;
        z-index: 10;
    }

    /* Saat fixed */
    .header-bottom.is-fixed {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 10000;
        box-shadow: 0 2px 12px rgba(0, 0, 0, .08);
        background: #fff;
    }

    /* Spacer untuk mencegah lompat */
    .nav-spacer {
        height: 0;
    }

    body.nav-fixed .nav-spacer {
        height: 70px;
    }

    /* Flex layout */
    .header-flex {
        display: flex;
        justify-content: space-between;
        align-items: center;
        min-height: 70px;
    }

    /* Logo */
    .sticky-logo a {
        display: flex;
        align-items: center;
        height: 50px;
        text-decoration: none;
    }

    .sticky-logo img {
        width: 120px;
        height: auto;
        display: block !important;
    }

    /* Override CSS yang menyembunyikan logo */
    .sticky-logo {
        display: block !important;
    }

    /* Menu Desktop */
    .main-menu {
        margin-left: auto;
    }

    .main-menu ul {
        display: flex;
        align-items: center;
        gap: 0;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .main-menu ul>li>a {
        display: block;
        padding: 20px 15px;
        font-weight: 700;
        font-size: 16px;
        color: #0d1b2a;
        text-decoration: none;
    }

    .main-menu ul>li>a:hover {
        color: #e74c3c;
    }

    /* Submenu */
    .main-menu ul li {
        position: relative;
    }

    .main-menu ul li .submenu {
        position: absolute;
        left: 0;
        top: 100%;
        min-width: 200px;
        background: #fff;
        border: 1px solid #eee;
        box-shadow: 0 8px 20px rgba(0, 0, 0, .06);
        display: none;
        padding: 8px 0;
        z-index: 10001;
    }

    .main-menu ul li:hover>.submenu {
        display: block;
    }

    .main-menu ul li .submenu li a {
        padding: 10px 14px;
        display: block;
        color: #0d1b2a;
        font-weight: 600;
    }

    .main-menu ul li .submenu li a:hover {
        background: #f7f7f7;
        color: #e74c3c;
    }

    /* Mobile */
    @media (max-width: 767.98px) {
        .main-menu.d-none.d-md-block {
            display: none !important;
        }

        .mobile_menu {
            display: block;
        }
    }
</style>

<div class="header-area">
    <div class="main-header">
        <!-- NAVBAR -->
        <div class="header-bottom" id="navbar">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-10 col-lg-10 col-md-12 header-flex">
                        <!-- Logo -->
                        <div class="sticky-logo">
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('assets/img/logo/logo-utama-header.png') }}" alt="Logo GALOW">
                            </a>
                        </div>
                        <!-- Menu Desktop -->
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
                                    <li><a href="{{ url('/halo.galow.pengaduan') }}">Halo! GALOW Pengaduan</a></li>
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

        <!-- Spacer -->
        <div class="nav-spacer" id="navSpacer"></div>

    </div>
</div>

<script>
    // Tanggal & Suhu
    function updateDate() {
        const now = new Date();
        const options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        const el = document.getElementById('current-date');
        if (el) el.textContent = now.toLocaleDateString('en-US', options);
    }

    function updateTemperature() {
        const el = document.getElementById('current-temp');
        if (el) el.textContent = "34ºc, Sunny";
    }

    updateDate();
    updateTemperature();
    setInterval(updateDate, 60000);

    // Simple scroll handler
    (function() {
        const nav = document.getElementById('navbar');
        const spacer = document.getElementById('navSpacer');
        if (!nav || !spacer) return;

        let isFixed = false;

        function handleScroll() {
            const scrollTop = window.pageYOffset;
            const shouldBeFixed = scrollTop > 10;

            if (shouldBeFixed !== isFixed) {
                isFixed = shouldBeFixed;

                if (isFixed) {
                    nav.classList.add('is-fixed');
                    document.body.classList.add('nav-fixed');
                } else {
                    nav.classList.remove('is-fixed');
                    document.body.classList.remove('nav-fixed');
                }
            }
        }

        window.addEventListener('scroll', handleScroll, {
            passive: true
        });
        handleScroll(); // Initial check
    })();
</script>
