@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="hero-content text-center">
                        <h1 class="hero-title">Struktur Organisasi</h1>
                        <h2 class="hero-subtitle">Karang Taruna "Galow Tunas Bangsa"</h2>
                        <p class="hero-description">Desa Lowayu, Kecamatan Dukun, Kabupaten Gresik</p>
                        <div class="period-badge">
                            <span>Periode 2024-2027</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="about-area mt-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about-right mb-40">
                        <div class="about-prea">
                            <!-- Pembina Section -->
                            <div class="section-header">
                                <h3 class="section-title">Pembina & Majelis Pertimbangan</h3>
                                <div class="section-line"></div>
                            </div>

                            <div class="row row-cols-1 row-cols-md-3 g-4 mt-4">
                                @foreach ([
            [
                'title' => 'Pembina Umum',
                'icon' => 'fas fa-crown',
                'content' => '1. Kepala Desa Lowayu<br>2. Ketua BPD Lowayu',
                'color' => 'primary'
            ],
            [
                'title' => 'Pembina Fungsional',
                'icon' => 'fas fa-user-tie',
                'content' => 'Kasi Kesra Desa Lowayu',
                'color' => 'success'
            ],
            [
                'title' => 'Majelis Pertimbangan',
                'icon' => 'fas fa-users-cog',
                'content' => '<ol>
                                                                        <li>1. Moh. Adenan Qohar</li>
                                                                        <li>2. Siswanto</li>
                                                                        <li>3. Anang Fatihul Huda</li>
                                                                    </ol>',
                'color' => 'warning'
            ],
        ] as $item)
                                    <div class="col mt-20">
                                        <div class="org-card org-card-{{ $item['color'] }} bg-white p-4 rounded-lg shadow-lg mb-4">
                                            <div class="card-icon">
                                                <i class="{{ $item['icon'] }}"></i>
                                            </div>
                                            <h5 class="card-title">{{ $item['title'] }}</h5>
                                            <div class="card-content">{!! $item['content'] !!}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Kepengurusan -->
                            <div class="section-header mt-5">
                                <h3 class="section-title">Pengurus Inti</h3>
                                <div class="section-line"></div>
                            </div>

                            @php $counter = 1; @endphp
                            <div class="row mt-4">
                                @foreach ([
            [
                'title' => 'KETUA',
                'name' => 'Ahmad Ahkamul Arif',
                'sub' => ['Wakil Ketua 1: Nurul Islamiyah', 'Wakil Ketua 2: Zayyan Fayi Alif'],
                'icon' => 'fas fa-user-shield'
            ],
            [
                'title' => 'SEKRETARIS',
                'name' => 'Muhammad Suroto',
                'sub' => ['Wakil Sekretaris: Anisah Nurdini'],
                'icon' => 'fas fa-file-alt'
            ],
            [
                'title' => 'BENDAHARA',
                'name' => 'Iivi Nurdiyanah',
                'sub' => ['Wakil Bendahara: Mafazatud Diniyah'],
                'icon' => 'fas fa-coins'
            ],
        ] as $item)
                                    <div class="col-md-4 mb-4">
                                        <div class="leadership-card bg-white p-4 rounded-lg shadow-lg">
                                            <div class="leadership-icon">
                                                <i class="{{ $item['icon'] }}"></i>
                                            </div>
                                            <div class="leadership-number">{{ $counter }}</div>
                                            <h5 class="leadership-title">{{ $item['title'] }}</h5>
                                            <p class="leadership-name">{{ $item['name'] }}</p>
                                            @foreach ($item['sub'] as $sub)
                                                <p class="leadership-sub">{{ $sub }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                    @php $counter++; @endphp
                                @endforeach
                            </div>

                            <!-- Departemen -->
                            <div class="section-header mt-5">
                                <h3 class="section-title">{{ $counter }}. Departemen</h3>
                                <div class="section-line"></div>
                            </div>

                            <div class="org-structure bg-white p-4 rounded-lg shadow-lg mt-4">
                                <div class="row">
                                    @foreach ([
            [
                'title' => 'Departemen Sosial Kemasyarakatrakatan',
                'members' => ['M Fajar Afriqin (ROTOR)'],
                'icon' => 'fas fa-hands-helping'
            ],
            [
                'title' => 'Departemen Seni Budaya',
                'members' => ['Mohammad Andrianto (KERA SAKTI)', 'Yusuf Wijaya (BUANA PUTH)', 'Faizuddin (PAGAR NUSA)', 'Syahreza Gilang Abdillah (SETIA HATI TERATE)', 'Agus Sutono (ARYO KRIDO SANJOYO)'],
                'icon' => 'fas fa-palette'
            ],
            [
                'title' => 'Departemen Olahraga',
                'members' => ['Ujang Feby L (Lowayu FC)', 'Wahyu Sigit Wibisono (VBC)'],
                'icon' => 'fas fa-futbol'
            ],
            [
                'title' => 'Departemen Pendidikan',
                'members' => ['M. Riful Umam (GEMA)', 'Ah. Nafis faidlur Rohman (IPNU)', 'Tiara Nur Familia (IPPNU)'],
                'icon' => 'fas fa-graduation-cap'
            ],
            [
                'title' => 'Departemen Keagamaan',
                'members' => ['M. Ridlwan Purnomo (GP ANSOR)', 'Ahmad Wildan Mahiruddin (REMAJA MASJID)'],
                'icon' => 'fas fa-mosque'
            ],
        ] as $dept)
                                        <div class="col-md-6 mb-3">
                                            <div class="department-card p-3 rounded-lg">
                                                <div class="dept-header">
                                                    <i class="{{ $dept['icon'] }}"></i>
                                                    <h6 class="dept-title">{{ $dept['title'] }}</h6>
                                                </div>
                                                <ul class="dept-members">
                                                    @foreach ($dept['members'] as $member)
                                                        <li>{{ $loop->iteration }}. {{ $member }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Divisi -->
                            @php $counter++; @endphp
                            <div class="section-header mt-5">
                                <h3 class="section-title">{{ $counter }}. Divisi</h3>
                                <div class="section-line"></div>
                            </div>

                            <div class="org-structure bg-white p-4 rounded-lg shadow-lg mt-4">
                                <div class="row">
                                    @foreach ([
            [
                'title' => 'Divisi SDM & Pelatihan',
                'members' => ['Zainul Mukhtodzim (Koordinator)', 'Emi masruroh', '. Mas Latifah Dwi Suryaning Tyas', '. Siti Malicha', 'Nazilatul mahmudah', 'M. Miftahul Naim', 'Agustina Rohmawati', 'Miftahul Huda', 'Tegar Kusuma Febriansyah', 'Afrizal Zulkarnain', 'Melinda Suryani', '. Ahmad Rizal Anshori'],
                'icon' => 'fas fa-users'
            ],
            [
                'title' => 'Divisi Advokasi & Pemerintahan',
                'members' => ['Fahrur Rozi (Koordinator)', 'Mohammad Irfan Bachtiar', 'Moh. Zainal Abidin', 'Ah. Ferry Zainul Haq'],
                'icon' => 'fas fa-balance-scale'
            ],
            [
                'title' => 'Divisi Ekonomi Produktif',
                'members' => ['Muhammad Syuaib (Koordinator)', 'Mohammad Amin', 'Siti Nur Alifah', 'Nisrocha Khofifah', 'Dhabit Firas', 'Febi Ardiansyah', 'Putri Hafizah', 'Rifdianti Rahma', 'Elliyah Masruroh', 'Silvia Qotrun Nada'],
                'icon' => 'fas fa-chart-line'
            ],
            [
                'title' => 'Divisi Media Kreatif',
                'members' => ['Zahransyah Alfat (Koordinator)', 'M. Aditya Eko S', 'Muhamad Masrur', 'M david Ainur Rosyidin', 'Muhammad Nazi', 'Fitrotul Hanifiyah', 'Fransina Ananda', 'Rizky Bayu Rendy Mahendra'],
                'icon' => 'fas fa-video'
            ],
            [
                'title' => 'Divisi Rukun Tetangga (RT)',
                'members' => [
                    'Nizarul fanani (Koordinator)',
                    'M.llman RT 01',
                    'M Rozikin RT 02',
                    'Ahmad Mulhamul Khoiri RT 03',
                    'Ahmad Mudrikul Falaq RT 04',
                    'Moh. Yoga Fuad AIFakih RT 05',
                    'Ahmad Hafizul Azizi Ardianto RT 06',
                    'Ahmad David Firmansyah RT 07',
                    'Moh. Qoribmi Fatikhul Aziz RT 08',
                    'Hermanto RT 09',
                    'Midkholus Surur RT IO',
                    'MasFiu1RT 11',
                    'Ah. Rifqi Romadhon RT 12',
                    'Moh. Dhuha RT 13',
                    'Moh. Imaduddin RT 14',
                    'Aar Aqilul Fikri Al Jansyah RT 15',
                    'Alvin Chandra Octa Farisyah RT 16',
                    'Mashdar Fawaizzul Ilhami RT 17',
                    'Aris Mustofa RT 18',
                    'Arsiqum Subur Jati RT 19',
                    'Riski Andrian RT 20',
                    'Moh. Triyas Buchori Abdullah RT 21',
                    'Abdur Rohman Sholeh RT 22',
                    'Moh. Bahijul Bakhtaro RT 23',
                    'Ah. Yulinnto RT 24',
                    'Ahmad Akrom Anakib RT 25',
                    'Nasya Rikul Mufa Idzin RT 26',
                    'Ahmad Zogik Irwansyah RT 27',
                    'Dimas Alfarisi RT 28',
                    'Munif Rizki Efendi RT 29',
                    'Ali Yusuf RT 30',
                    'Farih Muhaimin Fathoni RT 31',
                    'Moh. Jamil Nasrudin RT 32',
                    'Andrik Gunawan RT 33',
                    'Achmad Wildan Nazlur Rizki RT 34',
                    'Ahmad Riaal Saputra RT 35',
                    'Muh. Khoiron May Anshori RT 36',
                ],
                'icon' => 'fas fa-home'
            ],
        ] as $div)
                                        <div class="col-md-6 mb-3">
                                            <div class="department-card p-3 rounded-lg">
                                                <div class="dept-header">
                                                    <i class="{{ $div['icon'] }}"></i>
                                                    <h6 class="dept-title">{{ $div['title'] }}</h6>
                                                </div>
                                                <ul class="dept-members">
                                                    @foreach ($div['members'] as $member)
                                                        <li>{{ $loop->iteration }}. {{ $member }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 50%, #dee2e6 100%);
            padding: 80px 0;
            color: #333;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="%2397240f" opacity="0.05"/><circle cx="75" cy="75" r="1" fill="%2397240f" opacity="0.05"/><circle cx="50" cy="10" r="0.5" fill="%2397240f" opacity="0.05"/><circle cx="10" cy="60" r="0.5" fill="%2397240f" opacity="0.05"/><circle cx="90" cy="40" r="0.5" fill="%2397240f" opacity="0.05"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: #97240f;
            text-shadow: none;
        }

        .hero-subtitle {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: #555;
        }

        .hero-description {
            font-size: 1.1rem;
            margin-bottom: 20px;
            color: #666;
        }

        .period-badge {
            display: inline-block;
            background: linear-gradient(135deg, #97240f, #e74c3c);
            padding: 12px 30px;
            border-radius: 30px;
            border: none;
            box-shadow: 0 4px 15px rgba(151, 36, 15, 0.3);
            color: white;
        }

        .period-badge span {
            font-weight: 600;
            font-size: 1.1rem;
        }

        /* Section Headers */
        .section-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #97240f;
            margin-bottom: 15px;
            position: relative;
        }

        .section-line {
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #97240f, #e74c3c);
            margin: 0 auto;
            border-radius: 2px;
        }

        /* Organization Cards */
        .org-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            height: 100%;
            position: relative;
            overflow: hidden;
            border: none;
            border-radius: 15px;
            background: linear-gradient(145deg, #ffffff, #f8f9fa);
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }

        .org-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--card-color), var(--card-color-light));
            border-radius: 15px 15px 0 0;
        }

        .org-card-primary::before { --card-color: #97240f; --card-color-light: #e74c3c; }
        .org-card-success::before { --card-color: #27ae60; --card-color-light: #2ecc71; }
        .org-card-warning::before { --card-color: #f39c12; --card-color-light: #f1c40f; }

        .org-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0,0,0,0.12);
        }

        .card-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #97240f, #e74c3c);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            color: white;
            font-size: 28px;
            transition: all 0.3s ease;
        }

        .org-card:hover .card-icon {
            transform: scale(1.1);
        }

        .card-title {
            font-weight: 700;
            color: #97240f;
            margin-bottom: 15px;
            font-size: 1.3rem;
            transition: color 0.3s ease;
        }

        .org-card:hover .card-title {
            color: #e74c3c;
        }

        .card-content {
            color: #555;
            line-height: 1.6;
        }

        /* Leadership Cards */
        .leadership-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            height: 100%;
            position: relative;
            overflow: visible;
            border: none;
            background: linear-gradient(145deg, #ffffff, #f8f9fa);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            padding: 15px;
        }

        .leadership-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px rgba(151, 36, 15, 0.15);
        }

        .leadership-icon {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, #97240f, #e74c3c);
            border-radius: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 36px;
            position: relative;
            transition: all 0.3s ease;
        }

        .leadership-card:hover .leadership-icon {
            transform: scale(1.1);
            border-radius: 30px;
        }

        .leadership-number {
            position: absolute;
            top: -8px;
            right: -8px;
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #97240f, #e74c3c);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 18px;
            box-shadow: 0 4px 10px rgba(151, 36, 15, 0.3);
            z-index: 10;
            border: 3px solid white;
        }

        .leadership-title {
            font-weight: 700;
            color: #97240f;
            text-align: center;
            margin-bottom: 12px;
            font-size: 1.4rem;
            transition: color 0.3s ease;
        }

        .leadership-card:hover .leadership-title {
            color: #e74c3c;
        }

        .leadership-name {
            font-weight: 600;
            color: #333;
            text-align: center;
            margin-bottom: 15px;
            font-size: 1.1rem;
            padding: 8px 15px;
            background: linear-gradient(135deg, rgba(151, 36, 15, 0.1), rgba(231, 76, 60, 0.1));
            border-radius: 10px;
            display: inline-block;
            width: 100%;
        }

        .leadership-sub {
            color: #666;
            text-align: center;
            margin-bottom: 8px;
            font-size: 0.95rem;
            padding: 5px 10px;
            background: rgba(151, 36, 15, 0.05);
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .leadership-card:hover .leadership-sub {
            background: rgba(151, 36, 15, 0.1);
            color: #555;
        }

        /* Department Cards */
        .department-card {
            background: linear-gradient(145deg, #f8f9fa, #ffffff);
            border-left: 5px solid #97240f;
            height: 100%;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            position: relative;
            overflow: hidden;
        }

        .department-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(151, 36, 15, 0.02), rgba(231, 76, 60, 0.02));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .department-card:hover {
            transform: translateY(-6px) scale(1.01);
            box-shadow: 0 15px 35px rgba(151, 36, 15, 0.12);
            background: linear-gradient(145deg, #ffffff, #f8f9fa);
        }

        .department-card:hover::before {
            opacity: 1;
        }

        .dept-header {
            display: flex;
            align-items: center;
            margin-bottom: 18px;
            position: relative;
            z-index: 2;
        }

        .dept-header i {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #97240f, #e74c3c);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            margin-right: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(151, 36, 15, 0.2);
        }

        .department-card:hover .dept-header i {
            transform: scale(1.1);
            border-radius: 20px;
        }

        .dept-title {
            font-weight: 700;
            color: #97240f;
            margin: 0;
            font-size: 1.1rem;
            transition: color 0.3s ease;
        }

        .department-card:hover .dept-title {
            color: #e74c3c;
        }

        .dept-members {
            list-style: none;
            padding: 0;
            margin: 0;
            position: relative;
            z-index: 2;
        }

        .dept-members li {
            padding: 8px 12px;
            color: #555;
            border-bottom: 1px solid rgba(151, 36, 15, 0.1);
            font-size: 0.95rem;
            transition: all 0.3s ease;
            border-radius: 8px;
            margin-bottom: 2px;
        }

        .dept-members li:hover {
            background: rgba(151, 36, 15, 0.05);
            color: #333;
            transform: translateX(5px);
        }

        .dept-members li:last-child {
            border-bottom: none;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }

            .hero-subtitle {
                font-size: 1.2rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .leadership-icon {
                width: 60px;
                height: 60px;
                font-size: 24px;
            }
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .org-card, .leadership-card, .department-card {
            animation: fadeInUp 0.6s ease forwards;
        }

        .org-card:nth-child(1) { animation-delay: 0.1s; }
        .org-card:nth-child(2) { animation-delay: 0.2s; }
        .org-card:nth-child(3) { animation-delay: 0.3s; }
        .leadership-card:nth-child(1) { animation-delay: 0.4s; }
        .leadership-card:nth-child(2) { animation-delay: 0.5s; }
        .leadership-card:nth-child(3) { animation-delay: 0.6s; }
    </style>
@endsection
