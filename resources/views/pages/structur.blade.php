@extends('layouts.app')

@section('content')
    <div class="about-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about-right mb-90">
                        <div class="section-tittle mb-30 pt-30 text-center">
                            <h5 style="font-size: 18px;">SUSUNAN PENGURUS <br> KARANG TARUNA "GALOW TUNAS BANGSA" <br> DESA
                                LOWAYU KECAMATAN DUKUN KABUPATEN GRESIK <br> PERIODE 2024-2027 </h5>
                        </div>

                        <div class="about-prea">
                            <!-- Pembina Section -->
                            <div class="row row-cols-1 row-cols-md-3 g-4 mt-4">
                                @foreach ([
            [
                'title' => 'Pembina Umum',
                'content' => '1. Kepala Desa Lowayu<br>2. Ketua BPD Lowayu',
            ],
            [
                'title' => 'Pembina Fungsional',
                'content' => 'Kasi Kesra Desa Lowayu',
            ],
            [
                'title' => 'Majelis Pertimbangan',
                'content' => '<ol>
                                                                        <li>1. Moh. Adenan Qohar</li>
                                                                        <li>2. Siswanto</li>
                                                                        <li>3. Anang Fatihul Huda</li>
                                                                    </ol>',
            ],
        ] as $item)
                                    <div class="col">
                                        <div class="org-structure bg-white p-4 rounded shadow-sm mb-4">
                                            <h5 class="fw-bold text-primary">{{ $item['title'] }}</h5>
                                            <div class="mt-3">{!! $item['content'] !!}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Kepengurusan -->
                            @php $counter = 1; @endphp
                            <div class="row mt-4">
                                @foreach ([
            [
                'title' => 'KETUA',
                'name' => 'Ahmad Ahkamul Arif',
                'sub' => ['Wakil Ketua 1: Nurul Islamiyah', 'Wakil Ketua 2: Zayyan Fayi Alif'],
            ],
            [
                'title' => 'SEKRETARIS',
                'name' => 'Muhammad Suroto',
                'sub' => ['Wakil Sekretaris: Anisah Nurdini'],
            ],
            [
                'title' => 'BENDAHARA',
                'name' => 'Iivi Nurdiyanah',
                'sub' => ['Wakil Bendahara: Mafazatud Diniyah'],
            ],
        ] as $item)
                                    <div class="col-md-4 mb-4">
                                        <div class="org-structure bg-white p-4 rounded shadow-sm">
                                            <h5 class="fw-bold text-primary">{{ $counter }}. {{ $item['title'] }}</h5>
                                            <p class="fw-bold mt-3">{{ $item['name'] }}</p>
                                            @foreach ($item['sub'] as $sub)
                                                <p class="mb-1">{{ $sub }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                    @php $counter++; @endphp
                                @endforeach
                            </div>

                            <!-- Departemen -->
                            <div class="org-structure bg-white p-4 rounded shadow-sm mt-4">
                                <h4 class="fw-bold text-primary mb-4">{{ $counter }}. DEPARTEMEN</h4>
                                <div class="row">
                                    @foreach ([
            [
                'title' => 'Departemen Sosial Kemasyarakatrakatan',
                'members' => ['M Fajar Afriqin (ROTOR)'],
            ],
            [
                'title' => 'Departemen Seni Budaya',
                'members' => ['Mohammad Andrianto (KERA SAKTI)', 'Yusuf Wijaya (BUANA PUTH)', 'Faizuddin (PAGAR NUSA)', 'Syahreza Gilang Abdillah (SETIA HATI TERATE)', 'Agus Sutono (ARYO KRIDO SANJOYO)'],
            ],
            [
                'title' => 'Departemen Olahraga',
                'members' => ['Ujang Feby L (Lowayu FC)', 'Wahyu Sigit Wibisono (VBC)'],
            ],
            [
                'title' => 'Departemen Pendidikan',
                'members' => ['M. Riful Umam (GEMA)', 'Ah. Nafis faidlur Rohman (IPNU)', 'Tiara Nur Familia (IPPNU)'],
            ],
            [
                'title' => 'Departemen Keagamaan',
                'members' => ['M. Ridlwan Purnomo (GP ANSOR)', 'Ahmad Wildan Mahiruddin (REMAJA MASJID)'],
            ],
        ] as $dept)
                                        <div class="col-md-6 mb-3">
                                            <div class="department-card p-3 rounded">
                                                <h6 class="fw-bold">{{ $dept['title'] }}</h6>
                                                <ul class="list-unstyled mt-2">
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
                            <div class="org-structure bg-white p-4 rounded shadow-sm mt-4">
                                <h4 class="fw-bold text-primary mb-4">{{ $counter }}. DIVISI</h4>
                                <div class="row">
                                    @foreach ([
            [
                'title' => 'Divisi SDM & Pelatihan',
                'members' => ['Zainul Mukhtodzim (Koordinator)', 'Emi masruroh', '. Mas Latifah Dwi Suryaning Tyas', '. Siti Malicha', 'Nazilatul mahmudah', 'M. Miftahul Naim', 'Agustina Rohmawati', 'Miftahul Huda', 'Tegar Kusuma Febriansyah', 'Afrizal Zulkarnain', 'Melinda Suryani', '. Ahmad Rizal Anshori'],
            ],
            [
                'title' => 'Divisi Advokasi & Pemerintahan',
                'members' => ['Fahrur Rozi (Koordinator)', 'Mohammad Irfan Bachtiar', 'Moh. Zainal Abidin', 'Ah. Ferry Zainul Haq'],
            ],
            [
                'title' => 'Divisi Ekonomi Produktif',
                'members' => ['Muhammad Syuaib (Koordinator)', 'Mohammad Amin', 'Siti Nur Alifah', 'Nisrocha Khofifah', 'Dhabit Firas', 'Febi Ardiansyah', 'Putri Hafizah', 'Rifdianti Rahma', 'Elliyah Masruroh', 'Silvia Qotrun Nada'],
            ],
            [
                'title' => 'Divisi Media Kreatif',
                'members' => ['Zahransyah Alfat (Koordinator)', 'M. Aditya Eko S', 'Muhamad Masrur', 'M david Ainur Rosyidin', 'Muhammad Nazi', 'Fitrotul Hanifiyah', 'Fransina Ananda', 'Rizky Bayu Rendy Mahendra'],
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
            ],
        ] as $div)
                                        <div class="col-md-6 mb-3">
                                            <div class="department-card p-3 rounded">
                                                <h6 class="fw-bold">{{ $div['title'] }}</h6>
                                                <ul class="list-unstyled mt-2">
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
        .org-structure {
            transition: transform 0.3s ease;
            height: 100%;
        }

        .org-structure:hover {
            transform: translateY(-5px);
        }

        .department-card {
            background-color: #f8f9fa;
            border-left: 4px solid #97240f;
            height: 100%;
        }

        .section-tittle h3 {
            letter-spacing: 1px;
            line-height: 1.6;
        }

        .text-primary {
            color: #97240f !important;
        }

        /* Menyamakan tinggi row */
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .col-md-4,
        .col-md-6 {
            display: flex;
            flex-direction: column;
        }

        .col {
            display: flex;
            flex-direction: column;
        }
    </style>
@endsection
