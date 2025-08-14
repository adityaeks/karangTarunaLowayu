@extends('layouts.app')

@section('meta')
    <title>Pengaduan | Galow Tunas Bangsa</title>
    <meta name="description"
        content="Form pengaduan online Karang Taruna Lowayu (Galow Tunas Bangsa) Desa Lowayu. Sampaikan keluhan, saran, atau laporan Anda di sini.">
    <meta property="og:title" content="Pengaduan | Galow Tunas Bangsa" />
    <meta property="og:description"
        content="Form pengaduan online Karang Taruna Lowayu (Galow Tunas Bangsa) Desa Lowayu. Sampaikan keluhan, saran, atau laporan Anda di sini." />
    <meta property="og:image" content="{{ asset('assets/img/logo/logo-utama.jpg') }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
@endsection

@section('content')
    <!-- Contact Section -->
    <div class="contact-section section-padding">
        <div class="container">
            <div class="row">
                <!-- Form Pengaduan -->
                <div class="col-lg-8">
                    <div class="contact-form-wrapper">
                        <div class="section-title">
                            <h3>Form Pengaduan</h3>
                            <p>Silakan isi form di bawah ini untuk menyampaikan pengaduan Anda</p>
                        </div>

                        @if (session('success'))
                            <div class="notification-success">
                                <i class="fas fa-check-circle"></i>
                                <span>{{ session('success') }}</span>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="notification-error">
                                <i class="fas fa-exclamation-triangle"></i>
                                <div>
                                    <strong>Terjadi kesalahan:</strong>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <form class="contact-form" action="{{ route('pengaduan.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label for="name" class="form-label">Nama Lengkap <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control @error('name') is-invalid @enderror" name="name"
                                            id="name" type="text" value="{{ old('name') }}"
                                            placeholder="Masukkan nama Anda" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label for="number" class="form-label">Nomor Telepon <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control @error('number') is-invalid @enderror" name="number"
                                            id="number" type="tel" value="{{ old('number') }}"
                                            placeholder="Contoh: 081234567890" required>
                                        @error('number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-4">
                                        <label for="bukti_pengaduan" class="form-label">
                                            Bukti Pengaduan
                                            <small class="text-muted fw-normal">* Jika ada</small>
                                        </label>
                                        <div class="file-input-wrapper">
                                            <input class="form-control @error('bukti_pengaduan') is-invalid @enderror"
                                                name="bukti_pengaduan" id="bukti_pengaduan" type="file"
                                                accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                                            <div class="file-input-info">
                                                <i class="fas fa-upload me-2"></i>
                                                <span class="file-text">Pilih file atau drag & drop di sini</span>
                                            </div>
                                        </div>
                                        {{-- <small class="form-text text-muted mt-2">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Format yang didukung: JPG, JPEG, PNG, PDF, DOC, DOCX (Maksimal 5MB)
                                        </small> --}}
                                        @error('bukti_pengaduan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-4">
                                        <label for="content" class="form-label">Isi Pengaduan <span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" rows="6"
                                            placeholder="Jelaskan detail pengaduan Anda di sini..." required>{{ old('content') }}</textarea>
                                        @error('content')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-paper-plane me-2"></i>
                                        Kirim Pengaduan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Sidebar - Berita Terbaru -->
                <div class="col-lg-4">
                    <!-- Contact Info Widget -->
                    <div class="sidebar-widget">
                        <div class="widget-title">
                            <h4>Informasi Kontak</h4>
                        </div>
                        <div class="contact-info-list">
                            <div class="contact-info-item">
                                <div class="contact-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="contact-details">
                                    <h6>Alamat</h6>
                                    <p>Desa Lowayu, Dukun, Gresik</p>
                                </div>
                            </div>
                            <div class="contact-info-item">
                                <div class="contact-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="contact-details">
                                    <h6>Telepon</h6>
                                    <p>+62 856-4608-3862</p>
                                </div>
                            </div>
                            <div class="contact-info-item">
                                <div class="contact-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="contact-details">
                                    <h6>Email</h6>
                                    <p>galowtunasbangsa@gmail.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="sidebar-widget">
                        <div class="widget-title">
                            <h4>Berita Terbaru</h4>
                        </div>

                        @if (isset($latestNews) && $latestNews->count() > 0)
                            <!-- Debug: {{ $latestNews->count() }} berita ditemukan -->
                            <div class="latest-news-list">
                                @foreach ($latestNews as $news)
                                    <div class="news-item">
                                        <div class="news-thumb">
                                            @if ($news->photo)
                                                <img src="{{ asset('uploads/' . $news->photo) }}"
                                                    alt="{{ $news->name }}" class="img-fluid">
                                            @else
                                                <img src="{{ asset('assets/img/logo/logo-utama.jpg') }}"
                                                    alt="Default Image" class="img-fluid">
                                            @endif
                                        </div>
                                        <div class="news-content">
                                            <h6 class="news-title">
                                                <a href="{{ route('blog.detail', $news->slug) }}">
                                                    {{ Str::limit($news->name, 50) }}
                                                </a>
                                            </h6>
                                            <div class="news-meta">
                                                <span class="news-date">
                                                    <i class="far fa-calendar-alt me-1"></i>
                                                    {{ $news->created_at->format('d/m/Y') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="text-center mt-4">
                                <a href="{{ route('blog') }}" class="text-decoration-none">
                                    <small class="text-muted">Lihat Semua Berita →</small>
                                </a>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="far fa-newspaper fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Belum ada berita tersedia</p>
                                @if (isset($latestNews))
                                    <small class="text-muted">Debug: {{ $latestNews->count() }} berita</small>
                                @else
                                    <small class="text-muted">Debug: latestNews tidak terdefinisi</small>
                                @endif
                            </div>
                        @endif

                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <style>
        .contact-section {
            padding: 40px 0;
            background-color: #f8f9fa;
        }

        .contact-form-wrapper {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .section-title h3 {
            color: #333;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .section-title p {
            color: #666;
            margin-bottom: 30px;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #ba2d11;
            box-shadow: 0 0 0 0.2rem rgba(186, 45, 17, 0.25);
        }

        .btn-primary {
            background: #ba2d11;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #a0260f;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(186, 45, 17, 0.4);
        }

        .btn-outline-danger {
            color: #ba2d11;
            border-color: #ba2d11;
            background: transparent;
        }

        .btn-outline-danger:hover {
            background: #ba2d11;
            border-color: #ba2d11;
            color: white;
        }

        /* Custom File Input Styling */
        .form-control[type="file"] {
            padding: 10px 15px;
            line-height: 1.5;
            background-color: #fff;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .form-control[type="file"]:focus {
            border-color: #ba2d11;
            box-shadow: 0 0 0 0.2rem rgba(186, 45, 17, 0.25);
        }

        .form-control[type="file"]::-webkit-file-upload-button {
            background: #ba2d11;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            margin-right: 10px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .form-control[type="file"]::-webkit-file-upload-button:hover {
            background: #a0260f;
        }

        .form-control[type="file"]::file-selector-button {
            background: #ba2d11;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            margin-right: 10px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .form-control[type="file"]::file-selector-button:hover {
            background: #a0260f;
        }

        /* Fallback untuk browser yang tidak mendukung pseudo-elements */
        .form-control[type="file"] {
            position: relative;
            overflow: hidden;
        }

        .form-control[type="file"]:before {
            content: 'Pilih File';
            position: absolute;
            left: 0;
            top: 0;
            background: #ba2d11;
            color: white;
            padding: 8px 16px;
            border-radius: 6px 0 0 6px;
            font-weight: 500;
            cursor: pointer;
            z-index: 1;
        }

        .form-control[type="file"]:hover:before {
            background: #a0260f;
        }

        /* Memastikan text file name tidak tertutup */
        .form-control[type="file"]::-webkit-file-upload-button {
            position: relative;
            z-index: 2;
        }

        .form-control[type="file"]::file-selector-button {
            position: relative;
            z-index: 2;
        }

        /* File Input Wrapper Styling */
        .file-input-wrapper {
            position: relative;
            border: 2px dashed #e9ecef;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            background-color: #f8f9fa;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .file-input-wrapper:hover {
            border-color: #ba2d11;
            background-color: #fff5f5;
        }

        .file-input-wrapper .form-control[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            border: none;
            background: transparent;
        }

        .file-input-wrapper .form-control[type="file"]:focus {
            border: none;
            box-shadow: none;
        }

        .file-input-info {
            color: #666;
            font-size: 14px;
        }

        .file-input-info i {
            color: #ba2d11;
            font-size: 18px;
        }

        .file-input-wrapper.has-file {
            border-color: #ba2d11;
            background-color: #fff5f5;
        }

        .file-input-wrapper.has-file .file-text {
            color: #ba2d11;
            font-weight: 500;
        }

        .sidebar-widget {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .widget-title h4 {
            color: #333;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #ba2d11;
        }

        .news-item {
            display: flex;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .news-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .news-thumb {
            flex: 0 0 80px;
            margin-right: 15px;
        }

        .news-thumb img {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }

        .news-content {
            flex: 1;
        }

        .news-title {
            margin-bottom: 8px;
        }

        .news-title a {
            color: #333;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            line-height: 1.4;
            transition: color 0.3s ease;
        }

        .news-title a:hover {
            color: #ba2d11;
        }

        .news-meta {
            font-size: 12px;
            color: #666;
        }

        .news-meta span {
            display: block;
            margin-bottom: 2px;
        }

        .contact-info-list {
            margin-top: 20px;
        }

        .contact-info-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .contact-icon {
            flex: 0 0 40px;
            height: 40px;
            background: #ba2d11;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-right: 15px;
        }

        .contact-details h6 {
            margin: 0;
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        .contact-details p {
            margin: 0;
            color: #666;
            font-size: 13px;
        }

                .notification-success {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 0;
            color: #155724;
            font-size: 14px;
            border-bottom: 2px solid #d4edda;
            margin-bottom: 20px;
        }

        .notification-success i {
            color: #28a745;
            font-size: 16px;
        }

        .notification-error {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 12px 0;
            color: #721c24;
            font-size: 14px;
            border-bottom: 2px solid #f8d7da;
            margin-bottom: 20px;
        }

        .notification-error i {
            color: #dc3545;
            font-size: 16px;
            margin-top: 2px;
        }

        .notification-error ul {
            margin: 5px 0 0 0;
            padding-left: 20px;
        }

        .notification-error li {
            margin-bottom: 2px;
        }

        @media (max-width: 768px) {
            .contact-form-wrapper {
                padding: 25px;
            }

            .sidebar-widget {
                margin-top: 30px;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('bukti_pengaduan');
            const fileWrapper = document.querySelector('.file-input-wrapper');
            const fileText = document.querySelector('.file-text');

            if (fileInput && fileWrapper && fileText) {
                fileInput.addEventListener('change', function() {
                    if (this.files.length > 0) {
                        const fileName = this.files[0].name;
                        const fileSize = (this.files[0].size / 1024 / 1024).toFixed(2); // Convert to MB

                        fileWrapper.classList.add('has-file');
                        fileText.innerHTML =
                            `<i class="fas fa-check-circle me-2"></i>${fileName} (${fileSize} MB)`;
                    } else {
                        fileWrapper.classList.remove('has-file');
                        fileText.innerHTML =
                            '<i class="fas fa-upload me-2"></i>Pilih file atau drag & drop di sini';
                    }
                });

                // Drag and drop functionality
                fileWrapper.addEventListener('dragover', function(e) {
                    e.preventDefault();
                    this.style.borderColor = '#ba2d11';
                    this.style.backgroundColor = '#fff5f5';
                });

                fileWrapper.addEventListener('dragleave', function(e) {
                    e.preventDefault();
                    if (!this.contains(e.relatedTarget)) {
                        this.style.borderColor = '#e9ecef';
                        this.style.backgroundColor = '#f8f9fa';
                    }
                });

                fileWrapper.addEventListener('drop', function(e) {
                    e.preventDefault();
                    this.style.borderColor = '#e9ecef';
                    this.style.backgroundColor = '#f8f9fa';

                    const files = e.dataTransfer.files;
                    if (files.length > 0) {
                        fileInput.files = files;
                        fileInput.dispatchEvent(new Event('change'));
                    }
                });
            }
        });
    </script>
@endsection
