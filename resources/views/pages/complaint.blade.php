@extends('layouts.app')

@section('content')
    {{-- <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Form Pengaduan</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('pengaduan.store') }}" enctype="multipart/form-data">
                    @csrf
                    <!-- Nama -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <!-- Nomor -->
                    <div class="mb-3">
                        <label for="number" class="form-label">Nomor Telepon/HP</label>
                        <input type="number" class="form-control" id="number" name="number" required>
                    </div>

                    <!-- Konten Pengaduan -->
                    <div class="mb-3">
                        <label for="content" class="form-label">Isi Pengaduan</label>
                        <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
                    </div>

                    <!-- Upload Bukti -->
                    <div class="mb-3">
                        <label for="bukti_pengaduan" class="form-label">Upload Bukti Pengaduan</label>
                        <input type="file" class="form-control" id="bukti_pengaduan" name="bukti_pengaduan"
                            accept="image/*,.pdf,.doc,.docx">
                        <div class="form-text">Format file: gambar, PDF, atau DOC (maks. 5MB)</div>
                    </div>

                    <button type="submit" class="btn btn-primary">Kirim Pengaduan</button>
                </form>
            </div>
        </div>
    </div> --}}
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h2 class="contact-title">Pengaduan</h2>
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
            <div class="col-lg-3 offset-lg-1">
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-home"></i></span>
                    <div class="media-body">
                        <h3>Buttonwood, California.</h3>
                        <p>Rosemead, CA 91770</p>
                    </div>
                </div>
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                    <div class="media-body">
                        <h3>+1 253 565 2365</h3>
                        <p>Mon to Fri 9am to 6pm</p>
                    </div>
                </div>
                {{-- <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-email"></i></span>
                    <div class="media-body">
                        <h3>support@colorlib.com</h3>
                        <p>Send us your query anytime!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
