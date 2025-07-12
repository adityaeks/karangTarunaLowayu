@extends('layouts.app')

@section('meta')
    <title>Tentang Kami | Galow Tunas Bangsa</title>
    <meta name="description" content="Profil, visi, dan misi Galow Tunas Bangsa, organisasi kepemudaan Desa Lowayu.">
    <meta property="og:title" content="Tentang Kami | Galow Tunas Bangsa" />
    <meta property="og:description" content="Profil, visi, dan misi Galow Tunas Bangsa, organisasi kepemudaan Desa Lowayu." />
    <meta property="og:image" content="{{ asset('assets/img/logo/logo-utama.jpg') }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
@endsection

@section('content')
<div class="container">
    <div class="text-center my-4">
        <img src="{{ asset('assets/img/logo/logo-utama.jpg') }}" alt="Karang Taruna Lowayu" class="img-fluid">
    </div>

    <div class="mt-4">
        <h2>Karang Taruna Lowayu</h2>
        <p>Karang Taruna Lowayu is a youth organization committed to fostering community development and empowering young individuals to contribute positively to society. We aim to create a supportive environment for growth, creativity, and collaboration.(SEMENTARA)</p>
    </div>

    <div class="mt-4">
        <h2>Our Vision</h2>
        <p>To become a leading youth organization that inspires and empowers the community through innovative and impactful initiatives. (SEMENTARA)</p>
    </div>

    <div class="mt-4 mb-20">
        <h2>Our Mission</h2>
        <ul>
            <li>To promote social welfare and community development.</li>
            <li>To nurture leadership and teamwork among youth members.</li>
            <li>To organize programs that enhance skills, knowledge, and creativity.</li>
            <li>To foster a spirit of unity and collaboration within the community. (SEMENTARA)</li>
        </ul>
    </div>
</div>
@endsection
