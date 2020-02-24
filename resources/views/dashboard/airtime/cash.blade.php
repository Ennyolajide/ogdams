@extends('dashboard.layouts.master')

    @section('content-header')
        <div class="page-title">
            <div class="title_left">
                <h3>Airtime To Cash</h3>
            </div>
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-dashboard"></i> Home</a>
                    </li>
                    <li class="active">Airtime To Cash</li>
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
                        <h2>Airtime To Cash</h2>
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
                            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
                                <form id="airtime-swap-form" class="form-horizontal form-prevent-multiple-submits" method="post">
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
                                        <label class="col-sm-2 col-xs-12 control-label" >Network</label>
                                        <div class="col-sm-10 col-xs-12">
                                            <div id="swap-from-network" data-networks="{{ $networks }}">
                                                <select class="form-control" name="network" id="network">
                                                    <option value="" disabled selected>Choose Network</option>
                                                    @foreach ($networks as $network)
                                                        <option value="{{ $network->id }}">
                                                            {{ $network->network }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <p class="help-block">Select the network you want to transfer airtime from.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-xs-12 control-label">Phone Number</label>
                                        <div class="col-sm-10 col-xs-12 form-grouping">
                                            <input type="text" class="form-control" name="swapFromPhone">
                                            <p class="help-block">The phone number you want to transfer airtime from</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-xs-12 control-label">Amount</label>
                                        <div class="col-sm-10 col-xs-12 form-grouping">
                                            <input type="text" id="amount" class="form-control" name="amount" disabled="true">
                                            <label id="amount-info" style="font-size:15px; display:none;" class="text-primary" for="amount"></label>
                                            <!--p class="help-block">Enter the amount you want to transfer.</p-->
                                        </div>
                                    </div>
                                    <div id="wallet-amount" class="form-group" style="display:none;">
                                        <label class="col-sm-2 col-xs-12 control-label">Amount To Wallet</label>
                                        <div class="col-sm-10 col-xs-12 form-grouping">
                                            <input type="text" class="form-control" disabled="true">
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-xs-12 control-label" ></label>
                                        <div class="col-sm-10 col-xs-12">
                                            <button id="submit" class="btn btn-flat btn-success pull-right button-prevent-multiple-submits">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cash&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @include('dashboard.layouts.errors')
                        <br/><br/>
                    </div>
                    <!-- /.box-body -->
                    @include('dashboard.layouts.box-footer')
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
        </div>
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
                        <p class="h3 text-center text-success"><i class="fa fa-check"></i>You are almost there.</p>
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
                                Please CLICK the Completed button only after you have transferred the airtime to avoid being barred.
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
        @else
             <!-- Modal -->
            <div id="info-modal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title text-orange text-bold">Important Info</h4>
                        </div>
                        <div class="modal-body">
                            <p class="text-danger">
                                <strong>NOTE:</strong> You are responsible for any Airtime you sell to us. By selling to us, you can confirm that it rightfully belongs to you and that it was gotten through a legitimate source.
                            </p>
                            <p class="text-danger">
                                <span class="text-success"><strong>Ogdams Technologies</strong></span> will not be held responsible for any fraudulent airtime being sold to her.
                            </p>
                            <p class="text-danger">
                                In a situation where fraudulent cases arise as a result of the airtime you sold to us, we would be compelled to give out your transaction details to the bodies involved for necessary investigation.
                            </p>
                            <p  class="text-danger">
                                 In a situation where a client allows his transaction to pass through another client before getting to us, Ogdams Technologies wishes to state it categorically that the last person that had the direct contact with us will bear the full responsibility of the airtime he sent. If by any means the airtime involved is faulted, we might be obligated to give out your details to the relevant authorities.
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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



                $('#network').change(function(){
                    $('.networkList').remove();

                    $('#amount').closest('.form-grouping').removeClass('has-error');
                    $('#amount-error').hide();
                    $('#amount').removeAttr('disabled');
                    let network = $(this).val();
                    let networks = @json($networks);
                    network = networks.splice((network-1),1)[0];
                    let fromNetwork = network.network.toLowerCase();
                    $('.swap-from-network-image').show().find('img').attr('src', '/images/networks/'+fromNetwork+'.png');
                    $('#amount-info').text(`Minimum of ₦${network.airtime_to_cash_min}, Maximum of ₦${network.airtime_to_cash_max} for ${network.network}`).show();
                    //$('#swapToNetworkImage').show().find('img').attr('src', '/images/networks/'+networkImage+'.png');
                });

                $('#amount').keyup(function(){
                    let amount = $('#amount').val();
                    let networks = @json($networks);
                    let network = $('#network').val();
                    let returnAmount = networks[(network-1)].airtime_swap_percentage / 100 * amount;
                    amount.length > 2 ? $('#wallet-amount').show().find('input').val(returnAmount) : false;
                    amount.length > 2 ? $('.bank').show() : false;

                });






                $('#airtime-swap-form').validate({
                    rules: {
                        network: {
                            required : true
                        },
                        swapFromPhone: {
                            required : true,
                            number :true
                        },
                        amount: {
                            required : true,
                            number :true
                        }
                    },
                    messages: {
                        network: {
                            required: "Please select a network.",
                        },
                        swapFromPhone: {
                            required: "Please enter phone number.",
                            number : "Invalid Phone number"
                        },
                        amount: {
                            required: "Please enter amount",
                            number : "Inavlid amount"
                        }
                    }
                });

            });

        </script>
        @if(!session('modal') && !session('notification'))
            <script>
                $(document).ready(function() {
                    $('#info-modal').modal('show');
                });
            </script>
        @endif
    @endSection
