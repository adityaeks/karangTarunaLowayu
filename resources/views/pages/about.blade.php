@extends('layouts.app')

@section('meta')
    <title>Tentang Kami | Galow Tunas Bangsa</title>
    <meta name="description" content="Profil, visi, dan misi Galow Tunas Bangsa, organisasi kepemudaan Desa Lowayu yang berkomitmen untuk pengembangan masyarakat dan pemberdayaan pemuda.">
    <meta property="og:title" content="Tentang Kami | Galow Tunas Bangsa" />
    <meta property="og:description" content="Profil, visi, dan misi Galow Tunas Bangsa, organisasi kepemudaan Desa Lowayu yang berkomitmen untuk pengembangan masyarakat dan pemberdayaan pemuda." />
    <meta property="og:image" content="{{ asset('assets/img/logo/logo-utama.jpg') }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
@endsection

@section('content')
<style>
    .about-hero {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 50%, #dee2e6 100%);
        color: #333;
        padding: 80px 0;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .about-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background:
            radial-gradient(circle at 20% 80%, rgba(151, 36, 15, 0.05) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(151, 36, 15, 0.05) 0%, transparent 50%),
            radial-gradient(circle at 40% 40%, rgba(151, 36, 15, 0.03) 0%, transparent 50%);
        opacity: 1;
    }

    .about-hero::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="%2397240f" opacity="0.05"/></pattern></defs><rect width="100" height="100" fill="url(%23dots)"/></svg>');
        opacity: 0.4;
    }

    .about-hero-content {
        position: relative;
        z-index: 2;
    }



    .about-logo {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 4px solid white;
        box-shadow: 0 8px 32px rgba(0,0,0,0.3);
        margin-bottom: 30px;
        transition: transform 0.3s ease;
    }

    .about-logo:hover {
        transform: scale(1.05);
    }

    .hero-title {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 20px;
        color: #97240f;
        text-shadow: none;
        letter-spacing: -0.5px;
        line-height: 1.1;
    }

    .hero-subtitle {
        font-size: 1.3rem;
        font-weight: 400;
        line-height: 1.6;
        color: #555;
        opacity: 1;
        max-width: 600px;
        margin: 0 auto;
        text-shadow: none;
    }

    /* Responsive Typography */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }

        .hero-subtitle {
            font-size: 1.1rem;
            max-width: 100%;
        }

        .about-logo {
            width: 100px;
            height: 100px;
            margin-bottom: 25px;
        }
    }

    @media (max-width: 480px) {
        .hero-title {
            font-size: 2rem;
            margin-bottom: 12px;
        }

        .hero-subtitle {
            font-size: 1rem;
        }

        .about-logo {
            width: 80px;
            height: 80px;
            margin-bottom: 20px;
        }
    }

    .about-section {
        padding: 60px 0;
        background: #f8f9fa;
    }

    .about-section:nth-child(even) {
        background: white;
    }

    .about-content {
        max-width: 800px;
        margin: 0 auto;
        text-align: center;
    }

    .about-content h2 {
        color: #e74c3c;
        font-size: 1.5rem;
        margin-bottom: 15px;
        font-weight: 500;
    }

    .about-content p {
        color: #666;
        line-height: 1.7;
        font-size: 1rem;
        margin-bottom: 15px;
    }

    .mission-list {
        list-style: none;
        padding: 0;
        text-align: left;
        max-width: 600px;
        margin: 0 auto;
    }

    .mission-list li {
        padding: 6px 0;
        color: #666;
        font-size: 0.95rem;
        position: relative;
        padding-left: 20px;
    }

    .mission-list li::before {
        content: '•';
        position: absolute;
        left: 0;
        color: #e74c3c;
        font-weight: bold;
        font-size: 1.2rem;
    }

    .contact-info {
        background: white;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        text-align: center;
        max-width: 500px;
        margin: 0 auto;
    }

    .contact-info h3 {
        color: #e74c3c;
        margin-bottom: 20px;
    }

    .contact-item {
        margin: 10px 0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .contact-item i {
        color: #e74c3c;
        font-size: 1.1rem;
    }
</style>

<!-- Hero Section -->
<section class="about-hero">
    <div class="container">
        <div class="about-hero-content">
            <img src="{{ asset('assets/img/logo/logo-utama.jpg') }}" alt="Galow Tunas Bangsa" class="about-logo">
            <h1 class="hero-title">Galow Tunas Bangsa</h1>
            <p class="hero-subtitle">Galow Tunas Bangsa adalah organisasi kepemudaan yang berdedikasi untuk mengembangkan potensi pemuda Desa Lowayu dan berkontribusi positif terhadap kemajuan masyarakat.</p>
        </div>
    </div>
</section>

<!-- Visi Section -->
<section class="about-section">
    <div class="container">
        <div class="about-content">
            <h2>Visi Kami</h2>
            <p>Menjadi organisasi kepemudaan terdepan yang menginspirasi dan memberdayakan masyarakat melalui inisiatif yang inovatif dan berdampak positif.</p>
        </div>
    </div>
</section>

<!-- Misi Section -->
<section class="about-section">
    <div class="container">
        <div class="about-content">
            <h2>Misi Kami</h2>
            <ul class="mission-list">
                <li>Meningkatkan kesejahteraan sosial dan pengembangan masyarakat</li>
                <li>Mengembangkan kepemimpinan dan kerja tim di kalangan pemuda</li>
                <li>Menyelenggarakan program peningkatan keterampilan dan kreativitas</li>
                <li>Membangun semangat persatuan dan kolaborasi dalam masyarakat</li>
                <li>Mendorong partisipasi aktif pemuda dalam pembangunan desa</li>
            </ul>
        </div>
    </div>
</section>
@endsection
