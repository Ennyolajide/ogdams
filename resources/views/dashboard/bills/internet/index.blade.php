@extends('dashboard.layouts.master')

    @section('content-header')
        <div class="page-title">
            <div class="title_left">
                <h4>Pay Bills</h4>
            </div>
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li class="active">Bills</li>
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
                        <h2>Pay {{ $product->name }} Bills</h2>
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
                                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                                        <h3 class="text-primary text-center"><strong> {{ $product->name }} </strong></h3>
                                        <h4 class="text-danger text-center"><strong>Charges @naira(0) Apply </strong></h3>
                                    </div>
                                    <div class="col-xs-5 col-sm-5 col-md-4 col-lg-3  pull-right">
                                        <br/>
                                        <img  src="/images/bills/{{ $product->logo }}" class="img-thumbnail">
                                    </div>
                                </div>
                                <div id="form1">
                                    <form id="tv-bill-form" class="form-horizontal" action="{{ route('bills.internet.topup') }}" method="POST">
                                        @csrf
                                        <br/>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Package</label>
                                            <div class="col-sm-10 form-grouping text-bold">
                                                <select style="height: 40px;" class="form-control" id="package" name="package">
                                                    <option value="" disabled selected><strong>Choose Package/Plan</strong></option>
                                                    @foreach ($product->productList as $subProduct)
                                                        <option value="{{ $subProduct }}">
                                                            {{ $subProduct->name }} = <span class="pull-right">@naira($subProduct->selling_price) </span>
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <br/>

                                        <div class="form-group">
                                            <label class="col-sm-2 col-xs-12 control-label">Smart Card No.</label>
                                            <div class="col-sm-10 col-xs-12 form-grouping">
                                                <input type="text" id="cardNo" value="7029664775" class="form-control" name="cardNo" placeholder="Smart Card Number">
                                            </div>
                                        </div>
                                        <div id="amountDiv" class="form-group" style="display:none;">
                                            <label class="col-sm-2 col-xs-12 control-label">Amount</label>
                                            <div class="col-sm-10 col-xs-12 form-grouping">
                                                <input type="text" id="amount" class="form-control" name="amount" disabled="{{ $product->product_list ? 'true' : 'false'  }}">
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="form-group">
                                            <label class="col-sm-2 col-xs-12 control-label">Email</label>
                                            <div class="col-sm-10 col-xs-12 form-grouping">
                                                <input type="text" id="email" class="form-control" name="email" value="{{ Auth::user()->email }}">
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="form-group">
                                            <label class="col-sm-2 col-xs-12 control-label">Phone Number</label>
                                            <div class="col-sm-10 col-xs-12 form-grouping">
                                                <input type="text" id="phone" class="form-control" name="phone" value="{{ Auth::user()->number }}">
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <button id="submit" type="submit" class="btn bg-purple btn-flat pull-right">Submit</button>
                                            </div>
                                        </div>
                                    <form>
                                </div>
                            </div>
                        </div>
                        @include('dashboard.layouts.errors')
                    </div>
                    <!-- /.box-body -->
                    @include('dashboard.layouts.box-footer')
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->

                <!-- .modal -->
                <div class="modal fade" id="error-modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-9 col-sm-9 col-xs-10">
                                        <h4 class="text-center text-danger">
                                            <i class="block-center fa fa-exclamation-triangle"></i>&nbsp;&nbsp;
                                            <em>Invalid {{ ucfirst(strtolower($product->name)) }} Smartcard Number</em>
                                        </h4>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-2">
                                        <h4 class="text-right text-danger">
                                            <button type="button" class="text-danger" data-dismiss="modal" aria-label="Close">
                                                <i class="fa fa-close text-right"></i>
                                            </button>
                                        </h4>
                                    </div>
                                <div>
                            </div>

                        </div>
                        <!-- /.modal-content -->
                    </div>
                        <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

            </div>
        </div>
    @endSection

    @section('scripts')
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.16.0/jquery.validate.min.js"></script>
        <script>
            $(document).ready(function() {

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

                $('#tv-bill-form').validate({
                    rules: {
                        package: { required: true },
                        cardNo: { required: true },
                        amount: { required: true },
                        email: { required: true, email: true, minlength: 7, maxlength: 50 },
                        phone: { required: true, minlength: 10, maxlength: 13 }
                    },
                    messages: {
                        package: { required: 'Pls choose your prefered package' },
                        cardNo: { equired: 'Card number cannot be blank' },
                        amount: { required: 'Bill amount cannot be blank' },
                        email: {
                            minlength: $.validator.format("Minimum of {0} characters required."),
                            maxlength: $.validator.format("Maximum {0} characters.")
                        },
                        phone: {
                            minlength: $.validator.format("Minimum of {0} characters required."),
                            maxlength: $.validator.format("Maximum {0} characters.")
                        }
                    }
                });

                $('#package').change(function() {
                    let package = JSON.parse($(this).val());
                    $('#amountDiv').show().find('#amount').val(package.selling_price);
                });

            });

        </script>
    @endSection
