@php

$unReadMessages = Auth::user()->messages->where('read',0)->sortByDesc('id');

@endphp

<header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">{{ $unReadMessages->count() }}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">
                  You have {{ $unReadMessages->count() }} messages
              </li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">




                @foreach ($unReadMessages as $unReadMessage)
                  <!-- start message -->
                  <li>
                    <a href="{{ route('messages.message',$unReadMessage->id) }}">
                      <div class="pull-left">
                        <img src="\dist/img/{{ Auth::user()->avatar }}" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        {{ $unReadMessage->sender->name }}
                        <small><i class="fa fa-clock-o"></i> {{ $unReadMessage->created_at->diffForHumans() }}</small>
                      </h4>
                      <p> {{ $unReadMessage->content }} </p>
                    </a>
                  </li>
                  <!-- end message -->
                @endForeach

                </ul>
              </li>
              <li class="footer"><a href="{{ route('messages.inbox') }}">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs">@naira(Auth::user()->balance)</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-12 text-center">
                    Balance : @naira(Auth::user()->balance)
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>

    </nav>
  </header>
