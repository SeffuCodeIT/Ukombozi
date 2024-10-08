@extends("layout.index")
@section("content")


    <main class="main">
        <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">Contact us<span>KARIBU</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <div class="page-content">
            <div class="container">

                <hr class="mt-3 mb-5 mt-md-1">
                <div class="touch-container row justify-content-center">
                    <div class="col-md-9 col-lg-7">
                        <div class="text-center">
                            <h2 class="title mb-1">Get In Touch</h2><!-- End .title mb-2 -->
                            <p class="lead text-primary">
                                We collaborate with ambitious brands and people; we’d love to build something great together.
                            </p><!-- End .lead text-primary -->
                            <p class="mb-3">Vestibulum volutpat, lacus a ultrices sagittis, mi neque euismod dui, eu pulvinar nunc sapien ornare nisl. Phasellus pede arcu, dapibus eu, fermentum et, dapibus sed, urna.</p>
                        </div><!-- End .text-center -->

                        <form action="#" class="contact-form mb-2">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="cname" class="sr-only">Name</label>
                                    <input type="text" class="form-control" id="cname" placeholder="Name *" required>
                                </div><!-- End .col-sm-4 -->

                                <div class="col-sm-4">
                                    <label for="cemail" class="sr-only">Name</label>
                                    <input type="email" class="form-control" id="cemail" placeholder="Email *" required>
                                </div><!-- End .col-sm-4 -->

                                <div class="col-sm-4">
                                    <label for="cphone" class="sr-only">Phone</label>
                                    <input type="tel" class="form-control" id="cphone" placeholder="Phone">
                                </div><!-- End .col-sm-4 -->
                            </div><!-- End .row -->

                            <label for="csubject" class="sr-only">Subject</label>
                            <input type="text" class="form-control" id="csubject" placeholder="Subject">

                            <label for="cmessage" class="sr-only">Message</label>
                            <textarea class="form-control" cols="30" rows="4" id="cmessage" required placeholder="Message *"></textarea>

                            <div class="col-6 col-lg-4 col-xl-2" style="margin-left: 33%;">
                                <div class="btn-wrap" >
{{--                                    <span>Rounded Corners Style</span>--}}
                                    <a href="#" class="btn btn-primary btn-rounded" >Submit</a>
                                </div><!-- End .btn-wrap -->
                            </div><!-- End .col-md-4 col-lg-2 -->

                        </form><!-- End .contact-form -->
                    </div><!-- End .col-md-9 col-lg-7 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .page-content -->

