<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <title>OGDAMS</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="\home/img/favicon.png" rel="icon">
  <link href="\home/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="\home/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="\home/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="\home/lib/animate/animate.min.css" rel="stylesheet">
  <link href="\home/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="\home/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="\home/lib/magnific-popup/magnific-popup.css" rel="stylesheet">
  <link href="\home/lib/ionicons/css/ionicons.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="\home/css/style.css" rel="stylesheet">
  <link href="\home/css/pricing-style.css" rel="stylesheet">

  <!-- =======================================================
    Theme Name: Reveal
    Theme URL: https://bootstrapmade.com/reveal-bootstrap-corporate-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>

<body id="body">

  <!--==========================
    Top Bar
  ============================-->
  <section id="topbar" class="d-none d-lg-block">
    <div class="container clearfix">
      <div class="contact-info float-left">
        <i class="fa fa-envelope-o"></i> <a href="mailto:contact@example.com">support@ogdam.com</a>
        <i class="fa fa-phone"></i> +234 9066 6857 02
      </div>
      <div class="social-links float-right">
        <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
        <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
        <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
        <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
        <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
      </div>
    </div>
  </section>

  <!--==========================
    Header
  ============================-->
  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <h1><img src="\home/img/logo.jpg" class="img-fluid logo"><a href="#body" class="scrollto">G<span>DAM</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="#body"><img src="img/logo.png" alt="" title="" /></a>-->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="#body">Home</a></li>
          <li><a href="#about">About Us</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#contact">Contact</a></li>
          <li><a href="#team">DataPlans</a></li>
          <li><a href="{{ route('user.register') }}">Register</a></li>
          <li><a href="{{ route('user.login') }}">Login</a></li>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->

  <!--==========================
    Intro Section
  ============================-->
  <section id="intro">

    <div class="intro-content">
      <h2>Making <span>your ideas</span><br>happen!</h2>
      <div>
        <a href="{{ route('user.login') }}" class="btn-get-started scrollto">Get Started</a>
        <a href="{{ route('user.register') }}" class="btn-projects scrollto">Sign Up</a>
      </div>
    </div>

    <div id="intro-carousel" class="owl-carousel" >
      <div class="item" style="background-image: url('img/intro-carousel/1.jpg');"></div>
      <div class="item" style="background-image: url('img/intro-carousel/2.jpg');"></div>
      <div class="item" style="background-image: url('img/intro-carousel/3.jpg');"></div>
      <div class="item" style="background-image: url('img/intro-carousel/4.jpg');"></div>
      <div class="item" style="background-image: url('img/intro-carousel/5.jpg');"></div>
    </div>

  </section><!-- #intro -->

  <main id="main">

    <!--==========================
      About Section
    ============================-->
    <section id="about" class="wow fadeInUp">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 about-img about-div">
            <img src="\home/img/about-img.jpg" alt="">
            <img src="\home/img/phone_hand.png" height="300px" width="200px" class="img-fluid plus-image">
          </div>

          <div class="col-lg-6 content">
            <h2>Lorem ipsum dolor sit amet, consectetur adipiscing</h2>
            <h3>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</h3>

            <ul>
              <li><i class="ion-android-checkmark-circle"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
              <li><i class="ion-android-checkmark-circle"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
              <li><i class="ion-android-checkmark-circle"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</li>
            </ul>

          </div>
        </div>

      </div>
    </section><!-- #about -->

    <!--==========================
      Services Section
    ============================-->
    <section id="services">
      <div class="container">
        <div class="section-header text-center">
          <h2 class="mx-auto">Services</h2>
          <p>Sed tamen tempor magna labore dolore dolor sint tempor duis magna elit veniam aliqua esse amet veniam enim export quid quid veniam aliqua eram noster malis nulla duis fugiat culpa esse aute nulla ipsum velit export irure minim illum fore</p>
        </div>

        <div class="row">

          <div class="col-lg-6">
            <div class="box wow fadeInLeft text-center">
                <div class="icon block-center">
                  <img class="img-fluid mx-auto" src="\home/img/services/bulk-sms.png">
                </div>
              <h4 class="title"><a href="">Send Bulk SMS</a></h4>
              <p class="description">Send BulkSMS to any number for as low as just 50 kobo per unit. Ours Bulks sms service also deliver sms to DND numbers</p>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="box wow fadeInRight text-center">
              <div class="icon">
                <img class="img-fluid mx-auto" src="\home/img/services/data-plan.jpg">
              </div>
              <h4 class="title"><a href="">Buy Data Bundle</a></h4>
              <p class="description">Start enjoying this very low rates for your internet browsing databundle for all networks. We ve got you covered</p>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="box wow fadeInLeft text-center" data-wow-delay="0.2s">
              <div class="icon">
                <img class="img-fluid mx-auto" src="\home/img/services/cable-tv.png">
              </div>
              <h4 class="title"><a href="">Cable Tv subscription</a></h4>
              <p class="description">Instantly Activate Cable subscription(Dstv, Gotv, Startimes ...) with favourable discount compare to others.</p>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="box wow fadeInRight text-center" data-wow-delay="0.2s">
              <div class="icon">
                <img class="img-fluid mx-auto" src="\home/img/services/airtime-cash.png">
              </div>
              <h4 class="title"><a href="">Airtime To Cash</a></h4>
              <p class="description">We offer this service at a 80% CONVERSION RATE.This simply means that if you send N1,000 worth of AIRTIME to us you will receive instant N800.</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- #services -->

    <!--==========================
      Call To Action Section
    ============================-->
    <section id="call-to-action" class="wow fadeInUp">
      <div class="container">
        <div class="row">
          <div class="col-lg-9 text-center text-lg-left">
            <h3 class="cta-title">Call To Action</h3>
            <p class="cta-text"> Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          </div>
          <div class="col-lg-3 cta-btn-container text-center">
            <a class="cta-btn align-middle" href="#">Call To Action</a>
          </div>
        </div>

      </div>
    </section><!-- #call-to-action -->

    <!--==========================
      Pricing tables
    ============================-->
    <section id="team" class="wow fadeInUp">
      <div class="container">
        <div class="section-header">
          <h2>Data Plans</h2>
        </div>
        <div class="row">
            @foreach ($dataPlans as $networks)
                <div class="col-md-3">
                    <div class="block block-pricing">
                        <div class="table table-{{ strtolower($networks[0]->network) }}">
                            <h6 class="category"></h6>
                            <h1 class="block-caption">
                                <img class="logo" src="\images/networks/{{ strtolower($networks[0]->network) }}.png">
                            </h1>
                            <ul>
                                @foreach ($networks as $plan)
                                    <li>{{ $plan->volume }} - @naira($plan->amount)</li>
                                @endforeach
                            </ul>
                            <a href="{{ route('data.buy') }}" class="btn btn-white btn-raise btn-round">
                                <i class="fa fa-shopping-cart"></i> Buy Now
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

      </div>
    </section><!-- #team -->

    <!--==========================
      Our Partners
    ============================-->
    <section id="clients" class="wow fadeInUp">
        <div class="container">
            <div class="section-header">
            <h2>Our Partners</h2>
            <p>We Partner directly with major service providers make our service affordable without sacrificing quality</p>
            </div>
            @php
                $partners = collect([
                    'networks/9mobile', 'networks/airtel', 'networks/glo', 'networks/mtn','bills/electricity/ekedc', 'bills/electricity/ikedc',
                    'bills/internet/smile', 'bills/internet/spectranet', 'bills/misc/waec', 'bills/tv/dstv', 'bills/tv/gotv', 'bills/tv/startimes',
                ]);
                //$partners = shuffle($partners);
            @endphp

            <div class="owl-carousel clients-carousel">
                @foreach ($partners->shuffle() as $partner)
                    <img class="mx-auto" src="\images/{{ $partner }}.png">
                @endforeach
            </div>

        </div>
    </section><!-- #clients -->

    <!--==========================
      Testimonials Section
    ============================-->
    <section id="testimonials" class="wow fadeInUp">
        <div class="container">
            <div class="section-header">
            <h2>Testimonials</h2>
            <p>Sed tamen tempor magna labore dolore dolor sint tempor duis magna elit veniam aliqua esse amet veniam enim export quid quid veniam aliqua eram noster malis nulla duis fugiat culpa esse aute nulla ipsum velit export irure minim illum fore</p>
            </div>
            <div class="owl-carousel testimonials-carousel">

                <div class="testimonial-item">
                <p>
                    <img src="img/quote-sign-left.png" class="quote-sign-left" alt="">
                    Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.
                    <img src="img/quote-sign-right.png" class="quote-sign-right" alt="">
                </p>
                <img src="img/testimonial-1.jpg" class="testimonial-img" alt="">
                <h3>Saul Goodman</h3>
                <h4>Ceo &amp; Founder</h4>
                </div>

                <div class="testimonial-item">
                <p>
                    <img src="img/quote-sign-left.png" class="quote-sign-left" alt="">
                    Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.
                    <img src="img/quote-sign-right.png" class="quote-sign-right" alt="">
                </p>
                <img src="img/testimonial-2.jpg" class="testimonial-img" alt="">
                <h3>Sara Wilsson</h3>
                <h4>Designer</h4>
                </div>

                <div class="testimonial-item">
                <p>
                    <img src="img/quote-sign-left.png" class="quote-sign-left" alt="">
                    Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.
                    <img src="img/quote-sign-right.png" class="quote-sign-right" alt="">
                </p>
                <img src="img/testimonial-3.jpg" class="testimonial-img" alt="">
                <h3>Jena Karlis</h3>
                <h4>Store Owner</h4>
                </div>

                <div class="testimonial-item">
                <p>
                    <img src="img/quote-sign-left.png" class="quote-sign-left" alt="">
                    Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.
                    <img src="img/quote-sign-right.png" class="quote-sign-right" alt="">
                </p>
                <img src="img/testimonial-4.jpg" class="testimonial-img" alt="">
                <h3>Matt Brandon</h3>
                <h4>Freelancer</h4>
                </div>

                <div class="testimonial-item">
                <p>
                    <img src="img/quote-sign-left.png" class="quote-sign-left" alt="">
                    Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.
                    <img src="img/quote-sign-right.png" class="quote-sign-right" alt="">
                </p>
                <img src="img/testimonial-5.jpg" class="testimonial-img" alt="">
                <h3>John Larson</h3>
                <h4>Entrepreneur</h4>
                </div>

            </div>

        </div>
    </section><!-- #testimonials -->

    <!--==========================
      Contact Section
    ============================-->
    <section id="contact" class="wow fadeInUp">
      <div class="container">
        <div class="section-header">
          <h2>Contact Us</h2>
          <p>Sed tamen tempor magna labore dolore dolor sint tempor duis magna elit veniam aliqua esse amet veniam enim export quid quid veniam aliqua eram noster malis nulla duis fugiat culpa esse aute nulla ipsum velit export irure minim illum fore</p>
        </div>

        <div class="row contact-info">

          <div class="col-md-4">
            <div class="contact-address">
              <i class="ion-ios-location-outline"></i>
              <h3>Address</h3>
              <address>Camp,Abeokuta.Ogun State, Nigeria.</address>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-phone">
              <i class="ion-ios-telephone-outline"></i>
              <h3>Phone Number</h3>
              <p><a href="tel:+2349066685702">+234 9066 6857 02</a></p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-email">
              <i class="ion-ios-email-outline"></i>
              <h3>Email</h3>
              <p><a href="mailto:info@example.com">support@ogdam.com</a></p>
            </div>
          </div>

        </div>
      </div>

      <div class="container mb-4">
        <iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d7916.862982549558!2d3.4318005225864616!3d7.1915070292316345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x103a363bcdd152df%3A0xf3ab70233638c6ec!2sCamp%2C+Abeokuta!3m2!1d7.194497999999999!2d3.4359531!5e0!3m2!1sen!2sng!4v1564561313169!5m2!1sen!2sng" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>


      <div class="container">
        <div class="form">
          <div id="sendmessage">Your message has been sent. Thank you!</div>
          <div id="errormessage"></div>
          <form action="" method="post" role="form" class="contactForm">
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                <div class="validation"></div>
              </div>
              <div class="form-group col-md-6">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                <div class="validation"></div>
              </div>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
              <div class="validation"></div>
            </div>
            <div class="form-group">
              <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
              <div class="validation"></div>
            </div>
            <div class="text-center"><button type="submit">Send Message</button></div>
          </form>
        </div>

      </div>
    </section><!-- #contact -->

  </main>

  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>Ogdams</strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!--
          All the links in the footer should remain intact.
          You can delete the links only if you purchased the pro version.
          Licensing information: https://bootstrapmade.com/license/
          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Reveal
        -->
        Designed by <a href="https://facebook.com/9jaloads">Redhoster</a>
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="\home/lib/jquery/jquery.min.js"></script>
  <script src="\home/lib/jquery/jquery-migrate.min.js"></script>
  <script src="\home/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="\home/lib/easing/easing.min.js"></script>
  <script src="\home/lib/superfish/hoverIntent.js"></script>
  <script src="\home/lib/superfish/superfish.min.js"></script>
  <script src="\home/lib/wow/wow.min.js"></script>
  <script src="\home/lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="\home/lib/magnific-popup/magnific-popup.min.js"></script>
  <script src="\home/lib/sticky/sticky.js"></script>

  <!-- Contact Form JavaScript File -->
  <script src="contactform/contactform.js"></script>

  <!-- Template Main Javascript File -->
  <script src="\home/js/main.js"></script>

</body>
</html>
