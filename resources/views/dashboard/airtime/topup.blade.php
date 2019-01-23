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
                                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
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
                                            <div class="otherFields" style="display:none;">
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
                                                <div id="loader" style="display: none; text-align: center;">
                                                    <img src="../dist/img/ajax-loader.gif">
                                                </div>
                                                <div id="result"></div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                        <a href="#"><img class="mtn" style="display:none;" src="/images/mtn-logo-180x230.png" class="img-responsive" alt="Image"></a>
                                        <a href="#"><img class="airtel" style="display:none;" src="/images/airtel-logo-220x236.png" class="img-responsive" alt="Image"></a>
                                        <a href="#"><img class="glo" style="display:none;" src="/images/glo-logo-220x220.png" class="img-responsive" alt="Image"></a>
                                        <a href="#"><img class="9mobile" style="display:none;" src="/images/9mobile-logo-220x248.png" class="img-responsive" alt="Image"></a>
                                    </div>
                                </div>
                            </section>
                            <div class="row" id="networkImages">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <a href="#"><img src="/images/mtn-logo-180x230.png" class="img-responsive" alt="Image"></a>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <a href="#"><img src="/images/airtel-logo-220x236.png" class="img-responsive" alt="Image"></a>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <a href="#"><img src="/images/glo-logo-220x220.png" class="img-responsive" alt="Image"></a>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <a href="#"><img src="/images/9mobile-logo-220x248.png" class="img-responsive" alt="Image"></a>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row" id="networkImages">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <a href="#"><img src="uploads/site/earn-with-us.jpg" class="img-responsive" alt="Image"></a>
                                </div>
                            </div> --}}

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

                $('#network').change(function() {
                    var network = $('#network').val();
                    console.log(network);
                    if(network == 1){
                        $('#networkImages,.airtel,.glo,.9mobile').hide();
                        $('.mtn,.otherFields').show();
                    }else if(network == 2){
                        $('#networkImages,.mtn,.glo,.9mobile').hide();
                        $('.airtel,.otherFields').show();
                    }else if(network == 3){
                        $('#networkImages,.mtn,.airtel,.9mobile').hide();
                        $('.glo,.otherFields').show();
                    }else if(network == 4){
                        $('#networkImages,.mtn,.airtel,.glo').hide();
                        $('.9mobile,.otherFields').show();
                    }else{
                        $('.mtn,.airtel,.glo,.9mobile,.otherFields').hide();
                        $('#networkImages').show();
                    }

                });

                $('#submit').click(function() {
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
                });
            });

        </script>
    @endSection
