@extends('layouts.app')
@section('content')
<style>
    .error-page {
        text-align: center;
        padding: 100px 0;
        background: #f8f9fa;
    }
    .error-page h1 {
        font-size: 120px;
        font-weight: 700;
        color: #e74c3c;
        margin: 0;
        line-height: 1;
    }
    .error-page h2 {
        font-size: 30px;
        color: #2c3e50;
        margin: 20px 0;
    }
    .error-page p {
        color: #7f8c8d;
        margin-bottom: 30px;
        font-size: 18px;
    }
    .back-home {
        display: inline-block;
        padding: 15px 30px;
        background: #e74c3c;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: all 0.3s ease;
    }
    .back-home:hover {
        background: #5e1a12;
        color: white;
        transform: translateY(-2px);
    }
</style>

<div class="error-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>404</h1>
                <h2>Halaman Tidak Ditemukan</h2>
                <p>Maaf, halaman yang Anda cari tidak dapat ditemukan atau telah dipindahkan.</p>
                <a href="{{ url('/') }}" class="back-home">Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</div>
@endsection
