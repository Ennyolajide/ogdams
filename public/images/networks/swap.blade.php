@extends('dashboard.layouts.master')

    @section('content-header')
        <section class="content-header">
            <h1>Airtime Swap</h1>
            <ol class="breadcrumb">
                <li>
                    <a href="#"><i class="fa fa-dashboard"></i> Airtime</a>
                </li>
                <li class="active">Airtime Swap</li>
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
                            <h3 class="box-title">Airtime Swap</h3>

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
                                        <h3 id="transfer-header" style="display:none;">Transfer Details</h3>
                                        <h3 id="receiver-header" style="display:none;">Receiver's Details</h3>
                                        <form id="airtimeswap-form" class="form-horizontal" action="{{ route('airtime.swap') }}" method="post">
                                            @csrf
                                            <br/>
                                            <div class="form-group from-network" id="from-network">
                                                <label for="from-network" class="col-sm-2 control-label">Network</label>

                                                <div class="col-sm-10">
                                                    <div class="input-group ">
                                                        <select style="height: 50px;" class="form-control" id="from_network" name="from_network">
                                                            <option value="" disabled selected>Choose the network you want to swap from</option>
                                                            @foreach ($percentages as $network)
                                                                <option value="{{ $network->id }}">
                                                                    {{ $network->network }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <div class="input-group-addon network-image" style="background-color: #eee;">
                                                            <i class="fa fa-phone fa-2x"></i>
                                                            <img class="" src="">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <br/>
                                            <div class="firstForm"  style="display:none;">
                                                <div id="from" class="form-group">
                                                    <label class="col-sm-2 control-label">From( Phone Number )</label>
                                                    <div class="col-sm-10 form-grouping">
                                                        <input type="num" class="form-control" name="from" placeholder="Phone number you want to transfer from">
                                                    </div>
                                                </div>
                                                <div id="amount" class="form-group">
                                                    <label class="col-sm-2 control-label">Amount</label>
                                                    <div class="col-sm-10 form-grouping">
                                                        <input type="text" class="form-control" name="amount" placeholder="Enter amount to be swaped">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-2 col-sm-4">
                                                        <button type="submit" id="continue" class="btn bg-purple btn-flat">Continue</button>&nbsp;&nbsp;&nbsp;
                                                    </div>
                                                    <div class="col-sm-offset-1 col-sm-5">
                                                        <div id="loader" style="display:none;">
                                                            <img src="/dist/img/ajax-loader.gif">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="secondForm" style="display:none;">
                                                <div class="form-group" id="to-network">
                                                    <label for="to-network" class="col-sm-2 control-label">Network</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control" id="to_network" name="to_network">
                                                            <option value="" disabled selected>Choose the network you want to receive airtime on</option>
                                                            @foreach ($percentages as $network)
                                                                <option value="{{ $network->id }}">
                                                                    {{ $network->network }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div id="to" class="form-group">
                                                    <label class="col-sm-2 control-label">To( Phone Number )</label>
                                                    <div class="col-sm-10 form-grouping">
                                                        <input type="text" class="form-control" name="to" placeholder="Phone number you want to receive airtime on">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-2 col-sm-3">
                                                        <button id="submit" class="btn bg-purple btn-flat">Submit</button>
                                                    </div>

                                                    <div id="result"></div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="hidden-xs col-sm-4 col-md-4 col-lg-4">
                                        @foreach ($networks as $network)
                                            {{ 'ggygygygy' }}
                                            <a href="#"><img class="{{ $network }} img-responsive"  src="/images/networks/{{ $network }}.png" alt="{{ $network }}"></a>
                                        @endforeach
                                    </div>
                                </div>
                            </section>
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
        </div>
    @endSection

    @section('scripts')
        @if (session('response'))
            <script>alert('{{ session('response') }}');</script>
        @endif

        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.16.0/jquery.validate.min.js"></script>
        <script>
            $(document).ready(function(){

                $('#transfer-header').show();

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

                var networks = @json($networks);
                $('#from_network').change(function() {
                    var networkId = $(this).val();
                    var network = networks[networkId].toLowerCase();
                    if(networkId > 0 && networkId < 5){
                        $('.mtn,.airtel,.glo,.9mobile').hide();
                        $('.firstForm,.'+network).show();
                        //$(.).siblings()
                        console.log(network);
                        //$('.network').siblings('i').hide();
                    }

                });



                $('#continue').click(function(e) {
                    e.preventDefault();
                    $('#airtimeswap-form').validate({
                        rules: {
                            from: {
                                required: true,
                                digit: true
                            },
                            amount: {
                                required: true,
                                digit: true
                            }
                        },
                        messages: {
                            from: {
                                required: "Pls enter phone number.",
                                digit:  "Phone numbers only "
                            },
                            amount: {
                                required: "Pls enter phone number.",
                                digit:  "Phone numbers only "
                            }

                        }
                    });
                    $('#transfer-header,#from-network,.firstForm').hide();
                    $('#receiver-header,.secondForm').show();
                });

                $('#submit').click(function(e) {
                    $('#airtimeswap-form').validate({
                        rules: {
                            to_network: {
                                required: true,
                                digit: true
                            },
                            to: {
                                required: true,
                                digit: true
                            }
                        },
                        messages: {
                            to_network: {
                                required: "Pls enter phone number.",
                                digit:  "Phone numbers only "
                            },
                            to: {
                                required: "Pls enter phone number.",
                                digit:  "Phone numbers only "
                            }

                        }
                    });
                });
            });

        </script>
    @endSection
