@extends('dashboard.layouts.master')

    @section('content-header')
        <section class="content-header">
            <h1>Fund Wallet With Airtime</h1>
            <ol class="breadcrumb">
                <li>
                    <a href="#"><i class="fa fa-dashboard"></i> Home</a>
                </li>
                <li class="active">Fund Wallet With Airtime</li>
            </ol>
        </section>
    @endsection

    @section('content')
        <!-- Main content -->
        <section class="content">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-md-6">
                    <!-- TABLE: LATEST ORDERS -->
                    <div class="box box-purple">
                        <div class="box-header with-border">
                            <h3 class="box-title">Fund Wallet With Airtime</h3>

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
                                    <div class="col-md-4" style="line-height:2;margin-left:15px;">
                                        <br>
                                        <h4 class="text-center">
                                            Kindly transfer the sum of <strong>@naira(session('amount'))</strong> to the phone number below
                                        </h4>
                                        <br>
                                        @if(session('to'))
                                            <h3 class="text-center">{{ session('to') }}</h3>
                                        @endif
                                        <p class="text-center">How to transfer on {{ session('networkName') }} network</p>
                                            <p class="text-center well well-sm no-shadow alert-info" style="margin-top: 10px;">
                                                    MTN Share ’N’ Sell
                                                    <br/>
                                                    Dial: *600*07063637002‬*7056*PIN#
                                                    <br/>
                                                    If you don't have a PIN, to use 1234 as your PIN Dial: *600*0000*1234*1234#

                                            </p>

                                    </div>


                                </div>
                            </section>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                        <!-- TABLE: LATEST ORDERS -->
                        <div class="box box-purple">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fas fa-info-circle"></i>SIDE NOTE:</h3>

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
                                        <div class="col-md-4" style="line-height:2;margin-left:15px;">

                                            {{ @$siteName }} does not automatically deduct airtime from your phone.
                                            You are required to transfer the worth of airtime to the phone number displayed.
                                            It takes approximately 5 minutes for funds to be verified and credited to your E-wallet.
                                            Kindly refer to our <a href="{{ route('faq') }}">F.A.Q</a> page for more information or <a href="{{ route('contact') }}">Contact us
                                            </a> for enquiries.

                                        </div>


                                    </div>
                                </section>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                <!-- /.box -->
            </div>
        </div>

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

                $('#gateway').change(function() {
                    var gateway = $('#gateway').val();
                    console.log(gateway);
                    if(gateway == 1){//airtime
                        $('#amount-field,#ecard-form').hide();
                        $('#airtime-form').show();
                        $('#airtimeAmount').keyup(function(){
                            var network = $('#network').val()
                            var amount = $('#airtimeAmount').val();
                            var percentages = $('#percentages').data('networks');
                            var percentage = percentages[network-1]['airtime_to_cash_percentage'];
                            var walletAmount = percentage / 100 * amount;
                            if(amount.length > 2){
                                $('#wallet-amount').show();
                                $('#wallet_amount').val(walletAmount);
                                console.log(walletAmount);
                            }
                        });
                    }else if(gateway == 5){//ecard
                        $('#amount-field,#airtime-form').hide();
                        $('#ecard-form').show();
                    }else{
                        $('#ecard-form,#airtime-form').hide();
                        $('#atmBankBitcoin-form,#amount-field').show();
                    }

                });

                $('#submit').click(function() {
                    $('#data-purchase-form').validate({
                        rules: {
                            phone: {
                                required: true,
                                digit: true
                            }
                        },
                        messages: {
                            phone: {
                                required: "Pls enter phone number.",
                                digit:  "Phone numbers only "
                            }

                        }
                    });
                });
            });

        </script>
    @endSection
