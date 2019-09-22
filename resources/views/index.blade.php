<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <title>{{ strtoupper($app->name) }}</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link rel="shortcut icon" href="\favicon.ico" type="image/x-icon">
  <link rel="icon" href="\favicon.ico" type="image/x-icon">
  <meta name="msapplication-TileColor" content="#1ABB9C">
  <meta name="theme-color" content="#1ABB9C">

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
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>

<body id="body">

  <!--==========================
    Top Bar
  ============================-->
  <section id="topbar" class="d-none d-lg-block">
    <div class="container clearfix">
      <div class="contact-info float-left">
        <i class="fa fa-envelope-o"></i> <a href="mailto:{{ $app->email }}"></a>
        <i class="fa fa-phone"></i> {{ $app->phone }}
      </div>
      <div class="social-links float-right">
        <a href="{{ $app->twitter }}" class="twitter"><i class="fa fa-twitter"></i></a>
        <a href="{{ $app->facebook }}" class="facebook"><i class="fa fa-facebook"></i></a>
        <a href="{{ $app->instagram }}" class="instagram"><i class="fa fa-instagram"></i></a>
        <a href="{{ $app->google }}" class="google-plus"><i class="fa fa-google-plus"></i></a>
        <a href="{{ $app->linkedin }}" class="linkedin"><i class="fa fa-linkedin"></i></a>
      </div>
    </div>
  </section>

  <!--==========================
    Header
  ============================-->
  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-3">
            <h1><img src="\home/img/logo.jpg" class="img-responsive">{{-- <a href="#body" class="scrollto">G<span>DAM</span></a></h1>--}}
            <!-- Uncomment below if you prefer to use an image logo -->
        </div>
            {{-- <a href="#body"><img src="\home/img/logo.jpg" alt="" title="" /></a> --}}
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="#body">Home</a></li>
          <li><a href="#about">About Us</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#contact">Contact</a></li>
          <li><a href="#dataPlans">DataPlans</a></li>
          <li><a href="{{ route('user.login') }}#signup">Register</a></li>
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
      {{-- <h2>Making <span>your ideas</span><br>happen!</h2> --}}
      <div>
        <a href="{{ route('user.login') }}" class="btn-get-started scrollto">Get Started</a>
        <a href="{{ route('user.login') }}#signup" class="btn-projects scrollto">Sign Up</a>
      </div>
    </div>

    <div id="intro-carousel" class="owl-carousel" >
      <div class="item" style="background-image: url('\home/img/intro-carousel/1.jpg');"></div>
      <div class="item" style="background-image: url('\home/img/intro-carousel/2.jpg');"></div>
      <div class="item" style="background-image: url('\home/img/intro-carousel/3.jpg');"></div>
      <div class="item" style="background-image: url('\home/img/intro-carousel/4.jpg');"></div>
      <div class="item" style="background-image: url('\home/img/intro-carousel/5.jpg');"></div>
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
            <h2>Why choose us? </h2>
            <h3>
                Ogdams Technologies offers the best deals in Internet Data Subscriptions, Airtime To Cash, Airtime(VTU), CableTV (DStv, GOtv & Startimes), Electricity Bill Payemnt etc
            </h3>

            <ul>
              <li><i class="ion-android-checkmark-circle"></i> 100 % automated secure services.</li>
              <li><i class="ion-android-checkmark-circle"></i> Instant and secure wallet funding.</li>
              <li><i class="ion-android-checkmark-circle"></i> Over 7,000 + active users.</li>
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
          <p>Internet Data Subscription</p>
          <p>Airtime(VTU)</p>
          <p>Airtime To Cash</p>
          <p>CableTV Subscription</p>
          <p>Electricity Payment</p>
          <p>Bulk SMS</p>
          <!--p>
            Ogdams Technologies offers the best deals in Internet Data Subscriptions, Airtime To cash, Airtime(VTU), CableTV (DStv, GOtv & Startimes), Electricity Bill Payemnt etc
          </p-->
        </div>

        <div class="row">

          <div class="col-lg-6">
            <div class="box wow fadeInLeft text-center">
                <div class="icon block-center">
                  <img class="img-fluid mx-auto" src="\home/img/services/bulk-sms.png">
                </div>
              <h4 class="title"><a href="">Send Bulk SMS</a></h4>
              <p class="description">
                    Send Bulk SMS to any number In Nigeria for as low as ₦2.00 per unit. Our Bulk SMS service also delivers SMS to numbers on DND list.
              </p>
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
              <p class="description">
                    Instant recharge of your DStv, GOtv and Startimes.
              </p>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="box wow fadeInRight text-center" data-wow-delay="0.2s">
              <div class="icon">
                <img class="img-fluid mx-auto" src="\home/img/services/airtime-cash.png">
              </div>
              <h4 class="title"><a href="">Airtime To Cash</a></h4>
              <p class="description">
                Convert your excess MTN, Airtel, Glo and 9mobile Airtime to Cash and get paid instantly.
                </p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- #services -->

    <!--==========================
      Call To Action Section
    ============================-->
    {{-- <section id="call-to-action" class="wow fadeInUp">
      <div class="container">
        <div class="row">
          <div class="col-lg-9 text-center text-lg-left">
            <h3 class="cta-title">Call To Action</h3>
            <p class="cta-text"> Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          </div>
          <div class="col-lg-3 cta-btn-container text-center">
            <a class="cta-btn align-middle" href="#"></a>
          </div>
        </div>

      </div>
    </section><!-- #call-to-action --> --}}

    <!--==========================
      Pricing tables
    ============================-->
    <section id="dataPlans" class="wow fadeInUp">
      <div class="container">
        <div class="section-header">
          <h2>Data Plans</h2>
        </div>
        <div class="row">
            @foreach ($dataPlans as $networks)

                @if($loop->iteration > 4 ) @continue @endif

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
    </section><!-- #dataPlans -->

    <!--==========================
      Our Partners
    ============================-->
    <section id="clients" class="wow fadeInUp">
        <div class="container">
            <div class="section-header">
            <h2>Our Partners</h2>
            <p>
                    We realise that we can’t walk this road alone. So, we have partnered with all these incredible brands to create a seamless user experience for you.</p>
            </div>
            @php
                $partners = collect([
                    'networks/9mobile.png', 'networks/airtel.png', 'networks/glo.png', 'networks/mtn.png','bills/electricity/ekedc.png', 'bills/electricity/ikedc.png',
                    'bills/internet/smile.png', 'bills/internet/spectranet.png', 'bills/misc/waec.png', 'bills/tv/dstv.jpg', 'bills/tv/gotv.jpg', 'bills/tv/startimes.jpg',
                ]);
                //$partners = shuffle($partners);
            @endphp

            <div class="owl-carousel clients-carousel">
                @foreach ($partners->shuffle() as $partner)
                    <img class="mx-auto" src="\images/{{ $partner }}">
                @endforeach
            </div>

        </div>
    </section><!-- #clients -->

    <!--==========================
      Testimonials Section
    ============================-->
    @if($testimonials->count())
        <section id="testimonials" class="wow fadeInUp">
            <div class="container">
                <div class="section-header">
                <h2>Testimonials</h2>
                <p>Hear what about customers/clients are saying about us</p>
                </div>
                <div class="owl-carousel testimonials-carousel">
                    @foreach ($testimonials as $item)
                        <div class="testimonial-item">
                        <p>
                            <img src="\home/img/quote-sign-left.png" class="quote-sign-left" alt="">
                                {{ $item->testimony }}
                            <img src="\home/img/quote-sign-right.png" class="quote-sign-right" alt="">
                        </p>
                        <img src="\images/avatar/{{ $item->user->avatar }}" class="testimonial-img" alt="user image">
                        <h3>{{ ucwords($item->user->name) }}</h3>
                        </div>
                    @endforeach
                </div>

            </div>
        </section><!-- #testimonials -->
    @endif

    <!--==========================
      Contact Section
    ============================-->
    <section id="contact" class="wow fadeInUp">
      <div class="container">
        <div class="section-header">
          <h2>Contact Us</h2>
          <p>Have enquiries? Please contact us.</p>
        </div>
        <div class="row contact-info">

          <div class="col-md-4">
            <div class="contact-address">
              <i class="ion-ios-location-outline"></i>
              <h3>Address</h3>
              <address>{{ $app->address }}</address>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-phone">
              <i class="ion-ios-telephone-outline"></i>
              <h3>Phone Number</h3>
              <p><a href="tel:{{ preg_replace('/\s+/', '',$app->phone) }}">{{ $app->phone }}</a></p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-email">
              <i class="ion-ios-email-outline"></i>
              <h3>Email</h3>
              <p><a href="mailto:{{ $app->email }}">{{ $app->email }}</a></p>
            </div>
          </div>

        </div>
      </div>

      <div class="container mb-4">
        <iframe src="{{ $app->googleMap }}" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
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
        &copy; Copyright <strong>{{ $app->bussinessName }}</strong>. All Rights Reserved
      </div>
      <script type="text/javascript">
        document.write(unescape('%3c%64%69%76%20%63%6c%61%73%73%3d%22%63%72%65%64%69%74%73%22%20%73%74%79%6c%65%3d%22%66%6f%6e%74%2d%73%69%7a%65%3a%20%31%38%70%78%3b%22%3e%0d%0a%20%20%20%20%20%20%20%20%44%65%73%69%67%6e%65%64%20%62%79%20%3c%61%20%68%72%65%66%3d%22%68%74%74%70%73%3a%2f%2f%66%61%63%65%62%6f%6f%6b%2e%63%6f%6d%2f%39%6a%61%6c%6f%61%64%73%22%3e%52%65%64%68%6f%73%74%65%72%3c%2f%61%3e%0d%0a%20%20%20%20%20%20%3c%2f%64%69%76%3e'));
      </script>
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
