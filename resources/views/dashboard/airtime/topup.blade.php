@extends('dashboard.layouts.master')

    @section('content-header')
        <section class="content-header">
            <h1>Airtime Topup</h1>
            <ol class="breadcrumb">
                <li>
                    <a href="#"><i class="fa fa-dashboard"></i> Home</a>
                </li>
                <li class="active">Airtime</li>
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
                            <h3 class="box-title">Airtime Topup</h3>

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
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <div class="row">
                                            <div class="col-xs-5 col-sm-3 col-md-2 col-lg-2  pull-right">
                                                <br/>
                                                <img style="height: 60px; width:50px; display:none;" id="network-image" class="img-responsive">
                                            </div>
                                        </div>
                                        <form id="airtime-topup-form" class="form-horizontal" action="{{ route('airtime.topup') }}" method="post">
                                            @csrf
                                            <br/>
                                            <div class="form-group" id="choose-wallet-type">
                                                <label for="inputWallet" class="col-sm-2 control-label">network</label>

                                                <div class="col-sm-10">
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
                                                    <label class="col-sm-2 control-label">Phone Number</label>
                                                    <div class="col-sm-10 form-grouping">
                                                        <input type="text" class="form-control" name="phone" placeholder="Pls Enter Phone Number">
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
                                            </div>
                                        </form>
                                        <br/><br/>
                                        <div class="form-grouping" id="network-images">

                                            @foreach ($networks as $network)
                                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                    <a href="#"><img src="/images/networks/{{ strtolower($network->network) }}.png" class="img-responsive"></a>
                                                </div>
                                            @endforeach
                                        </div>

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
