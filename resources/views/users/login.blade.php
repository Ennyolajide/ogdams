@extends('users.layouts.master')

@section('title')
    {{ config('constants.site.name') }} | Login
@endsection

@section('bodyClass')
    login-page
@endsection

@section('content')
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>
        <a class="hiddenanchor" id="reset"></a>

        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    @include('errors')

                    @if(session('response'))
                        <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('response') }}
                        </div>
                    @endif

                    <form method="post" action="{{ route('user.login') }}">
                        @csrf
                        <a href="{{ route('index') }}"><img src="\home/img/logo.jpg" class="img-fluid"></a>
                        <h1>Login</h1>
                        <div>
                            <input type="email" name="email" class="form-control" placeholder="email" required="" />
                        </div>
                        <div>
                            <input type="password" name="password" class="form-control" placeholder="Password" required="" />
                        </div>
                        <div>
                            <a class="reset_pass text-15" href="{{ route('user.password.reset') }}">Lost your password?</a>
                            <button class="btn btn-rounded btn-success submit pull-right" type="submit">Log in</button>
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <p class="change_link text-17">New to <a href="{{ route('index') }}">{{ config('constants.site.name') }}</a>?
                                <a href="#signup" class="to_register text-17"> Create Account </a>
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

            <div id="register" class="animate form registration_form">
                <section class="login_content">
                    @include('errors')

                    @if(session('response'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('response') }}
                        </div>
                    @endif

                    <form action="{{ route('user.register.create') }}" method="post">
                        @csrf
                        <a href="{{ route('index') }}"><img src="\home/img/logo.jpg" class="img-fluid"></a>
                        <h1>Create Account</h1>

                        @if($referrer)
                            <div>
                                <input type="text" value="Referred By {{ ucwords($referrer->name) }}" class="form-control" disabled="true">
                                <input type="hidden" name="referrerId" value="{{ $referrer->wallet_id }}">
                            </div>
                        @else
                            <div>
                                <input type="text" name="referrerId" value="" class="form-control" placeholder="Referrer Wallet Id">
                            </div>
                        @endif

                        <div>
                            <input type="text" name="name" class="form-control" placeholder="Fullname" required="" />
                        </div>
                        <div>
                            <input type="email" name="email" class="form-control" placeholder="Email" required="" />
                        </div>
                        <div>
                            <input type="text" name="phone" class="form-control" placeholder="Phone Number" required=""/>
                        </div>
                        <div>
                            <input type="password" name="password" class="form-control" placeholder="Password" required="" />
                        </div>
                        <div>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password" required="" />
                        </div>
                        <div>
                            <button class="btn btn-success submit" type="submit" >Register</a>
                        </div>
                        <div class="clearfix"></div>

                        <div class="separator">
                            <p class="change_link text-17">Already a member ?
                                <a href="#signin" class="to_register  text-17"> Log in </a>
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

