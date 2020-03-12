<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <title>{{ strtoupper( config('constants.site.name')) }}</title>
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

  @if($faq)
    <style>
        .fa {
            float: right;
        }
    </style>
  @endif

<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src="{{ config('constants.livechat.tawk') }}";
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
</script>
<!--End of Tawk.to Script-->

</head>

<body id="body">

  <!--==========================
    Top Bar
  ============================-->
  <section id="topbar" class="d-none d-lg-block">
    <div class="container clearfix">
      <div class="contact-info float-left">
        <!--<i class="fa fa-envelope-o"></i> <a href="mailto:{{ config('constants.site.email') }}"></a> -->
        <i class="fa fa-telegram"></i> <a href="{{ config('constants.site.telegram') }}">Chat with us on Telegram</a>
      </div>
      <div class="social-links float-right">
        <!-- <a href="{{ config('constants.site.twitter') }}" class="twitter"><i class="fa fa-twitter"></i></a> -->
        <a href="{{ config('constants.site.telegram') }}" class="telegram"><i class="fa fa-telegram"></i></a>
       <!--<a href="{{ config('constants.site.instagram') }}" class="instagram"><i class="fa fa-instagram"></i></a> -->
        <!--<a href="{{ config('constants.site.google') }}" class="google-plus"><i class="fa fa-google-plus"></i></a> -->
        <a href="{{ config('constants.site.facebook') }}" class="facebook"><i class="fa fa-facebook"></i></a>
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
          <li><a href="{{ config('constants.api.url') }}" target="__bank">API</a></li>
          <li><a href="{{ route('faq') }}">FAQ's</a></li>
          <li><a href="#contact">Contact</a></li>
          <li><a href="#dataPlans">Data Plans</a></li>
          <li><a href="{{ route('user.login') }}#signup">Register</a></li>
          <li><a href="{{ route('user.login') }}">Login</a></li>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->

  <!--==========================
    Intro Section
  ============================-->
  @if(!$faq)
        {{-- <section id=""> --}}

            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="\home/img/intro-carousel/1.jpg" alt="First slide">
                        <div class="carousel-caption visible-xs">
                            <div class="col-xs-12 col-sm-6 visible-xs">
                                <a href="{{ route('user.login') }}" class="bt btn-get-started">Login</a>
                            </div>
                            <div class="col-xs-12 col-sm-6 visible-xs">
                                <a href="{{ route('user.login').'#signup' }}" class="bt btn-projects">Get Started</a>
                            </div>
                            <p>...</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="\home/img/intro-carousel/2.jpg" alt="Second slide">
                        <div class="carousel-caption visible-xs">
                            <div class="col-xs-12 col-sm-6 visible-xs">
                                <a href="{{ route('user.login') }}" class="bt btn-get-started">Login</a>
                            </div>
                            <div class="col-xs-12 col-sm-6 visible-xs">
                                <a href="{{ route('user.login').'#signup' }}" class="bt btn-projects">Get Started</a>
                            </div>
                            <p>...</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="\home/img/intro-carousel/3.jpg" alt="Third slide">
                        <div class="carousel-caption visible-xs">
                            <div class="col-xs-12 col-sm-6 visible-xs">
                                <a href="{{ route('user.login') }}" class="bt btn-get-started">Login</a>
                            </div>
                            <div class="col-xs-12 col-sm-6 visible-xs">
                                <a href="{{ route('user.login').'#signup' }}" class="bt btn-projects">Get Started</a>
                            </div>
                            <p>...</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="\home/img/intro-carousel/4.jpg" alt="First slide">
                        <div class="carousel-caption visible-xs">
                            <div class="col-xs-12 col-sm-6 visible-xs">
                                <a href="{{ route('user.login') }}" class="bt btn-get-started">Login</a>
                            </div>
                            <div class="col-xs-12 col-sm-6 visible-xs">
                                <a href="{{ route('user.login').'#signup' }}" class="bt btn-projects">Get Started</a>
                            </div>
                            <p>...</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="\home/img/intro-carousel/5.jpg" alt="Second slide">
                        <div class="carousel-caption visible-xs">
                            <div class="col-xs-12 col-sm-6 visible-xs">
                                <a href="{{ route('user.login') }}" class="bt btn-get-started">Login</a>
                            </div>
                            <div class="col-xs-12 col-sm-6 visible-xs">
                                <a href="{{ route('user.login').'#signup' }}" class="bt btn-projects">Get Started</a>
                            </div>
                            <p>...</p>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            {{-- <h2>Making <span>your ideas</span><br>happen!</h2> --}}
            {{-- <div>
                <a href="{{ route('user.login') }}" class="btn-get-started scrollto">Get Started</a>
                <a href="{{ route('user.login') }}#signup" class="btn-projects scrollto">Sign Up</a>
            </div>
            </div>

            <div id="intro-carousel" class="owl-carousel" >
            <div class="item" style="background-image: url('\home/img/intro-carousel/1.jpg'); background-size:auto; "></div>
            <div class="item" style="background-image: url('\home/img/intro-carousel/2.jpg'); background-size:auto; "></div>
            <div class="item" style="background-image: url('\home/img/intro-carousel/3.jpg'); background-size:auto; "></div>
            <div class="item" style="background-image: url('\home/img/intro-carousel/4.jpg'); background-size:auto; "></div>
            <div class="item" style="background-image: url('\home/img/intro-carousel/5.jpg'); background-size:auto; "></div> --}}

        {{-- </section> --}}

    @endif

  <main id="main">
    @if($faq)
    <div class="container mt-5">
        <div class="col-md-10 mx-auto">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            1. How can I fund my Wallet? <i class="accordion_icon fa fa-plus"></i>
                        </a>
                    </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        You can fund your wallet using any of our three payment means.
                        <ol>
                            <li>Online Payment with your ATM card details via Pay stack Payment Gateway.</li>
                            <li>Bank payment.</li>
                            <li>Payment with airtime.(Using the Airtime To Cash form)</li>                                </li>
                        </ol>
                        <p>STEP 1: Log In to your account(Create an account if you haven't)</p>
                        <p>STEP 2: Click on the toggle menu at the Top Left corner.</p>
                        <p>STEP 3: Click on "Fund Wallet".</p>
                        <p>STEP 4: Select your Payment Method and fill in the necessary details.</p>
                    </div>
                    </div>
                </div>
                <div class="panel panel-p">
                    <div class="panel-heading" role="tab" id="headingTwo">
                    <h4 class="panel-title">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            2. How can I purchase/Vend Data?<i class="accordion_icon fa fa-plus"></i>
                        </a>
                    </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="panel-body">
                        <p>STEP 1: Fund your wallet(If your balance is not sufficient enough)</p>
                        <p>STEP 2: Go to the Toggle Menu and select "Buy Data".</p>
                        <p>STEP 3: Select Network Type and fill the data order form.</p>
                    </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingThree">
                        <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                3. Can I share the data I buy from you with another line? <i class="accordion_icon fa fa-plus"></i>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                        <div class="panel-body">
                                You can only share Glo data plans.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingFour">
                        <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                4. How can I be your agent? <i class="accordion_icon fa fa-plus"></i>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                        <div class="panel-body">
                                You can become our Agent, by retailing our products to others. Thereby, making profit. Just make sure your wallet is funded for any purchase.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingFive">
                        <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                5. Can I send airtime to you for data bundle? <i class="accordion_icon fa fa-plus"></i>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                        <div class="panel-body">
                            Yes, you can, but you firstly have to fund your account with airtime. Kindly fill the "Airtime To Cash" form.- "Charges Apply"
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingSix">
                        <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                6. Are your data plans legit? <i class="accordion_icon fa fa-plus"></i>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
                        <div class="panel-body">
                            Yea, we are third party data vendors. We buy in bulk from network providers and resell.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingSeven">
                        <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                7. Is your data plan compatible with all devices? <i class="accordion_icon fa fa-plus"></i>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
                        <div class="panel-body">
                            Yes, it is compatible with all devices.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingEight">
                        <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                8. How do I check data balance? <i class="accordion_icon fa fa-plus"></i>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseEight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEight">
                        <div class="panel-body">
                                <p>Data balance code:</p>

                                MTN => *461*4# <br>
                                9mobile => *228# <br>
                                Glo=> *127*0# <br>
                                Airtel=> *140# <br>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingNine">
                        <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                9. Hope the data won't get exhausted quickly or disappear?<i class="accordion_icon fa fa-plus"></i>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseNine" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingNine">
                        <div class="panel-body">
                                <p>Our data plans are sourced from Network providers. Therefore, consumption rate is similar to the data you get directly from them(i.e data charges are based on usage).</p>
                                <p>We suggest you kindly do the following to avoid unnecessary data depletion: </p>
                                <ol>
                                    <li>Restrict background data</li>
                                    <li>Use data saving browser </li>
                                    <li>Compress videos before streaming </li>
                                    <li>Turn off data when not in use</li>
                                </ol>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTen">
                        <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                                10. How am I sure you that I won't be swindled (scammed)?<i class="accordion_icon fa fa-plus"></i>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTen">
                        <div class="panel-body">
                            <p>We've being in business for years and have made reputation from our happy clients. We love to keep feedbacks. Hence, you can check our testimonials page for people's comment about us.</p>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingEleven">
                        <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                                11. What if my order has been approved, but not yet received?<i class="accordion_icon fa fa-plus"></i>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseEleven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEleven">
                        <div class="panel-body">
                            <p>Sincere apologies about that. We regret the inconvenience caused. Kindly reach out to us on <a href="https://www.t.me/ogdams">Telegram</a> or email <a href="mailto:support@ogdams.com">support@ogdams.com</a> with the order details.</p>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTwelve">
                        <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
                                12. What are the products/services you offer?<i class="accordion_icon fa fa-plus"></i>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwelve" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwelve">
                        <div class="panel-body">
                            <p>We offer the best deals in Internet Data Plans, Airtime To cash, VTU, Electricity Bill Payment, GOtv, DStv & Startimes Subscriptions, Bulk SMS. etc.</p>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingThirteen">
                        <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen">
                                13. What's your working period?<i class="accordion_icon fa fa-plus"></i>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseThirteen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThirteen">
                        <div class="panel-body">
                            <p>All our products are available 24/7, but our customer support is available as follows: Mon -Saturday : 8am - 8pm, Sunday: 1pm-8pm.</p>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingFourteen">
                        <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFourteen" aria-expanded="false" aria-controls="collapseFourteen">
                                14. Can I communicate with you in case I have any enquiry?<i class="accordion_icon fa fa-plus"></i>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseFourteen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFourteen">
                        <div class="panel-body">
                            <p>Yes, you can reach out to us on  <a href="https://www.t.me/ogdams">Telegram</a> or email <a href="mailto=support@ogdams.com">support@ogdams.com</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(!$faq)
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
                    We offer the best deals in Internet Data Subscriptions, Airtime To Cash, Airtime(VTU), CableTV (DStv, GOtv & Startimes), Electricity Bill Payment etc
                </h3>

                <ul>
                <li><i class="ion-android-checkmark-circle"></i> 100 % automated secure services.</li>
                <li><i class="ion-android-checkmark-circle"></i> Instant and secure wallet funding.</li>
                <li><i class="ion-android-checkmark-circle"></i> Over 170,000 + active users.</li>
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
            <p>Airtime To Cash</p>
            <p>Airtime(VTU)</p>
            <p>CableTV Subscription</p>
            <p>Electricity Payment</p>
            <p>Bulk SMS</p>

            </div>

            <div class="row">

            <div class="col-lg-6">
                <div class="box wow fadeInLeft text-center">
                    <div class="icon block-center">
                    <img class="img-fluid mx-auto" src="\home/img/services/bulk-sms.png">
                    </div>
                <h4 class="title"><a href="">Send Bulk SMS</a></h4>
                <p class="description">
                        Send Bulk SMS to any Number In Nigeria for as low as ₦2.00 per unit. Our Bulk SMS service also delivers SMS to numbers on DND list.
                </p>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="box wow fadeInRight text-center">
                <div class="icon">
                    <img class="img-fluid mx-auto" src="\home/img/services/data-plan.jpg">
                </div>
                <h4 class="title"><a href="">Buy Data Bundle</a></h4>
                <p class="description">Start enjoying this very low rates for your internet browsing databundle on all Networks. We've got you covered</p>
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
                        We realise that we can’t walk this road alone. So, we have partnered with all these incredible brands to create seamless user experience just for you.</p>
                </div>
                @php
                    $partners = collect([
                        'networks/9mobile.png', 'networks/airtel.png', 'networks/glo.png', 'networks/mtn.png','bills/electricity/ekedc.png', 'bills/electricity/ikedc.png',
                        'bills/internet/smile.png', 'bills/internet/spectranet.png', 'bills/misc/waec.png', 'bills/tv/dstv.jpg', 'bills/tv/gotv.jpg', 'bills/tv/startimes.jpeg',
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
                    <h2>Testimonies</h2>
                    <p>See what our Customers are saying about us:</p>
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
                <address>{{ config('constants.site.address') }}</address>
                </div>
            </div>

            <div class="col-md-4">
                <div class="contact-phone">
                <i class="ion-ios-telephone-outline"></i>
                <h3>Phone Number</h3>
                <p><a href="tel:{{ preg_replace('/\s+/', '',config('constants.site.phone')) }}">{{ config('constants.site.phone') }}</a></p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="contact-email">
                <i class="ion-ios-email-outline"></i>
                <h3>Email</h3>
                <p><a href="mailto:{{ config('constants.site.email') }}">{{ config('constants.site.email') }}</a></p>
                </div>
            </div>

            </div>
        </div>

        <div class="container mb-4">
            <iframe src="{{ config('constants.site.googleMap') }}" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
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
    @endif

  </main>

  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; 2020 Copyright <strong>{{ config('constants.site.bussinessName') }}</strong>. All Rights Reserved
      </div>

    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="\home/lib/jquery/jquery.min.js"></script>
  <script src="\home/lib/jquery/jquery-migrate.min.js"></script>
  <script src="\home/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  @if(!$faq)
    <script src="\home/lib/easing/easing.min.js"></script>
    <script src="\home/lib/superfish/hoverIntent.js"></script>
    <script src="\home/lib/superfish/superfish.min.js"></script>
  @endif
  <script src="\home/lib/wow/wow.min.js"></script>
  @if(!$faq)
    <script src="\home/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="\home/lib/magnific-popup/magnific-popup.min.js"></script>
    <!-- Contact Form JavaScript File -->
    <script src="\home/lib/contactform/contactform.js"></script>
  @endif
    <script src="\home/lib/sticky/sticky.js"></script>



  <!-- Template Main Javascript File -->
  <script src="\home/js/main.js"></script>

</body>
</html>
