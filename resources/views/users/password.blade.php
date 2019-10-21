@extends('users.layouts.master')

@section('title')
    {{ config('constants.site.name') }} | Login
@endsection

@section('bodyClass')
    login-page
@endsection

@section('content')
    <div>
        <a class="hiddenanchor" id="index"></a>
        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    @include('errors')

                    @if(session('response'))
                        <div class="alert alert-{{ session('status') ? 'success' : 'danger' }} alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('response') }}
                        </div>
                    @endif
                    @isset($response)
                        <div class="alert alert-{{ $response['status'] ? 'success' : 'danger' }} alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ $response['message'] }}
                        </div>
                    @endif

                    <form method="post" action="{{ route('user.password.reset.change', ['email' => $email, 'token' => $token ]) }}">
                        @csrf @method('patch')
                        <a href="{{ route('index') }}"><img src="\home/img/logo.jpg" class="img-fluid"></a>
                        <h1>Change Password</h1>
                        <div>
                            <input type="password" name="password" class="form-control" placeholder="Password" required="" />
                        </div>
                        <div>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password" required="" />
                        </div>
                        <div>
                            <a class="reset_pass text-15" href="#">Lost your password?</a>
                            <button class="btn btn-rounded btn-success submit pull-right" type="submit">Change Password</button>
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <p class="change_link text-17"> <a href="{{ route('user.login') }}" class="to_register text-17"> Login Account</a> |
                                <a href="{{ route('user.register') }}" class="to_register text-17"> Create Account </a>
                            </p>

                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <h1><a href="{{ route('index') }}">{{ config('constants.site.name') }}</a></h1>
                                <p class="text-15">{{ config('constants.site.about') }}</p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
@endSection

