<style>
/* CSS */
.footer-social {
  background-color: #ba2d11;
  padding: 10px 20px;
  display: flex; /* ganti ke flex agar mudah ditengah-tengahkan */
  justify-content: center; /* center secara horizontal */
  align-items: center;     /* center secara vertikal */
  gap: 20px;
  margin-top: 20px;
}

.footer-social a {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 40px;   /* beri lebar tetap agar tiap ikon simetris */
  height: 40px;
  border-radius: 50%; /* opsional: agar bentuk bulat */
  text-decoration: none;
}

.footer-social i,
.footer-social .icon-tiktok {
  width: 24px;
  height: 24px;
  font-size: 24px;
  color: white;
  fill: white;
}

/* Untuk SVG TikTok agar konsisten dengan ikon <i> */
.footer-social .icon-tiktok {
  display: block;
  margin: auto;
}

/* Tambahan opsional jika masih tidak rata di browser tertentu */
.footer-social svg {
  vertical-align: middle;
  display: block;
}


</style>
<div class="footer-areasa footer-padding fix" style="background: #ba2d11">
    <div class="container">
        <div class="row d-flex justify-content-between">
            <div class="col-xl-5 col-lg-5 col-md-7 col-sm-12">
                <div class="single-footer-caption">
                    <div class="footer-logo text-center">
                        <a href="{{ url('/') }}"><img src="{{ asset('assets/img/logo-galow-putih.png') }}" class="img-fluid" style="width: 200px; height: auto;"
                                alt=""></a>
                    </div>
                    <div class="footer-tittle">
                        <div class="footer-perl">
                            <p style="color: #d3d3d3; padding-top: 15px; text-align: justify;">
                              Karang Taruna Lowayu adalah organisasi kepemudaan di Desa Lowayu yang menjadi wadah bagi generasi muda untuk mengembangkan diri melalui kegiatan sosial, ekonomi, budaya, dan olahraga, serta berperan aktif dalam pembangunan desa.
                            </p>

                        </div>
                    </div>
                    <!-- Social -->
                    <!-- HTML -->
                    <div class="footer-social">
                      <!-- Instagram (Font Awesome) -->
                      <a href="https://web.facebook.com/katar.lowayu">
                        <i class="fab fa-facebook"></i>
                      </a>
                      <a href="https://www.instagram.com/galow.tunas.bangsa">
                        <i class="fab fa-instagram"></i>
                      </a>
                    
                      <!-- WhatsApp (Font Awesome) -->
                      <a href="https://api.whatsapp.com/send/?phone=%2B6285183260964&text&type=phone_number&app_absent=0">
                        <i class="fab fa-whatsapp"></i>
                      </a>
                      <!-- TikTok (SVG baru) -->
                      <a href="https://www.tiktok.com/@galow.tunas.bangsa">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 24 24"
                          class="icon-tiktok"
                          aria-label="TikTok"
                        >
                          <path fill="currentColor" d="M16.6 5.82s.51.5 0 0A4.28 4.28 0 0 1 15.54 3h-3.09v12.4a2.59 2.59 0 0 1-2.59 2.5c-1.42 0-2.6-1.16-2.6-2.6c0-1.72 1.66-3.01 3.37-2.48V9.66c-3.45-.46-6.47 2.22-6.47 5.64c0 3.33 2.76 5.7 5.69 5.7c3.14 0 5.69-2.55 5.69-5.7V9.01a7.35 7.35 0 0 0 4.3 1.38V7.3s-1.88.09-3.24-1.48"/>
                        </svg>
                      </a>
                    
                      <!-- Email (Font Awesome) -->
                      <a href="mailto:galowtunasbangsa@gmail.com">
                        <i class="fas fa-envelope"></i>
                      </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer Bottom Area -->
<div class="footer-bottom-area" style="background: #ba2d11">
    <div class="container">
        <div class="footer-border">
            <div class="row d-flex align-items-center justify-content-between">
                <div class="col-lg-6">
                    <div class="footer-copy-right">
                        <p style="color: #d3d3d3 text-align:center;">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Dikelola oleh Divisi Media Kreatif™
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
