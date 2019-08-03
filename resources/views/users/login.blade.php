@extends('users.layouts.master')

@section('title')
    Ogdam | Login
@endsection

@section('bodyClass')
    login-page
@endsection

@section('content')
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form method="post" action="{{ route('user.login') }}">
                        @csrf
                        <h1>Login Form</h1>
                        <div>
                            <input type="email" name="email" class="form-control" placeholder="email" required="" />
                        </div>
                        <div>
                            <input type="password" name="password" class="form-control" placeholder="Password" required="" />
                        </div>
                        <div>
                            <a class="reset_pass" href="{{ route('user.passwordReset') }}">Lost your password?</a>
                            <button class="btn btn-default submit pull-right" type="submit">Log in</button>
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <p class="change_link">New to site?
                                <a href="#signup" class="to_register"> Create Account </a>
                            </p>

                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <h1><i class="fa fa-paw"></i> Ogdam</h1>
                                <p>©2019 All Rights Reserved. Ogdam is a business solution website. Privacy and Terms</p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>

            <div id="register" class="animate form registration_form">
                <section class="login_content">
                    <form action="{{ route('user.register') }}" method="post">
                        <h1>Create Account</h1>
                        <div>
                            <input type="text" name="name" class="form-control" placeholder="Fullname" required="" />
                        </div>
                        <div>
                            <input type="email" name="email" class="form-control" placeholder="Email" required="" />
                        </div>
                        <div>
                            <input type="password" class="form-control" placeholder="Password" required="" />
                        </div>
                        <div>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password" required="" />
                        </div>
                        <div>
                            <button class="btn btn-default submit" type="submit" >Register</a>
                        </div>
                        <div class="clearfix"></div>

                        <div class="separator">
                            <p class="change_link">Already a member ?
                            <a href="#signin" class="to_register"> Log in </a>
                            </p>

                            <div class="clearfix"></div>
                            <br />

                            <div>
                                <h1><i class="fa fa-paw"></i> Ogdam</h1>
                                <p>©2019 All Rights Reserved. Ogdam is a business solution website. Privacy and Terms</p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
@endSection

