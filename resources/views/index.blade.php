@extends('layouts.app')

@section('content')
<style>
    /* Styling for carousel and images */
    .carousel-inner {
        display: block;
    }

    .carousel-item {
        width: 100%;
        height: 100%;
    }

    .carousel-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
<div class="w-100 overflow-hidden bg-gray-100" id="top">
    <div class="container position-relative">
        <div class="row align-items-stretch">
            <div class="col-lg-7 py-vh-6 position-relative d-flex flex-column justify-content-between">
                <h1 class="display-1 fw-bold mt-5">Sell more useless stuff faster!</h1>
                <p class="lead">To be honest, this is just a stupid placeholder text. We don´t know how to
                    sell anything, not even lesser or slower as you.</p>
            </div>
            <div class="col-lg-5 py-vh-6 d-flex flex-column justify-content-between gap-3">
                <div class="p-3 bg-light border" style="height: 70%;">Grid Item 1</div>
                <div id="carouselExample" class="carousel slide p-3 bg-light border" style="height: 30%;" data-bs-ride="carousel" data-bs-interval="2000" data-bs-wrap="true">
                    <div class="carousel-inner">
                        <!-- Carousel Item 1 -->
                        <div class="carousel-item active">
                            <img src="logo-karang-taruna.png" class="d-block w-100 rounded" alt="Image 1" style="height: 100%; object-fit: cover;">
                        </div>
                        <!-- Carousel Item 2 -->
                        <div class="carousel-item">
                            <img src="logo-karang-taruna.png" class="d-block w-100 rounded" alt="Image 2" style="height: 100%; object-fit: cover;">
                        </div>
                        <!-- Carousel Item 3 -->
                        <div class="carousel-item">
                            <img src="logo-karang-taruna.png" class="d-block w-100 rounded" alt="Image 3" style="height: 100%; object-fit: cover;">
                        </div>
                        <!-- Add more items as needed -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




    <div class="py-vh-5 w-100 overflow-hidden" id="services">
        <div class="container">
            <div class="row d-flex justify-content-end">
                <div class="col-lg-8">
                    <h2 class="display-6">Okay, there are three really good reasons for us. There are no more than
                        three, but we think three is a reasonable good number of good stuff.</h2>
                </div>
            </div>
            <div class="row d-flex align-items-center">
                <div class="col-md-6 col-lg-4">
                    <span class="h5 fw-lighter">01.</span>
                    <h3 class="py-5 border-top border-dark">We rented this fancy startup office in an old factory
                        building.</h3>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minus culpa, voluptatibus ex
                        itaque, sapiente a consequatur inventore beatae, ipsam debitis omnis consequuntur iste
                        asperiores. Similique quisquam debitis corrupti deserunt, dolor.</p>
                    <a href="#" class="link-fancy">Learn more
                    </a>
                </div>

                <div class="col-md-6 col-lg-4 py-vh-4 pb-0">
                    <span class="h5 fw-lighter">02.</span>
                    <h3 class="py-5 border-top border-dark">We don´t know exactly what we are doing. But thats good
                        because we can´t break something intentionally.</h3>
                    <p>Lorem, ipsum dolor sit adipisicing elit. Minus culpa, voluptatibus ex itaque, sapiente a
                        consequatur inventore beatae, ipsam debitis omnis consequuntur iste asperiores. Similique
                        quisquam debitis corrupti deserunt, dolor.</p>
                    <a href="#" class="link-fancy">Learn more
                    </a>
                </div>

                <div class="col-md-6 col-lg-4 py-vh-6 pb-0">
                    <span class="h5 fw-lighter">03.</span>
                    <h3 class="py-5 border-top border-dark">There is no real number three reason. So please read
                        again number one and two.</h3>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minus culpa, voluptatibus ex
                        itaque, sapiente a consequatur inventore beatae, ipsam debitis omnis consequuntur iste
                        asperiores. Similique quisquam debitis corrupti deserunt, dolor.</p>
                    <a href="#" class="link-fancy">Learn more
                    </a>
                </div>
            </div>

        </div>
    </div>

    <div class="py-vh-4 bg-gray-100 w-100 overflow-hidden" id="aboutus">
        <div class="container">

            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-lg-6">
                    <div class="row gx-5 d-flex">
                        <div class="col-md-11">
                            <div class="shadow ratio ratio-16x9 rounded bg-cover bp-center align-self-end"
                                data-aos="fade-right"
                                style="background-image: url(img/webp/people15.webp);--bs-aspect-ratio: 50%;">
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-1">
                            <div class="shadow ratio ratio-1x1 rounded bg-cover mt-5 bp-center float-end" data-aos="fade-up"
                                style="background-image: url(img/webp/interior42.webp);">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-12 shadow ratio rounded bg-cover mt-5 bp-center" data-aos="fade-left"
                                style="background-image: url(img/webp/people4.webp);--bs-aspect-ratio: 150%;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h3 class="py-5 border-top border-dark" data-aos="fade-left">We did some interesting stuff in
                        our field of work. For example we collect a lot of these free photos and use them on our
                        website.</h3>
                    <p data-aos="fade-left" data-aos-delay="200">Donec id elit non mi porta gravida at eget metus.
                        Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa
                        justo sit amet risus.
                    </p>
                    <p>
                        <a href="#" class="link-fancy link-dark" data-aos="fade-left" data-aos-delay="400">Learn
                            more
                        </a>
                    </p>
                </div>
            </div>

        </div>
    </div>

    <div class="py-vh-5 w-100 overflow-hidden" id="numbers">
        <div class="container">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-lg-5">
                    <h3 class="py-5 border-top border-dark" data-aos="fade-right">Our magic numbers</h3>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="display-6 mb-5" data-aos="fade-down">There are some important numbers for
                                us. They are just numbers without any meaning, but we just love them.</h2>
                        </div>
                        <div class="col-lg-6" data-aos="fade-up">
                            <div class="display-1 fw-bold py-4">42%</div>
                            <p class="text-black-50">Donec id elit non mi porta gravida at eget metus. Fusce
                                dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum
                                massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec
                                sed odio dui.</p>
                        </div>
                        <div class="col-lg-6" data-aos="fade-up">
                            <div class="display-1 fw-bold py-4">+300</div>
                            <p class="text-black-50">Donec id elit non mi porta gravida at eget metus. Fusce
                                dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum
                                massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec
                                sed odio dui.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="position-relative overflow-hidden w-100 bg-light" id="gallery">
        <div class="container-fluid">
            <div class="row overflow-scroll">
                <div class="col-12">
                    <div class="row vw-100 px-0 py-vh-5 d-flex align-items-center scrollx">
                        <div class="col-md-2" data-aos="fade-up">
                            <img src="img/webp/interior37.webp" class="rounded shadow img-fluid" alt="nice gallery image"
                                width="512" height="341">
                        </div>

                        <div class="col-md-2" data-aos="fade-up" data-aos-delay="200">
                            <img src="img/webp/people1.webp" class="img-fluid rounded shadow" alt="nice gallery image"
                                width="1164" height="776">
                        </div>

                        <div class="col-md-3" data-aos="fade-up" data-aos-delay="400">
                            <img src="img/webp/people2.webp" class="img-fluid rounded shadow" alt="nice gallery image"
                                width="844" height="1054">
                        </div>

                        <div class="col-md-3" data-aos="fade-up" data-aos-delay="600">
                            <img src="img/webp/interior29.webp" class="img-fluid rounded shadow" alt="nice gallery image"
                                width="844" height="562">
                        </div>

                        <div class="col-md-2" data-aos="fade-up" data-aos-delay="800">
                            <img src="img/webp/people23.webp" class="rounded shadow img-fluid" alt="nice gallery image"
                                width="512" height="341">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="container py-vh-4 w-100 overflow-hidden">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-5">
                <h3 class="py-5 border-top border-dark" data-aos="fade-right">What our clients say</h3>
            </div>
            <div class="col-md-7" data-aos="fade-left">
                <blockquote>
                    <div class="fs-4 my-3 fw-light pt-4 border-bottom pb-3">“I´am the CEO of this company. So maybe
                        you think "he will tell us something super awesome about it only". But no. Its a really
                        strange place to work with creepy people all around.
                        They do some computer stuff I don´t understand. But I wear expensive Glasses and a Patagonia
                        Hoodie. So I´am fine with it.”</div>
                    <img src="img/webp/person11.webp" width="64" height="64"
                        class="img-fluid rounded-circle me-3" alt="" data-aos="fade">
                    <span><span class="fw-bold">John Doe,</span>
                        CEO of Stride Ltd.</span>
                </blockquote>
            </div>

        </div>
    </div>

    <div class="py-vh-6 bg-gray-900 text-light w-100 overflow-hidden" id="workwithus">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8 text-center" data-aos="fade">
                        <p class="text-secondary lead">Let´s start a project together!</p>
                        <h2 class="display-6 mb-5">Hell no! This button is linked to a none working contact form. A
                            none working form without any user feedback. So you might think you done something
                            wrong. But in reality we just don´t want to start anything with you or anyone else.</h2>
                    </div>
                    <div class="col-12">
                        <a href="#" class="btn btn-warning btn-xl shadow me-3 mt-4" data-aos="fade-down">Get in
                            contact</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
