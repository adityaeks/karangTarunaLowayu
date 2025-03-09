@extends('layouts.app')

@section('content')
    <div class="about-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about-right mb-90">
                        <div class="section-tittle mb-30 pt-30">
                            <h3>Organisasi Kepemudaan</h3>
                        </div>
                        <div class="about-prea">
                            <p class="about-pera1 mb-25" style="text-align: justify;">Halaman ini menampilkan berbagai
                                organisasi kepemudaan yang aktif di
                                desa, yang berperan dalam pengembangan potensi generasi muda serta kegiatan sosial dan
                                kemasyarakatan. Melalui wadah ini, pemuda desa dapat berkolaborasi, berkreasi, dan
                                berkontribusi dalam membangun lingkungan yang lebih maju dan harmonis. Temukan informasi
                                lengkap tentang setiap organisasi, program kerja, dan cara bergabung untuk menjadi bagian
                                dari perubahan positif di desa kita!</p>
                            <br>
                        </div>
                        <div class="row">
                            @foreach ($organisasis as $organisasi)
                                <div class="col-md-4 mb-4">
                                    <div class="card">
                                        <img src="{{ asset('storage/' . $organisasi->photo) }}" class="card-img-top"
                                            alt="{{ $organisasi->name }}"
                                            style="width: 210px; height: 210px; object-fit: cover;">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $organisasi->name }}</h5>
                                            <p class="card-text">{{ $organisasi->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
