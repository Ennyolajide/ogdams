@extends('dashboard.layouts.master')

    @section('content-header')
        <section class="content-header">
            <h1>Fund Wallet</h1>
            <ol class="breadcrumb">
                <li>
                    <a href="#"><i class="fa fa-dashboard"></i> Home</a>
                </li>
                <li class="active">Fund Wallet</li>
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
                            <h3 class="box-title">Fund Wallet</h3>

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
                                        <form id="fund-wallet-form" class="form-horizontal" method="post">
                                            @csrf
                                            <br/>
                                            <div id="atmBankBitcoin-form">
                                                <div class="form-group" id="gateway-type">
                                                    <label for="inputWallet" class="col-sm-2 control-label">Payment Method</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control" id="gateway" name="gateway" required>
                                                            <option value="" disabled selected>Select gateway Method</option>
                                                            @foreach ($gateways as $gateway)
                                                                <option value="{{ $gateway->id }}">
                                                                    {{ $gateway->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>
                                                <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                                            </div>
                                            <div id="amount-field" style="display:none;">
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Amount</label>
                                                    <div class="col-sm-10 form-grouping">
                                                        <input type="text" class="form-control" name="amount" required>
                                                        <p class="help-block">Enter amount you want to fund.</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="airtime-form" style="display:none;">
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" >Network</label>
                                                    <div class="col-sm-10">
                                                        <div id="percentages" data-networks="{{ $networks }}">
                                                            <select class="form-control" name="network" id="network">
                                                                <option value="" disabled selected>Choose Network</option>
                                                                @foreach ($networks as $network)
                                                                    <option value="{{ $network->id }}">
                                                                        {{ $network->network }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <p class="help-block">Select the network you want to fund with.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Amount</label>
                                                    <div class="col-sm-10 form-grouping">
                                                        <input type="text" id="airtimeAmount" class="form-control" name="amount" value="" required>
                                                        <p class="help-block">Eneter amount you want to fund.</p>
                                                    </div>
                                                </div>
                                                <div id="wallet-amount" class="form-group" style="display:none;">
                                                    <label class="col-sm-2 control-label">Amount To Wallet</label>
                                                    <div class="col-sm-10 form-grouping">
                                                        <input id="wallet_amount" type="text" class="form-control" name="wallet_amount"s disabled>
                                                        <p class="help-block">Eneter amount you want to fund.</p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Phone Number</label>
                                                    <div class="col-sm-10 form-grouping">
                                                        <input type="text" class="form-control" name="swapFromPhone" required>
                                                        <p class="help-block">The phone number you want to transfer the airtime from.</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="ecard-form" style="display:none;">
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Voucher Pin</label>
                                                    <div class="col-sm-10 form-grouping">
                                                        <input type="text" class="form-control" name="voucher">
                                                        {{-- <p class="help-block">Enter the Voucher Pin</p> --}}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-3">
                                                    <button id="submit" class="btn bg-purple btn-flat">Continue</button>
                                                </div>
                                                <div id="loader" style="display: none; text-align: center;">
                                                    <img src="../dist/img/ajax-loader.gif">
                                                </div>
                                                <div id="result"></div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </section>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    @include('dashboard.layouts.errors')
                    <!-- .box-footer -->
                    @include('dashboard.layouts.box-footer')
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
        </section>

    @endSection

    @if(session('modal'))
        <!-- Modal -->
        @if(session('modal')->name == 'AirtimeFunding')
            <!-- AirtimeToWallet-Modal -->
            @php $imgSrc = "\images/networks/".session('modal')->swapFromNetwork.".png"; @endphp
            <div id="response-modal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Airtime To Wallet</h4>
                        </div>
                        <div class="modal-body">
                            <p class="h3 text-center text-success"><i class="fa fa-check"></i>Airtime  Request Accepted</p>
                            <section class="content">

                                <h4 class="text-justify text-info">
                                    To complete the Airtime wallet funding Send @naira(session('modal')->amount) airtime from
                                    {{ session('modal')->swapFromPhone }} to any of the {{ ucfirst(session('modal')->swapFromNetwork) }}
                                    numbers listed below  and then click the completed button
                                </h4>
                                <ul class="list-inline h3 text-center text-primary">
                                    @foreach (session('modal')->recipients as $recipient)
                                        <li>{{ $recipient }} </li>
                                    @endforeach
                                </ul>
                                <p class="hidden-xs h4 text-center">
                                    <img class="rounded icon-size" src="{{ $imgSrc }}"/> Transfer code
                                    <i class="fa fa-arrow-right"></i>
                                    <span class="text-primary text-bold">{{ session('modal')->transferCode }}</span>
                                </p>
                                <p class="visible-xs h4 text-center ">
                                    <p class="visible-xs h4 text-center"> Transfer code</p>
                                    <p class="text-center visible-xs"><i class="fa fa-arrow-down fa-2x"></i></p>
                                    <p class="text-primary text-bold visible-xs">{{ session('modal')->transferCode }}</p>
                                </p>
                                <p class="h4 text-center text-danger">
                                    You will receive @naira(session('modal')->walletAmount) in your wallet within {{ session('modal')->processTime }} minutes
                                </p>
                                <p class="h4 text-center text-danger">
                                    Please use/click the Completed button only after you have transfered the airtime to avoid been baned
                                </p>
                            </section>
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('airtime.cash.completed', ['airtimeRecord' => session('modal')->airtimeRecordId ]) }}" method="post">
                                @csrf @method('patch')
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Completed</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /AirtimeToWallet-Modal -->
        @endif
        <!-- /Modal -->
    @endif

    @section('scripts')
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
                        $('#fund-wallet-form').attr('action',"{{ route('wallet.fund.airtime')}}");
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

                    }else if(gateway == 2){
                        $('#ecard-form,#airtime-form').hide();
                        $('#atmBankBitcoin-form,#amount-field').show();
                        $('#fund-wallet-form').attr('action','{{ route("paystack.pay") }}');
                    }else if(gateway == 3){
                        $('#ecard-form,#airtime-form').hide();
                        $('#atmBankBitcoin-form,#amount-field').show();
                        $('#fund-wallet-form').attr('action','{{ route("wallet.fund.bank") }}');
                    }else if(gateway == 4){
                        $('#ecard-form,#airtime-form').hide();
                        $('#atmBankBitcoin-form,#amount-field').show();
                        //$('#fund-wallet-form').attr('action','{{--route("wallet.fund.bitcoin")--}}');
                    }else if(gateway == 5){//ecard
                        $('#amount-field,#airtime-form').hide();
                        $('#ecard-form').show();
                        $('#fund-wallet-form').attr('action','{{ route("wallet.fund.voucher") }}');
                    }else{


                    }

                });

                $('#submit').click(function() {
                    $('#fund-wallet-form').validate({
                        rules: {
                            voucher: {
                                required: true,
                                minlength: 16,
                                maxlength: 20
                            }
                        },
                        messages: {
                            voucher: {
                                required: "Pls enter the Voucher pin.",
                                minlength: jQuery.validator.format("Minimum of {0} characters required."),
                                maxlength: jQuery.validator.format("Maximum {0} characters.")
                            }

                        }
                    });
                });
            });

        </script>
    @endSection
