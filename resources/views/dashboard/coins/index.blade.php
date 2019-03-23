@extends('dashboard.layouts.master')

    @section('content-header')
        <section class="content-header">
            <h1>Transact Coins</h1>
            <ol class="breadcrumb">
                <li>
                    <a href="#"><i class="fa fa-dashboard"></i> Home</a>
                </li>
                <li class="active">Coins</li>
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
                            <h3 class="box-title">Transact Coin</h3>

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
                                        <form id="coin-option-form" class="form-horizontal" action="{{ route('airtime.topup') }}" method="post">
                                            @csrf
                                            <br/>
                                            <div class="form-group" id="choose-wallet-type">
                                                <label for="inputWallet" class="col-sm-2 control-label">network</label>

                                                <div class="col-sm-10">
                                                    <select class="form-control" id="coin" name="network">
                                                        <option value="" disabled selected>Select Coin</option>
                                                        @foreach ($coins as $coin)
                                                            <option value="{{ $coin->id }}">
                                                                {{ ucwords($coin->name) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                            <br/>
                                            <div class="otherFields" style="display:none;">
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Bitcoin Wallet Address</label>
                                                    <div class="col-sm-10 form-grouping">
                                                        <input type="text" class="form-control" name="wallet" placeholder="Pls Enter Bitcoin Wallet Address">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Amount</label>
                                                    <div class="col-sm-10 form-grouping">
                                                        <input type="text" class="form-control" name="amount" placeholder="Pls Enter Phone Number">
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
                                        @foreach ($coins as $coin)
                                            <a href="#">
                                                <img class="{{ $coin->name }} img-responsive" style="display:none;" src="/images/{{ $coin->image_link }}" alt="{{ $coin->name }}">
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </section>
                            <div class="row" id="coinImages">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    @php
                                        $colSize = 12/$coins->count();
                                    @endphp
                                    @foreach ($coins as $coin)
                                        <div class="col-xs-{{ $colSize }} col-sm-{{ $colSize }} col-md-{{ $colSize }} col-lg-{{ $colSize }}">
                                            <a href="#">
                                                <img src="/images/{{ $coin->image_link }}" class="img-responsive" alt="{{ $coin->name }}">
                                            </a>
                                        </div>
                                        @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer clearfix">
                        <a href="invest" class="btn btn-sm bg-purple btn-flat pull-left">Invest Now</a>
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

                $('#coin').change(function() {
                    var coin = $('#coin').val();
                    console.log(coin);

                    if(coin == 1){
                        $('#coinImages,.ethereum').hide();
                        $('.bitcoin,.otherFields').show();
                    }else if(network == 2){
                        $('#coinImages,.bitcoin').hide();
                        $('.ethereum,.otherFields').show();
                    }else{
                        $('.mtn,.bitcoin,.ethereum,.otherFields').hide();
                        $('#coinImages').show();
                    }

                });

                $('#submit').click(function() {
                    $('#coin-option-form').validate({
                        rules: {
                            phone: {
                                required: true,
                                digit: true
                            },
                            amount: {
                                required: true,
                                digit: true
                            }
                        },
                        messages: {
                            phone: {
                                required: "Pls enter phone number.",
                                digit:  "Phone numbers only "
                            },
                            amount: {
                                required: "Pls enter phone number.",
                                digit:  "Phone numbers only "
                            }

                        }
                    });
                });
            });

        </script>
    @endSection
