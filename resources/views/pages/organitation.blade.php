@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="hero-content text-center">
                        <h1 class="hero-title">Organisasi Kepemudaan</h1>
                        <h2 class="hero-subtitle">Desa Lowayu</h2>
                        <p class="hero-description">Wadah Pengembangan Potensi Generasi Muda</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="about-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about-right mb-90">
                        <div class="section-header mt-5">
                            <h3 class="section-title">Daftar Organisasi</h3>
                            <div class="section-line"></div>
                        </div>

                        <div class="row">
                            @foreach ($organisasis as $organisasi)
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <div class="org-card">
                                        <div class="org-image">
                                            <img src="{{ asset('uploads/' . $organisasi->photo) }}"
                                                alt="{{ $organisasi->name }}" class="org-img">
                                        </div>
                                        <div class="org-content">
                                            <h5 class="org-title">{{ $organisasi->name }}</h5>
                                            <p class="org-description">{{ $organisasi->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if ($organisasis->isEmpty())
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <h4>Belum Ada Organisasi</h4>
                                <p>Belum ada organisasi kepemudaan yang terdaftar saat ini.</p>
                            </div>
                        @endif
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

        /* Intro Text */
        .intro-text {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
            background: linear-gradient(145deg, #ffffff, #f8f9fa);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            border-left: 4px solid #97240f;
        }

        .intro-text p {
            color: #555;
            line-height: 1.7;
            font-size: 1.1rem;
            margin-bottom: 15px;
        }

        .intro-text p:last-child {
            margin-bottom: 0;
        }

        /* Organization Cards */
        .org-card {
            background: linear-gradient(145deg, #ffffff, #f8f9fa);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            height: 100%;
            border: none;
        }

        .org-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 40px rgba(151, 36, 15, 0.15);
        }

        .org-image {
            position: relative;
            height: 250px;
            overflow: hidden;
        }

        .org-img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: transform 0.4s ease;
            background: #f8f9fa;
        }

        .org-card:hover .org-img {
            transform: scale(1.1);
        }

        .org-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .org-card:hover .org-overlay {
            opacity: 1;
        }

        .org-content {
            padding: 25px;
        }

        .org-title {
            font-weight: 700;
            color: #97240f;
            margin-bottom: 15px;
            font-size: 1.3rem;
            text-align: center;
            transition: color 0.3s ease;
        }

        .org-card:hover .org-title {
            color: #e74c3c;
        }

        .org-description {
            color: #555;
            line-height: 1.6;
            margin-bottom: 20px;
            text-align: center;
            font-size: 0.95rem;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: linear-gradient(145deg, #ffffff, #f8f9fa);
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        .empty-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #97240f, #e74c3c);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 2rem;
        }

        .empty-state h4 {
            color: #97240f;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .empty-state p {
            color: #666;
            font-size: 1.1rem;
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

            .intro-text {
                padding: 20px;
            }

            .intro-text p {
                font-size: 1rem;
            }

            .org-content {
                padding: 20px;
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

        .org-card {
            animation: fadeInUp 0.6s ease forwards;
        }

        .org-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .org-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .org-card:nth-child(3) {
            animation-delay: 0.3s;
        }

        .org-card:nth-child(4) {
            animation-delay: 0.4s;
        }

        .org-card:nth-child(5) {
            animation-delay: 0.5s;
        }

        .org-card:nth-child(6) {
            animation-delay: 0.6s;
        }
    </style>
@endsection
