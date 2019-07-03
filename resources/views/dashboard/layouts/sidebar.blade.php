<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/images/avatar/{{ Auth::user()->avatar }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
{{--       <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form --> --}}
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li><a href="{{ route('wallet.withdraw') }}"><i class="fa fa-money"></i> <span>Withdraw</span></a></li>
        <li><a href="{{ route('wallet.fund') }}"><i class="fa fa-google-wallet"></i> <span>Fund Wallet</span></a></li>
        <li><a href="{{ route('airtime.topup') }}"><i class="fa fa-volume-control-phone"></i> <span>Airtime Topup</span></a></li>
        <li><a href="{{ route('data.buy') }}"><i class="fa fa-wifi"></i> <span>Buy Data</span></a></li>
        <li><a href="{{ route('airtime.cash') }}"><i class="fa fa-money text-red"></i> <span>Airtime To Cash</span></a></li>
        <li><a href="{{ route('airtime.swap') }}"><i class="fa fa-circle-o text-red"></i> <span>Airtime Swap</span></a></li>
        <li><a href="{{ route('coins') }}"><i class="glyphicon glyphicon-bitcoin"></i> <span>Buy | Sell Coins</span></a></li>
        <li><a href="{{ route('sms.bulk') }}"><i class="glyphicon glyphicon-envelope"></i> <span>Bulk Sms</span></a></li>
        <li><a href="{{ route('bills') }} "><i class="fa fa-credit-card custom"></i> <span>Pay Bills</span></a></li>
        <li>
            <a href="{{ route('messages.inbox') }}">
              <i class="fa fa-envelope"></i> <span>Inbox</span>
              <span class="pull-right-container">
                <small class="label pull-right bg-yellow">12</small>
                <small class="label pull-right bg-green">16</small>
                <small class="label pull-right bg-red">5</small>
              </span>
            </a>
        </li>
        <li><a href="{{ route('user.profile') }}"><i class="fa fa-wrench"></i> <span>Account Settings</span></a></li>
        <li><a href="{{ route('user.transactions') }}"><i class="fa fa-gears"></i> <span>Transactions</span></a></li>
        <li><a href="{{ route('user.logout') }}"><i class="fa fa-power-off"></i> <span>Logout</span></a></li>



    </section>
    <!-- /.sidebar -->
  </aside>
