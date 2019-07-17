@extends('users.layouts.master')

@section('title')
    | Login
@endsection

@section('bodyClass')
    register-page
@endsection

@section('content')
    <div class="register-box">
        <div class="register-logo">
          <a href="../../index2.html"><b>Admin</b>LTE</a>
        </div>

        <div class="register-box-body">
            @include('errors')
            @if(session('response'))
                <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('response') }}
                </div>
            @else
                <p class="login-box-msg">Register a new membership</p>
            @endif

          <form action="{{ route('user.register') }}" method="post">
            @csrf
            <div class="form-group has-feedback">
              <input type="text" name="name" class="form-control" placeholder="Full name">
              <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
              <input type="email" name="email" class="form-control" placeholder="Email">
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
              <input type="password" name="password" class="form-control" placeholder="Password">
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
              <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password">
              <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            </div>
            <div class="row">
              <div class="col-xs-8">
                <div class="checkbox icheck">
                  <label>
                    <input type="checkbox" name="terms" required > I agree to the <a href="#">terms</a>
                  </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
              </div>
              <!-- /.col -->
            </div>
          </form>

          <div class="social-auth-links text-center">
            <p>- OR -</p>
            <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
              Facebook</a>
            <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
              Google+</a>
          </div>

          <a href="{{ route('user.login') }}" class="text-center">I already have a membership</a>
        </div>
        <!-- /.form-box -->
      </div>
      <!-- /.register-box -->
@endSection

@section('scripts')

@endsection
