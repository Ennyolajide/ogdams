@extends('dashboard.layouts.master')

    @section('content-header')
        <section class="content-header">
            <h1>Buy coin</h1>
            <ol class="breadcrumb">
                <li>
                    <a href="#"><i class="fa fa-dashboard"></i> Home</a>
                </li>
                <li class="active">{{ $coin->name }}</li>
            </ol>
        </section>
    @endsection

    @section('content')
        <!-- Main content -->
        <section class="content">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-md-12">
                    <!-- TABLE: LATEST ORDERS -->
                    <div class="box box-purple">
                        <div class="box-header with-border">
                            <h3 class="box-title">Buy Coin</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body">
                            <section class="container">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-7 col-lg-7">
                                        <div class="row">
                                            <div class="visible-xs col-xs-7">
                                                <h3 class="visible-xs text-danger"><strong>Rate : {{ $coin->buy_rate + $rate }} / $</strong></h3>
                                            </div>
                                            <div class="visible-xs col-xs-4">
                                                <a href="#">
                                                    <img class="{{ $coin->name }} img-responsive pull-right" src="/images/{{ $coin->logo }}" alt="{{ $coin->name }}">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="hidden-xs">
                                            <h3 class="text-danger text-center"><strong>Rate : {{ $coin->buy_rate + $rate }} / $</strong></h3>
                                            <br/>
                                        </div>
                                        <form id="coin-option-form" class="form-horizontal" action="{{ route('coins.buy') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="coinId" value="{{ $coin->id }}">
                                            <div class="">
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">{{ ucwords($coin->name) }} Wallet Address</label>
                                                    <div class="col-sm-10 form-grouping">
                                                        <input type="text" class="form-control" name="wallet" placeholder="Pls Enter {{ ucwords($coin->name) }} Wallet Address">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Amount($)</label>
                                                    <div class="col-sm-10 form-grouping">
                                                        <input type="num" id="amount" class="form-control" name="amount" placeholder="Pls Enter Amount($)">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <h3 class="hidden-xs text-center text-primary text-bold">Naira Equivalet : ₦ <span class="localAmount"></span></h3>
                                                    <h4 class="visible-xs text-center text-primary text-bold">Naira Equivalet : ₦ <span class="localAmount"></span></h4>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-3">
                                                    <button id="continue" class="btn bg-purple btn-flat">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="hidden-xs col-sm-4 col-md-5 col-lg-5">
                                        <a href="#">
                                            <img class="{{ $coin->name }} img-responsive" src="/images/{{ $coin->logo }}" alt="{{ $coin->name }}">
                                        </a>
                                    </div>
                                </div>
                            </section>
                        </div>
                         <!-- /.box-body -->
                        @include('dashboard.layouts.errors')
                        <!-- .box-footer -->
                        @include('dashboard.layouts.box-footer')
                        <!-- /.box-footer -->
                    </div>
                <!-- /.box -->
                </div>
            </div>
        </section>
    @endSection

    @section('scripts')
        <script src="/js/jquery-number.min.js"></script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.16.0/jquery.validate.min.js"></script>

        <script>
            $(document).ready(function(){

                $.validator.setDefaults({
                    errorClass: 'help-block',
                    highlight: function (element) {
                        $(element)
                            .closest('.form-grouping')
                            .addClass('has-error');
                    },
                    unhighlight: function (element) {
                        $(element)
                            .closest('.form-grouping')
                            .removeClass('has-error');
                    }
                });
                $('#coin-option-form').validate({
                    rules: {
                        wallet : {
                            required : true,
                            minlength: 26,
                            maxlength: 35
                        },
                        amount: {
                            required: true,
                            digit: true,
                            minlength: 2,
                            maxlength: 5
                        }
                    },
                    messages: {
                        wallet: {
                            required: "Pls enter your '{{ $coin->name }}' wallet address",
                            minlength: $.validator.format("Minimum of {0} characters required."),
                            maxlength: $.validator.format("Maximum {0} characters.")
                        },
                        amount: {
                            required: "Pls enter an amount.",
                            digit:  "Pls enter a valid amount",
                            minlength: $.validator.format("Minimum of {0} characters required."),
                            maxlength: $.validator.format("Maximum {0} characters.")
                        }

                    }
                });

                $('#amount').keyup(function(){
                    $('.localAmount').text($.number($('#amount').val() * '{{ $coin->buy_rate + $rate }}'));
                })


            });

        </script>
    @endSection