{{--        start of faq--}}
        <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">F.A.Q<span>Frequently asked questions</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">FAQ</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="container">
                <h2 class="title text-center mb-3">Shipping Information</h2><!-- End .title -->
                <div class="accordion accordion-rounded" id="accordion-1">
                    <div class="card card-box card-sm bg-light">
                        <div class="card-header" id="heading-1">
                            <h2 class="card-title">
                                <a role="button" data-toggle="collapse" href="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
                                    How will my parcel be delivered?
                                </a>
                            </h2>
                        </div><!-- End .card-header -->
                        <div id="collapse-1" class="collapse show" aria-labelledby="heading-1" data-parent="#accordion-1">
                           <div class="card-body">
                                Your parcel will be delivered by our trusted courier partners. Depending on your location, delivery might be done by local couriers or major logistics companies. All packages are handled with care to ensure your books arrive in perfect condition.
                            </div>
                        </div><!-- End .collapse -->
                    </div><!-- End .card -->

                    <div class="card card-box card-sm bg-light">
                        <div class="card-header" id="heading-2">
                            <h2 class="card-title">
                                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-2" aria-expanded="false" aria-controls="collapse-2">
                                    Do I pay for delivery?
                                </a>
                            </h2>
                        </div><!-- End .card-header -->
                        <div id="collapse-2" class="collapse" aria-labelledby="heading-2" data-parent="#accordion-1">
                            <div class="card-body">
                                Yes, a delivery fee is applied to all orders. However, we offer free delivery for orders above a certain amount or during special promotions. The exact fee depends on your location and the weight of the parcel.                            </div><!-- End .card-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .card -->

                    <div class="card card-box card-sm bg-light">
                        <div class="card-header" id="heading-3">
                            <h2 class="card-title">
                                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-3" aria-expanded="false" aria-controls="collapse-3">
                                    Will I be charged customs fees?
                                </a>
                            </h2>
                        </div><!-- End .card-header -->
                        <div id="collapse-3" class="collapse" aria-labelledby="heading-3" data-parent="#accordion-1">
                            <div class="card-body">
                                If you're ordering from outside our base country, customs fees may apply. These fees are determined by your local customs office and are the responsibility of the customer. We recommend checking with your local customs office for more details.                            </div><!-- End .card-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .card -->

                    <div class="card card-box card-sm bg-light">
                        <div class="card-header" id="heading-4">
                            <h2 class="card-title">
                                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-4" aria-expanded="false" aria-controls="collapse-4">
                                    My item has become faulty
                                </a>
                            </h2>
                        </div><!-- End .card-header -->
                        <div id="collapse-4" class="collapse" aria-labelledby="heading-4" data-parent="#accordion-1">
                            <div class="card-body">
                                If you receive a faulty book or if your item becomes faulty shortly after purchase, please contact our customer support team within 7 days of delivery. We will arrange for a replacement or provide a refund as per our returns policy.                            </div><!-- End .card-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .card -->
                </div><!-- End .accordion -->

                <h2 class="title text-center mb-3">Orders and Returns</h2><!-- End .title -->
                <div class="accordion accordion-rounded" id="accordion-2">
                    <div class="card card-box card-sm bg-light">
                        <div class="card-header" id="heading2-1">
                            <h2 class="card-title">
                                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse2-1" aria-expanded="false" aria-controls="collapse2-1">
                                    Tracking my order
                                </a>
                            </h2>
                        </div><!-- End .card-header -->
                        <div id="collapse2-1" class="collapse" aria-labelledby="heading2-1" data-parent="#accordion-2">
                            <div class="card-body">
                                Once your order is dispatched, we will send you a tracking link via email. You can use this link to check the status of your delivery at any time.                            </div><!-- End .card-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .card -->

                    <div class="card card-box card-sm bg-light">
                        <div class="card-header" id="heading2-2">
                            <h2 class="card-title">
                                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse2-2" aria-expanded="false" aria-controls="collapse2-2">
                                    I haven’t received my order
                                </a>
                            </h2>
                        </div><!-- End .card-header -->
                        <div id="collapse2-2" class="collapse" aria-labelledby="heading2-2" data-parent="#accordion-2">
                            <div class="card-body">
                                If your order hasn’t arrived within the estimated delivery time, please contact our support team. We'll investigate the delay and ensure your order reaches you as soon as possible.                            </div><!-- End .card-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .card -->

                    <div class="card card-box card-sm bg-light">
                        <div class="card-header" id="heading2-3">
                            <h2 class="card-title">
                                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse2-3" aria-expanded="false" aria-controls="collapse2-3">
                                    How can I return an item?
                                </a>
                            </h2>
                        </div><!-- End .card-header -->
                        <div id="collapse2-3" class="collapse" aria-labelledby="heading2-3" data-parent="#accordion-2">
                            <div class="card-body">
                                Returning an item is easy. Contact our support team to initiate the return process. Ensure the item is in its original condition, and we’ll provide you with a return label. Once we receive the returned item, we'll process your refund or replacement.                            </div><!-- End .card-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .card -->
                </div><!-- End .accordion -->

                <h2 class="title text-center mb-3">Payments</h2><!-- End .title -->
                <div class="accordion accordion-rounded" id="accordion-3">
                    <div class="card card-box card-sm bg-light">
                        <div class="card-header" id="heading3-1">
                            <h2 class="card-title">
                                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse3-1" aria-expanded="false" aria-controls="collapse3-1">
                                    What payment types can I use?
                                </a>
                            </h2>
                        </div><!-- End .card-header -->
                        <div id="collapse3-1" class="collapse" aria-labelledby="heading3-1" data-parent="#accordion-3">
                            <div class="card-body">
                                We accept a variety of payment methods including credit/debit cards, MPESA, and mobile payment options. For a full list, please check our payment page.                            </div><!-- End .card-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .card -->

                    <div class="card card-box card-sm bg-light">
                        <div class="card-header" id="heading3-2">
                            <h2 class="card-title">
                                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse3-2" aria-expanded="false" aria-controls="collapse3-2">
                                    Can I pay by Gift Card?
                                </a>
                            </h2>
                        </div><!-- End .card-header -->
                        <div id="collapse3-2" class="collapse" aria-labelledby="heading3-2" data-parent="#accordion-3">
                            <div class="card-body">
                                    We currently have no giftcard program running, but in the event we launch one. They will be accepted and all users will be notified                            </div><!-- End .card-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .card -->

                    <div class="card card-box card-sm bg-light">
                        <div class="card-header" id="heading3-3">
                            <h2 class="card-title">
                                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse3-3" aria-expanded="false" aria-controls="collapse3-3">
                                    I can't make a payment
                                </a>
                            </h2>
                        </div><!-- End .card-header -->
                        <div id="collapse3-3" class="collapse" aria-labelledby="heading3-3" data-parent="#accordion-3">
                            <div class="card-body">
                                If you’re having trouble making a payment, please double-check your payment details and try again. If the issue persists, contact our support team for assistance.                            </div><!-- End .card-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .card -->

                    <div class="card card-box card-sm bg-light">
                        <div class="card-header" id="heading3-4">
                            <h2 class="card-title">
                                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse3-4" aria-expanded="false" aria-controls="collapse3-4">
                                    Has my payment gone through?
                                </a>
                            </h2>
                        </div><!-- End .card-header -->
                        <div id="collapse3-4" class="collapse" aria-labelledby="heading3-4" data-parent="#accordion-3">
                            <div class="card-body">
                                Once your payment is successful, you will receive a confirmation email. If you do not receive this email or are unsure if the payment was processed, please contact our support team.

                            </div><!-- End .card-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .card -->
                </div><!-- End .accordion -->
            </div><!-- End .container -->
        </div><!-- End .page-content -->

{{--        end of faq--}}
    </main><!-- End .main -->

@endsection
