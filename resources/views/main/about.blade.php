@extends("layout.index")
@section("content")
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">About us</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->
        <div class="container">
            <div class="page-header page-header-big text-center" style="background-image: url('assets/images/about/cause-4.jpg'); position: relative;">
                <div style="background-color: rgba(50,50,50,0.5); position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></div>
                <h1 class="page-title text-white" style="position: relative; z-index: 1;">About us<span class="text-white">Who we are</span></h1>
            </div><!-- End .page-header -->

        </div><!-- End .container -->

        <div class="page-content pb-0">
            <div class="container">
                <div class="row" >
                    <div class="col-lg-6 mb-3 mb-lg-0">
                        <h2 class="title">Our Vision</h2><!-- End .title -->
                        <p style="font-size: 20px;">A society where every individual, regardless of class, ethnicity, or background, has access to the knowledge and resources necessary to drive social change, promote justice, and contribute to a progressive future for Kenya and beyond.

                        </p>
                    </div><!-- End .col-lg-6 -->

                    <div class="col-lg-6">
                        <h2 class="title">Our Mission</h2><!-- End .title -->
                        <p style="font-size: 20px;">To empower working people in Kenya by providing access to progressive literature, fostering a culture of reading, study, and research, and facilitating the exchange of ideas that inspire social justice and national development.</p>
                    </div><!-- End .col-lg-6 -->
                </div><!-- End .row -->

                <div class="mb-5"></div><!-- End .mb-4 -->
            </div><!-- End .container -->

            <div class="bg-light-2 pt-6 pb-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 mb-3 mb-lg-0">
                            <h2 class="title">Who We Are</h2><!-- End .title -->
                            <p class="lead text-primary mb-3">Ukombozi Library, established in 2017 by a coalition of progressive African libraries and information activists, is a vibrant hub dedicated to making progressive material accessible to the Kenyan public.  <br>In partnership with Vita Books, Mwakenya December Movement, and the Mau Mau Research Centre, we offer a diverse collection of nearly a thousand titles, including books, pamphlets, videos, and photographs. Our collection features rare classics, out-of-print works, and materials donated by progressive individuals and organizations.</p><!-- End .lead text-primary -->
                            <p class="mb-2" style="font-size: 20px;">
                                Through our Community ReachOut initiative, we break the colonial library mold by taking our resources directly to communities, supporting their growth and development. Ukombozi Library serves as a meeting place for students, social movement activists, and others committed to social justice, providing a space for reading, discussion, and reflection on progressive ideas.
                                Membership is open to all who align with our vision and principles, welcoming individuals and institutions to join us in the struggle for a more just and equitable society.</p>
                            <a href="blog.html" class="btn btn-sm btn-minwidth btn-outline-primary-2">
                                <span>VIEW OUR NEWS</span>
                                <i class="icon-long-arrow-right"></i>
                            </a>
                        </div><!-- End .col-lg-5 -->

                        <div class="col-lg-6 offset-lg-1">
                            <div class="about-images">
                                <img src="assets/images/about/img-1.jpg" alt="" class="about-img-front">
                                <img src="assets/images/about/img-2.jpg" alt="" class="about-img-back">
                            </div><!-- End .about-images -->
                        </div><!-- End .col-lg-6 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
                <div id="map" class="mb-5" style="width: 100%; height: 500px;">
                    <iframe id="gmap_canvas"
                            src="https://maps.google.com/maps?q=vitabooks&t=&z=13&ie=UTF8&iwloc=&output=embed"
                            frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                            style="width: 100%; height: 100%; border: 0;"></iframe>
                </div><!-- End #map -->

                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="contact-box text-center">
                                <h3>Office</h3>

                                <address>LetShego Plaza 3rd Floor, Nairobi, <br>NBO 00100, KENYA</address>
                            </div><!-- End .contact-box -->
                        </div><!-- End .col-md-4 -->

                        <div class="col-md-4">
                            <div class="contact-box text-center">
                                <h3>Start a Conversation</h3>

                                <div><a href="mailto:#">info@ukombozilibrary.com</a></div>
                                <div><a href="tel:#">+254 723-911-371</a>, <a href="tel:#">+254  702-620-847</a></div>
                            </div><!-- End .contact-box -->
                        </div><!-- End .col-md-4 -->

                        <div class="col-md-4">
                            <div class="contact-box text-center">
                                <h3>Social</h3>

                                <div class="social-icons social-icons-color justify-content-center">
                                    <a href="#" class="social-icon social-facebook" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                    <a href="#" class="social-icon social-twitter" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                    <a href="#" class="social-icon social-instagram" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                    <a href="#" class="social-icon social-youtube" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
                                    <a href="#" class="social-icon social-pinterest" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                                </div><!-- End .soial-icons -->
                            </div><!-- End .contact-box -->
                        </div><!-- End .col-md-4 -->
                    </div><!-- End .row -->

                    <hr class="mt-3 mb-5 mt-md-1">
                    <div class="touch-container row justify-content-center">
                        <div class="col-md-9 col-lg-7">
                            <div class="text-center">
                                <h2 class="title mb-1">Get In Touch</h2><!-- End .title mb-2 -->
                                <p class="lead text-primary">
                                    We welcome collaboration with individuals, communities, and organizations who share our commitment to social justice and progressive change. Whether you’re looking to join our efforts, share resources, or explore partnerships, we’d love to hear from you.                                </p><!-- End .lead text-primary -->
                                <p class="mb-3">Feel free to reach out to us with your ideas, questions, or to find out how you can get involved in our initiatives. Let’s work together to make a meaningful impact.</p>
                            </div><!-- End .text-center -->

                        </div><!-- End .col-md-9 col-lg-7 -->
                    </div><!-- End .row -->
                </div></div>
            </div><!-- End .bg-light-2 pt-6 pb-6 -->




    </main><!-- End .main -->

@endsection
