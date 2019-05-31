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
                    <h3 class="box-title">Pay {{ $product->name }} Bills</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @php $charges = 100; @endphp
                    <section class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-7 col-md-6 col-lg-6">
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
                                    <form id="tv-bill-form" class="form-horizontal" action="{{ route('bills.tv.topup') }}" method="POST">
                                        @csrf
                                        <br/>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Package</label>
                                            <div class="col-sm-10 form-grouping text-bold">
                                                <select style="height: 40px;" class="form-control" id="package" name="package">
                                                    <option value="" disabled selected><strong>Choose Package/Plan</strong></option>
                                                    @foreach ($product->productList as $subProduct)
                                                        <option value="{{ $subProduct }}">
                                                            {{ $subProduct->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <br/>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Smart Card No.</label>
                                            <div class="col-sm-10 form-grouping">
                                                <input type="text" id="cardNo" value="7029664775" class="form-control" name="cardNo" placeholder="Smart Card Number">
                                            </div>
                                        </div>
                                        <div class="form-group" id="nameDiv" style="display:none;">
                                            <label class="col-sm-2 control-label">Name</label>
                                            <div class="col-sm-10 form-grouping">
                                                <input style="border: 1.5px solid green; color:blue;" type="text" id="name" class="form-control" name="name">
                                            </div>
                                        </div>
                                        <div id="amountDiv" class="form-group" style="display:none;">
                                            <label class="col-sm-2 control-label">Amount</label>
                                            <div class="col-sm-10 form-grouping">
                                                <input type="text" id="amount" class="form-control" name="amount" disabled="{{ $product->product_list ? 'true' : 'false'  }}">
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Email</label>
                                            <div class="col-sm-10 form-grouping">
                                                <input type="text" id="email" class="form-control" name="email" value="{{ Auth::user()->email }}">
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Phone Number</label>
                                            <div class="col-sm-10 form-grouping">
                                                <input type="text" id="phone" class="form-control" name="phone" value="{{ Auth::user()->number }}">
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <button id="continue" class="btn bg-purple btn-flat pull-right">Continue</button>
                                                <button id="submit" type="submit" class="btn bg-purple btn-flat pull-right" style="display: none;">Submit</button>
                                            </div>
                                            <div id="loader" style="display: none; text-align: center;">
                                                <img src="../dist/img/ajax-loader.gif">
                                            </div>
                                            <div id="result"></div>
                                        </div>
                                    <form>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <a href="invest" class="btn btn-sm bg-purple btn-flat pull-left">Invest Now</a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Subscriptions</a>
                </div>
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


                $('#continue').click(function() {
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
                });
                $('#package').change(function() {
                    let package = JSON.parse($(this).val());
                    $('#amountDiv').show().find('#amount').val(package.selling_price);
                });

                $('#continue').click(function(e){
                    e.preventDefault();
                    $.ajaxSetup({
                        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
                    });
                    $('.overlay').show();
                    let package = JSON.parse($('#package').val());
                    let timeOut = setTimeout(function(){ notifyError(); },10000);
                    $.ajax({
                        type:'POST',
                        url:'{{ route("bills.tv.validate") }}',
                        data:{
                            cardNo : $('#cardNo').val(), amount : $('#amount').val(), email : $('#email').val(),
                            phone : $('#phone').val() , productId : '{{ $product->id }}', product : package.code },
                        success:function(data){
                            console.log(data);
                            clearTimeout(timeOut);
                            data.response ? finalizeBill(data) : notifyError();
                        }
                    });

                    function finalizeBill(data){
                        $('#name').val(data.name);
                        $('#continue,.overlay').hide();
                        $('#nameDiv,#submit').show();
                    }

                    function notifyError(){
                        $('#error-modal').modal('show');
                        $('.overlay').hide();
                    }
                });

            });

    </script>
    @endSection
