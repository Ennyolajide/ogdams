@extends('dashboard.layouts.master')

    @section('content-header')
        <div class="page-title">
            <div class="title_left">
                <h3>Data Topup</h3>
            </div>
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-dashboard"></i> Home</a>
                    </li>
                    <li class="active">Data</li>
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
                        <h2>By Data</h2>
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
                                <form id="data-purchase-form" class="form-horizontal" action="{{ route('data.buy') }}" method="post">
                                    @csrf
                                    <br/>
                                    <div class="form-group" id="choose-wallet-type">
                                        <label for="inputWallet" class="col-sm-2 col-xs-12 control-label">network</label>

                                        <div class="col-sm-10 col-xs-12 ">
                                            <select class="form-control" id="network">
                                                <option value="" disabled selected>Select network Type</option>
                                                @foreach ($networks as $network)
                                                    <option value="{{ $network->network_id }}">
                                                        {{ $network->network }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <br/>
                                    <div id="other-fields" style="display:none;">
                                        <div class="form-group" id="data-plan">
                                            <label class="col-sm-2 col-xs-12 control-label" >Choose data plan</label>
                                            <div class="col-sm-10 col-xs-12 ">
                                                @foreach ($networks as $network)
                                                    <select class="form-control plans {{ strtolower($network->network) }}" name="plan" style="display:none;">
                                                        <option value="" disabled selected>Choose a data plan</option>
                                                        @foreach ($network->plans as $plan)
                                                            <option value="{{ $plan->id }}">
                                                                {{ $plan->volume }} =  @naira($plan->amount)
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @endforeach
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="form-group">
                                            <label class="col-sm-2 col-xs-12 control-label">Phone Number</label>
                                            <div class="col-sm-10 col-xs-12 form-grouping">
                                                <input type="text" class="form-control" name="phone" placeholder="Pls Eneter Phone Number">
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="form-group">
                                            <div class="col-x-12">
                                                <button id="submit" class="btn bg-purple btn-flat pull-right">Submit</button>
                                            </div>
                                            <br/>
                                        </div>
                                    </div>
                                </form>
                                <br/><br/>
                                <div class="form-grouping" id="network-images">
                                    <div class="row">
                                        @foreach ($networks as $network)
                                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                <img src="/images/networks/{{ strtolower($network->network) }}.png" class="img-responsive">
                                            </div>
                                        @endforeach
                                    </div>
                                    <br/><br/><br/>
                                </div>
                            </div>
                        </div>
                        @include('dashboard.layouts.errors')
                    </div>
                     <!-- /.box-body -->
                     <!-- .box-footer -->
                     @include('dashboard.layouts.box-footer')
                     <!-- /.box-footer -->
                 </div>
                 <!-- /.box -->
             </div>
        </div>
     @endSection

    @section('scripts')

        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.16.0/jquery.validate.min.js"></script>
        <script>
            $(document).ready(function(){
                $('#mtnImage,#airtelImage,#gloImage,#9mobileImage').hide();

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

                $('#network').change(function() {
                    $('#network-images,#data-plan,.plans').hide();
                    $('#other-fields,#network-image').show();
                    let networks = @json($networks);
                    let networkId = $('#network').val();
                    let network = networks.splice((networkId-1),1)[0].network.toLowerCase();
                    $('#data-plan,.'+network).show();
                    $('#network-image').attr('src','/images/networks/'+network+'.png');
                });

            });

        </script>
    @endSection
