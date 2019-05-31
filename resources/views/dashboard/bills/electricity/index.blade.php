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
                                        <h4 class="text-danger text-center"><strong>Charges @naira(100) Apply </strong></h3>
                                    </div>
                                    <div class="col-xs-5 col-sm-5 col-md-4 col-lg-3  pull-right">
                                        <br/>
                                        <img  src="/images/bills/{{ $product->logo }}" class="img-thumbnail">
                                    </div>
                                </div>
                                <div id="form1">
                                    <form id="electricity-bill-form" class="form-horizontal">
                                        @csrf
                                        <br/>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Meter id</label>
                                            <div class="col-sm-10 form-grouping">
                                                <input type="text" id="meterId" class="form-control" name="meterId" value="23300065960" placeholder="Pls Eneter Meter ID">
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Amount</label>
                                            <div class="col-sm-10 form-grouping">
                                                <input type="text" id="amount" class="form-control" name="amount" value="10" placeholder="Pls Eneter Amount">
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
                                                <input type="text" id="phone" class="form-control" name="phone" value="{{ Auth::user()->number }}"">
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <button id="continue" class="btn bg-purple btn-flat pull-right">
                                                Submit
                                                </button>
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
                                    <em>Invalid {{ ucfirst(strtolower($product->name)) }}  Meter Number</em>
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


            $('#electricity-bill-form').validate({
                rules: {
                    meterId: {
                        required: true,
                        digit : true,
                        minlength: 10,
                        maxlength: 18
                    },
                    amount: {
                        required: true,
                        minlength: '{{ $product->min_amount }}',
                        maxlength: '{{ $product->max_amount }}'

                    },
                    email: {
                        required: true,
                        email: true,
                        minlength: 7,
                        maxlength: 50
                    },
                    phone: {
                        required: true,
                        minlength: 10,
                        maxlength: 13

                    }
                },
                messages: {
                    meterId: {
                        required: 'Meter id cannot be blank',
                        minlength: $.validator.format("Minimum of {0} characters required."),
                        maxlength: $.validator.format("Maximum {0} characters.")
                    },
                    amount: {
                        required: 'Bill amount cannot be blank',
                        minlength: $.validator.format("Minimum of {0} characters required."),
                        maxlength: $.validator.format("Maximum {0} characters.")
                    },
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
    </script>
    <script type="text/javascript">
        $('#continue').click(function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
            });
            $('.overlay').show();
            let timeOut = setTimeout(function(){ notifyError(); },10000);
            $.ajax({
               type:'POST',
               url:'{{ route("bills.electricity.validate") }}',
               data:{
                   meterId : $('#meterId').val(), amount : $('#amount').val(), email : $('#email').val(),
                   phone : $('#phone').val(), productId : '{{ $product->id  }}' },
                success:function(data){
                    console.log(data);
                    clearTimeout(timeOut);
                    data.response ? finalizeBill(data) : notifyError();
                }
            });

            function finalizeBill(data){
                $('.overlay').hide();
                alert(data.name);

            }

            function notifyError(){
                $('#error-modal').modal('show');
                $('.overlay').hide();
            }
        });
    </script>
    @endSection
