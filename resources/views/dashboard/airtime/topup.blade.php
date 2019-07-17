@extends('dashboard.layouts.master')

    @section('content-header')
        <div class="page-title">
            <div class="title_left">
                <h3>Airtime Topup</h3>
            </div>
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-dashboard"></i> Home</a>
                    </li>
                    <li class="active">Airtime</li>
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
                        <h2>Airtime Topup</h2>
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
                                <div class="row">
                                    <div class="col-xs-12 col-md-12">
                                        <br/>
                                        <img style="height: 60px; width:50px; display:none; margin-right:5px;" id="network-image" class="img-responsive pull-right">
                                    </div>
                                </div>
                                <br />
                                <form id="airtime-topup-form" class="form-horizontal" action="{{ route('airtime.topup') }}" method="post">
                                    @csrf
                                    <div class="form-group" id="choose-wallet-type">
                                        <label for="inputWallet" class="control-label col-md-2 col-sm-2 col-xs-12">Network </label>

                                        <div class="col-sm-10 col-xs-12">
                                            <select class="form-control" id="network" name="network">
                                                <option value="" disabled selected>Select network Type</option>
                                                @foreach ($networks as $network)
                                                <option value="{{ $network->id }}">
                                                    {{ $network->network }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <br/>
                                    <div id="other-fields" style="display:none;">
                                        <div class="form-group">
                                            <label class="col-sm-2 col-xs-12 control-label">Phone Number</label>
                                            <div class="col-sm-10 col-xs-12 form-grouping">
                                                <input type="text" class="form-control" name="phone" placeholder="Pls Enter Phone Number">
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="form-group">
                                            <label class="col-sm-2 col-xs-12 control-label">Amount</label>
                                            <div class="col-sm-10 col-xs-12 form-grouping">
                                                <input type="text" class="form-control" name="amount" placeholder="Pls Enter Phone Number">
                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <button id="submit" class="btn btn-primary btn-flat pull-right">&nbsp;&nbsp;&nbsp;&nbsp;Topup&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                        </div>
                                    </div>
                                </form>
                                <br/><br/>
                                <div class="form-grouping" id="network-images">
                                    <div class="row">
                                        @foreach ($networks as $network)
                                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                <a href="#"><img src="/images/networks/{{ strtolower($network->network) }}.png" class="img-responsive"></a>
                                            </div>
                                        @endforeach
                                    </div>
                                    <br/><br/><br/>
                                </div>
                            </div>
                        </div>
                        @include('dashboard.layouts.errors')
                    </div>
                    <!-- .box-footer -->
                    @include('dashboard.layouts.box-footer')
                    <!-- /.box-footer -->
                </div>
            </div>
        </div>

    @endSection

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

                $('#airtime-topup-form').validate({
                    rules: {
                        network: {
                            required: true,
                        },
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
                            required: "Pls select topup network.",
                        },
                        phone: {
                            required: "Pls enter phone number.",
                            digit:  "Phone numbers only "
                        },
                        amount: {
                            required: "Pls enter topup amount.",
                            digit:  "Phone numbers only "
                        }

                    }
                });

                $('#network').change(function() {
                    $('#network-images').hide();
                    $('#other-fields,#network-image').show();
                    let networks = @json($networks);
                    let networkId = $('#network').val();
                    let network = networks.splice((networkId-1),1)[0].network.toLowerCase();
                    $('#network-image').attr('src','/images/networks/'+network+'.png');
                });
            });

        </script>
    @endSection
