@extends('dashboard.layouts.master')

@section('content-header')
<section class="content-header">
    <h1>Pay Bills</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#"><i class="fa fa-dashboard"></i> Home</a>
        </li>
        <li class="active">Bills</li>
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
                        <h3 class="box-title">Pay Bills</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">

                        <section class="container">

                                @foreach ($products->chunk(5) as $chunk)
                                    <div class="row visible-md visible-lg">
                                        @foreach ($chunk as $product)
                                            <div class="col-md-2 col-lg-2">
                                                <div class="biller img-rounded">
                                                    <a href="{{ route('bills').'/'.strtolower($product->service) }}/{{ $product->id }}" class="bill-link-lg-md center-block">
                                                        <img class="img-responsive" src="/images/bills/{{ $product->logo }}">
                                                    </a>
                                                    <p class="text-center">{{ $product->name }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <hr class="visible-md visible-lg">
                                @endforeach


                                @foreach ($products->chunk(3) as $chunk)
                                    <div class="row visible-xs visible-sm">
                                        @foreach ($chunk as $product)
                                            <div class="col-xs-4 col-sm-4">
                                                <div class="biller img-rounded">
                                                    <a href="{{ route('bills').'/'.strtolower($product->service)}}/{{ $product->id }}" class="bill-link-sm-xs center-block">
                                                        <img class="img-responsive" src="/images/bills/{{ $product->logo }}">
                                                    </a>
                                                    <p class="text-center">{{ $product->name }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <hr class="visible-xs visible-sm">
                                @endforeach
                            </section>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    @include('dashboard.layouts.errors')
                    <!-- .box-footer -->
                    @include('dashboard.layouts.box-footer')
                    <!-- /.box-footer -->
                    <!-- /.box -->
                </div>
                <!-- /.box -->
            </div>
        </section>
    @endSection

    @section('scripts')

        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.16.0/jquery.validate.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#mtnImage,#airtelImage,#gloImage,#9mobileImage').hide();

                $.validator.setDefaults({
                    errorClass: 'help-block',
                    highlight: function(element) {
                        $(element)
                            .closest('.form-grouping')
                            .addClass('has-error');
                    },
                    unhighlight: function(element) {
                        $(element)
                            .closest('.form-grouping')
                            .removeClass('has-error');
                    }
                });

                $('#network').change(function() {
                    var network = $('#network').val();
                    console.log(network);
                    if (network == 1) {
                        $('#networkImages,.airtel,.glo,.9mobile').hide();
                        $('.mtn,#dataPlanChooser,#phoneNumber').show();
                    } else if (network == 2) {
                        $('#networkImages,.mtn,.glo,.9mobile').hide();
                        $('.airtel,#dataPlanChooser,#phoneNumber').show();
                    } else if (network == 3) {
                        $('#networkImages,.mtn,.airtel,.9mobile').hide();
                        $('.glo,#dataPlanChooser,#phoneNumber').show();
                    } else if (network == 4) {
                        $('#networkImages,.mtn,.airtel,.glo').hide();
                        $('.9mobile,#dataPlanChooser,#phoneNumber').show();
                    } else {
                        $('.mtn,.airtel,.glo,.9mobile,#phoneNumber,#dataPlanChooser').hide();
                        $('#networkImages').show();
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
                                digit: "Phone numbers only "
                            }

                        }
                    });
                });
            });
        </script>
    @endSection
