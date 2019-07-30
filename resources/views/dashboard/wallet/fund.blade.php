@extends('dashboard.layouts.master')

    @section('content-header')
        <div class="page-title">
            <div class="title_left">
                <h4>Fund Wallet</h4>
            </div>
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li class="active">Wallet</li>
                </ol>
            </div>
        </div>
        <div class="clearfix"></div>
    @endsection

    @section('content')
        <!-- Main content -->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Fund Wallet</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                <form id="fund-wallet-form" class="form-horizontal" method="post">
                                    @csrf
                                    <br/>
                                    <div id="atmBankBitcoin-form">
                                        <div class="form-group" id="gateway-type">
                                            <label for="inputWallet" class="col-sm-3 col-xs-12 control-label">Payment Method</label>
                                            <div class="col-sm-9 col-xs-12 ">
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
                                    <br/>
                                    <div id="amount-field" style="display:none;">
                                        <div class="form-group">
                                            <label class="col-sm-3 col-xs-12 control-label">Amount</label>
                                            <div class="col-sm-9 col-xs-12 form-grouping">
                                                <input type="text" class="form-control" name="amount" required>
                                                <p class="help-block text-olive">Enter amount you want to fund.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="bank-transfer" style="display:none;">
                                        <div class="form-group">
                                            <label class="col-sm-3 col-xs-12 control-label">Depositor</label>
                                            <div class="col-sm-9 col-xs-12 form-grouping">
                                                <input type="text" class="form-control" name="depositor" value="" required>
                                                <p class="help-block text-olive">Enter depositor name or account name.</p>
                                            </div>
                                        </div>
                                        <div class="form-group" id="chooseBank">
                                            <label class="col-sm-3 col-xs-12 control-label">Bank</label>
                                            <div class="col-sm-9 col-xs-12 ">
                                                <select class="form-control" id="bank" name="bankId" required>
                                                    <option value="" disabled selected>Select Our Bank </option>
                                                    @foreach ($banks as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->bank_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <p class="help-block text-olive">Bank to transfer to</p>
                                            </div>
                                            <div class="col-sm-9 col-sm-offset-3 col-xs-12 ">
                                                <div class="radio" style="display:none; border: 2px solid #605ca8;">
                                                    <p class="text-center well no-shadow" style="margin:-6px 0px 0px 0px; padding: 2px 7px;">
                                                        <span class="bankName"></span><br/>
                                                        <strong><span class="accNo"></span></strong><br/>
                                                        <span class="accName"></span>
                                                    </p>
                                                </div>
                                            </div>
                                            <br/>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 col-xs-12 control-label">Reference (optional)</label>
                                            <div class="col-sm-9 col-xs-12 form-grouping">
                                                <input type="text" class="form-control" name="reference" value="">
                                                <p class="help-block text-olive">Enter reference / teller</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 col-xs-12 control-label">Remarks (optional)</label>
                                            <div class="col-sm-9 col-xs-12 form-grouping">
                                                <textarea name="remarks" class="form-control" style="height: 80px"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="airtime-form" style="display:none;">
                                        <div class="form-group">
                                            <label class="col-sm-3 col-xs-12 control-label" >Network</label>
                                            <div class="col-sm-9 col-xs-12">
                                                <div id="percentages" data-networks="{{ $networks }}">
                                                    <select class="form-control" name="network" id="network">
                                                        <option value="" disabled selected>Choose Network</option>
                                                        @foreach ($networks as $network)
                                                            <option value="{{ $network->id }}">
                                                                {{ $network->network }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <p class="help-block text-olive">Select the network you want to fund with.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 col-xs-12 control-label">Amount</label>
                                            <div class="col-sm-9 col-xs-12 form-grouping">
                                                <input type="text" id="airtimeAmount" class="form-control" name="airtimeAmount" value="" required>
                                                <p class="help-block text-olive">Enter amount you want to fund.</p>
                                            </div>
                                        </div>
                                        <div id="wallet-amount" class="form-group" style="display:none;">
                                            <label class="col-sm-3 col-xs-12 control-label">Amount To Wallet</label>
                                            <div class="col-sm-9 col-xs-12 form-grouping">
                                                <input id="wallet_amount" type="text" class="form-control" name="wallet_amount" disabled>
                                                <p class="help-block text-olive">Enter amount you want to fund.</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 col-xs-12 control-label">Phone Number</label>
                                            <div class="col-sm-9 col-xs-12 form-grouping">
                                                <input type="text" class="form-control" name="swapFromPhone" required>
                                                <p class="help-block text-olive">The phone number you want to transfer the airtime from.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="ecard-form" style="display:none;">
                                        <div class="form-group">
                                            <label class="col-sm-3 col-xs-12 control-label">Voucher Pin</label>
                                            <div class="col-sm-9 col-xs-12 form-grouping">
                                                <input type="text" class="form-control" name="voucher">
                                                {{-- <p class="help-block text-olive">Enter the Voucher Pin</p> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button id="submit" class="btn bg-purple pull-right">Continue</button>
                                        </div>
                                    </div>
                                    <br/><br/>
                                </form>
                            </div>
                        </div>
                        @include('dashboard.layouts.errors')
                    </div>
                    @include('dashboard.layouts.box-footer')
                </div>
            </div>
        </div>
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
                                    <p class="text-primary text-center text-bold visible-xs h4">{{ session('modal')->transferCode }}</p>
                                </p>
                                <p class="h4 text-center text-danger">
                                    You will receive @naira(session('modal')->walletAmount) in your wallet within 5 - 15mins
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
        @elseif(session('modal')->name == 'BankTransfer'))
            <!-- BankTransfer-Modal -->
            <div id="response-modal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Bank Transfer </h4>
                        </div>
                        <div class="modal-body">
                            <p class="h3 text-center text-success"><i class="fa fa-check"></i>Bank Transfer Request Accepted</p>
                            <section class="content">

                                <h4 class="text-justify text-primary">
                                    To complete the bank wallet funding transfer/deposit @naira(session('modal')->amount)
                                    to the bank Details below and then click the completed button
                                </h4>

                                <ul class="list h3 text-center text-olive" style="list-style-type: none;">
                                    <li> Depositor : {{ session('modal')->depositor }} </li>
                                    @if(session('modal')->reference)
                                        <li> Reference : {{ session('modal')->reference }} </li>
                                    @endif
                                    @if(session('modal')->remarks)
                                        <li> Remarks : {{ session('modal')->remarks }} </li>
                                    @endif
                                </ul>

                                <p class="text-center"><i class="fa fa-arrow-down fa-2x"></i></p>

                                <div class="radio" style="border: 2px solid #605ca8;">
                                    <p class="text-center well no-shadow" style="margin:-6px 0px 0px 0px; padding: 2px 7px;">
                                        <span >{{ session('modal')->bank->bank_name }}</span><br/>
                                        <strong><span class="text-primary">{{ session('modal')->bank->acc_no }}</span></strong><br/>
                                        <span class="">{{ session('modal')->bank->acc_name }}</span>
                                    </p>
                                </div>

                                <p class="h4 text-center text-danger">
                                    You will receive @naira(session('modal')->amount) in your wallet within 5 - 15mins
                                </p>
                            </section>
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('wallet.fund.bank.completed', ['bankTransferRecord' => session('modal')->record->id ]) }}" method="post">
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
                    errorClass: 'help-block text-olive',
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
                        $('#amount-field,#ecard-form,#bank-transfer').hide();
                        $('#airtime-form').show();
                        $('#airtimeAmount').keyup(function(){
                            let amount = $('#airtimeAmount').val();
                            let percentages = $('#percentages').data('networks');
                            let percentage = percentages[$('#network').val() -1]['airtime_to_cash_percentage'];
                            let walletAmount = percentage / 100 * amount;
                            if(amount.length > 2){
                                $('#wallet-amount').show();
                                $('#wallet_amount').val(walletAmount);
                            }
                        });

                    }else if(gateway == 2){
                        $('#ecard-form,#airtime-form,#bank-transfer').hide();
                        $('#atmBankBitcoin-form,#amount-field').show();
                        $('#fund-wallet-form').attr('action','{{ route("paystack.pay") }}');
                    }else if(gateway == 3){
                        $('#ecard-form,#airtime-form').hide();
                        $('#atmBankBitcoin-form,#amount-field,#bank-transfer').show();
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

                $('#chooseBank').change(function(){
                    let banks = @json($banks);
                    let bankDetails = banks[ $('#bank').val() - 1 ];
                    $('.radio').find('.bankName').text(bankDetails.bank_name);
                    $('.radio').find('.accNo').text(bankDetails.acc_no);
                    $('.radio').find('.accName').text(bankDetails.acc_name);
                    $('.radio').show();
                });
            });

        </script>
    @endSection
