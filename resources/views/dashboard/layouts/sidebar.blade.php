<div class="col-md-3 left_col">
    <div class="left_col scroll-view">

        <div class="navbar nav_title" style="border: 0;">
            <a href="" class="site_title"><i class="fa fa-paw"></i> <span>Gent Mobile</span></a>
        </div>
        <div class="clearfix"></div>

        <!-- menu prile quick info -->
        <div class="profile">
            <div class="profile_pic">
                <img src="\images/img.jpg" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ Auth::user()->name }}</h2>
            </div>
        </div>
        <!-- /menu prile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a></li>
                    <li><a href="{{ route('wallet.fund') }}"><i class="fa fa-google-wallet"></i> <span>Fund Wallet</span></a></li>
                    <li><a href="{{ route('airtime.topup') }}"><i class="fa fa-volume-control-phone"></i> <span>Airtime Topup</span></a></li>
                    <li><a href="{{ route('data.buy') }}"><i class="fa fa-wifi"></i> <span>Buy Data</span></a></li>
                    {{-- <li><a href="{{ route('coins') }}"><i class="glyphicon glyphicon-bitcoin"></i> <span>Buy | Sell Coins</span></a></li> --}}
                    <li><a href="{{ route('sms.bulk') }}"><i class="glyphicon glyphicon-envelope"></i> <span>Bulk Sms</span></a></li>
                    <li><a href="{{ route('bills') }} "><i class="fa fa-credit-card custom"></i> <span>Pay Bills</span></a></li>
                    {{-- <li>
                        <a href="{{ route('messages.inbox') }}">
                            <i class="fa fa-envelope"></i> <span>Inbox</span>
                            <span class="pull-right-container">
                                <small class="label pull-right bg-yellow">12</small>
                                <small class="label pull-right bg-green"></small>
                                <small class="label pull-right bg-red">5</small>
                            </span>
                        </a>
                    </li> --}}
                    <!--li><a href="#"><i class="fa fa-wrench"></i> <span>Account Settings</span></a></li-->
                   {{--  <li><a href="{{ route('user.transactions') }}"><i class="fa fa-gears"></i> <span>Transactions</span></a></li> --}}
                    <li><a href="{{ route('user.logout') }}"><i class="fa fa-power-off"></i> <span>Logout</span></a></li>
                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->
    </div>
</div>
