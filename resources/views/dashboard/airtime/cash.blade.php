@extends('dashboard.layouts.master')

    @section('content-header')
        <section class="content-header">
            <h1>Airtime To Cash</h1>
            <ol class="breadcrumb">
                <li>
                    <a href="#"><i class="fa fa-dashboard"></i> Airtime</a>
                </li>
                <li class="active">Airtime To Cash</li>
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
                            <h3 class="box-title">Airtime To Cash</h3>

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
                                    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
                                        <form id="airtime-swap-form" class="form-horizontal" method="post">
                                            <br/> @csrf
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label hidden-xs">&nbsp;</label>
                                                <div class="col-sm-10 form-grouping">
                                                    <div class="row">
                                                        <div class="swap-from-network-image col-xs-4 col-sm-3 col-md-3 col-lg-3" style="display:none;">
                                                            <img class="img-responsive">
                                                        </div>
                                                        <div class="swap-from-network-image col-xs-4 col-sm-6 col-md-6 col-lg-6 text-center" style="display:none;">
                                                            <br/><br/>
                                                            <i class="fa fa-arrow-right fa-3x"></i>
                                                        </div>
                                                        <div class="swap-from-network-image col-xs-4 col-sm-3 col-md-3 col-lg-3  pull-right" style="display:none;">
                                                            <img class="img-responsive">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" >Network</label>
                                                <div class="col-sm-10">
                                                    <div id="swap-from-network" data-networks="{{ $networks }}">
                                                        <select class="form-control" name="network" id="network">
                                                            <option value="" disabled selected>Choose Network</option>
                                                            @foreach ($networks as $network)
                                                                <option value="{{ $network->id }}">
                                                                    {{ $network->network }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <p class="help-block">Select the network you want to swap airtime from.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Phone Number</label>
                                                <div class="col-sm-10 form-grouping">
                                                    <input type="text" class="form-control" name="swapFromPhone">
                                                    <p class="help-block">The phone number you want to swap airtime from</p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Amount</label>
                                                <div class="col-sm-10 form-grouping">
                                                    <input type="text" id="amount" class="form-control" name="amount" disabled="true">
                                                    <p class="help-block">Enter amount you want to fund.</p>
                                                </div>
                                            </div>
                                            <div id="wallet-amount" class="form-group" style="display:none;">
                                                <label class="col-sm-2 control-label">Amount To Wallet</label>
                                                <div class="col-sm-10 form-grouping">
                                                    <input type="text" class="form-control" disabled="true">
                                                </div>
                                            </div>
                                            <div class="form-group bank" style="display:none;">
                                                <label class="col-sm-2 control-label" >Bank</label>
                                                <div class="col-sm-10">
                                                    <div id="swap-from-network" data-networks="{{ $networks }}">
                                                        <select class="form-control" name="bankId">
                                                            <option value="" disabled selected>Choose Bank</option>
                                                            @foreach ($banks as $bank)
                                                                <option value="{{ $bank->id }}">
                                                                    {{ $bank->acc_name  }} {{ $bank->acc_no }} {{ $bank->bank_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <p class="help-block">Select a bank account to receive your cash.  </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button id="submit" class="btn bg-purple btn-flat">Swap</button>
                                                    <button class="btn bg-maroon btn-flat bank add-bank pull-right" style="display:none;">
                                                        <i class="fa fa-bank"></i>
                                                        Add {{ $banks->count() > 0 ? 'More' : 'New' }} Bank Account
                                                    </button>
                                                </div>
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
        <!-- /Modal -->
        @php $imgSrc = "/images/networks/".session('modal')->swapFromNetwork.".png"; @endphp
        <div id="response-modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Airtime To Cash</h4>
                    </div>
                    <div class="modal-body">
                        <p class="h3 text-center text-success"><i class="fa fa-check"></i>Airtime  Request Accepted</p>
                        <section class="content">

                            <h4 class="text-justify text-info">
                                To complete the Airtime to Cash Send @naira(session('modal')->amount) airtime from
                                {{ session('modal')->swapFromPhone }} to any of the {{ ucfirst(session('modal')->swapFromNetwork) }}
                                numbers listed below and then click the completed button
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
                                You will receive @naira(session('modal')->walletAmount) on
                                {{ session('modal')->bankDetails->acc_no.'( '.session('modal')->bankDetails->bank_name.' )' }}
                                within {{ session('modal')->processTime }} minutes
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
        <!-- /Modal -->
        @endif
    @section('scripts')

        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.16.0/jquery.validate.min.js"></script>
        <script>
            $(document).ready(function(){

                $.validator.setDefaults({
                    errorClass: 'help-block',
                    highlight: function (element) {
                        $(element).closest('.form-grouping').addClass('has-error');
                    },
                    unhighlight: function (element) {
                        $(element).closest('.form-grouping').removeClass('has-error');
                    }
                });

                $('.add-bank').click(function(){
                    document.location.href="{{ route('user.profile') }}";
                });

                $('#amount').keyup(function(){
                    let amount = $('#amount').val();
                    let networks = @json($networks);
                    let network = $('#network').val();
                    let returnAmount = networks[(network-1)].airtime_swap_percentage / 100 * amount;
                    amount.length > 2 ? $('#wallet-amount').show().find('input').val(returnAmount) : false;
                    amount.length > 2 ? $('.bank').show() : false;
                });

                $('#network').change(function(){
                    $('.networkList').remove();
                    $('#amount').removeAttr('disabled');
                    let network = $(this).val();
                    let networks = @json($networks);
                    let fromNetwork = networks.splice((network-1),1)[0].network.toLowerCase();
                    $('.swap-from-network-image').show().find('img').attr('src', '/images/networks/'+fromNetwork+'.png');
                    //$('#swapToNetworkImage').show().find('img').attr('src', '/images/networks/'+networkImage+'.png');
                })




                $('#airtime-swap-form').validate({
                    rules: {
                        network: {
                            required : true
                        },
                        swapFromPhone: {
                            required : true
                        },
                        amount: {
                            required : true
                        }
                    },
                    messages: {
                        network: {
                            required: "Pls select a network to swap from.",
                        },
                        swapFromPhone: {
                            required: "Pls enter phone number to swap airtime from.",
                        },
                        amount: {
                            required: "Pls enter swap amount",
                        }
                    }
                });

            });

        </script>
    @endSection
