@extends('layouts.app')

@section('meta')
    <title>Pengaduan | Galow Tunas Bangsa</title>
    <meta name="description" content="Form pengaduan online Karang Taruna Lowayu (Galow Tunas Bangsa) Desa Lowayu. Sampaikan keluhan, saran, atau laporan Anda di sini.">
    <meta property="og:title" content="Pengaduan | Galow Tunas Bangsa" />
    <meta property="og:description" content="Form pengaduan online Karang Taruna Lowayu (Galow Tunas Bangsa) Desa Lowayu. Sampaikan keluhan, saran, atau laporan Anda di sini." />
    <meta property="og:image" content="{{ asset('assets/img/logo/logo-utama.jpg') }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
@endsection

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h2 class="contact-title">Halo! GALOW Pengaduan</h2>
            </div>
            <div class="col-lg-8">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <!-- Tambahkan error messages -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="form-contact contact_form" action="{{ route('pengaduan.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input class="form-control valid" name="name" id="name" type="text"
                                    value="{{ old('name') }}" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Enter your name'" placeholder="Enter your name">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="numver">Nomor</label>
                                <input class="form-control valid" name="number" id="number" type="number"
                                    value="{{ old('number') }}" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Enter number address'" placeholder="Number">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="bukti_pengaduan">Bukti Pengaduan</label>
                                <input class="form-control" name="bukti_pengaduan" id="bukti_pengaduan" type="file"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Upload File'"
                                    placeholder="Upload File">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="content">Pesan Pengaduan</label>
                                <textarea class="form-control w-100" name="content" id="content" cols="30" rows="9"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Message'" placeholder="Enter Message"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="button button-contactForm boxed-btn">Send</button>
                    </div>
                </form>
            </div>
            <!--<div class="col-lg-3 offset-lg-1">-->
            <!--    <div class="media contact-info">-->
            <!--        <span class="contact-info__icon"><i class="ti-home"></i></span>-->
            <!--        <div class="media-body">-->
            <!--            <h3>Desa Lowayu</h3>-->
            <!--            <p>------</p>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--    <div class="media contact-info">-->
            <!--        <span class="contact-info__icon"><i class="ti-tablet"></i></span>-->
            <!--        <div class="media-body">-->
            <!--            <h3>+62 856-4608-3862</h3>-->
            <!--            <p>-------</p>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--    {{-- <div class="media contact-info">-->
            <!--        <span class="contact-info__icon"><i class="ti-email"></i></span>-->
            <!--        <div class="media-body">-->
            <!--            <h3>support@colorlib.com</h3>-->
            <!--            <p>Send us your query anytime!</p>-->
            <!--        </div>-->
            <!--    </div> --}}-->
            <!--</div>-->
        </div>
    </div>
@endsection
