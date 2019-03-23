@extends('dashboard.layouts.master')

    @section('content-header')
        <section class="content-header">
            <h1>Sell Coins</h1>
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
                            <h3 class="box-title">Sell Coin</h3>

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
                                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                                        <form id="coin-option-form" class="form-horizontal" action="{{ route('coins.sell') }}" method="post">
                                            @csrf
                                            <br/>
                                            <br/>
                                            <div class="otherFields">
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">{{ ucwords($coin->name) }} Wallet Address</label>
                                                    <div class="col-sm-10 form-grouping">
                                                        <input type="text" class="form-control" name="wallet" placeholder="Pls Enter {{ ucwords($coin->name) }} Wallet Address">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Amount($)</label>
                                                    <div class="col-sm-10 form-grouping">
                                                        <input type="text" class="form-control" name="amount" placeholder="Pls Enter Amount">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-3">
                                                    <button id="submit" class="btn bg-purple btn-flat">Submit</button>
                                                </div>
                                                <div id="loader" style="display: none; text-align: center;">
                                                    <img src="../dist/img/ajax-loader.gif">
                                                </div>
                                                <div id="result"></div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                        <a href="#">
                                            <img class="{{ $coin->name }} img-responsive" src="/images/{{ $coin->image_link }}" alt="{{ $coin->name }}">
                                        </a>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer clearfix">
                        <a href="#" class="btn btn-sm bg-purple btn-flat pull-left">Invest Now</a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Subscriptions</a>
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
        </section>
    @endSection

    @section('scripts')
        @if (session('response'))
            <script>alert('{{ session('response') }}');</script>
        @endif

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
                $('#submit').click(function() {
                    $('#coin-option-form').validate({
                        rules: {
                            amount: {
                                required: true,
                                digit: true
                            }
                        },
                        messages: {
                            amount: {
                                required: "Pls enter an amount.",
                                digit:  "Pls enter a valid amount"
                            }

                        }
                    });
                });
            });

        </script>
    @endSection
