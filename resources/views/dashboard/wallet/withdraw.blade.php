
@extends('dashboard.layouts.master')
    @section('style')
        <style>
            .radio.selected{
                border: 2px solid #605ca8;
                border-radius: 3px;
            }
        </style>
    @endsection
    @section('content-header')
        <section class="content-header">
            <h1>Withdraw to Bank</h1>
            <ol class="breadcrumb">
                <li>
                    <a href="#"><i class="fa fa-dashboard"></i> Home</a>
                </li>
                <li class="active">Withdraw to Bank</li>
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
                            <h3 class="box-title">Withdraw Funds</h3>

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
                                    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5">
                                        <h3 class="text-bold text-danger col-sm-offset-2">Charges of @naira($charge) apply</h3>
                                        <form id="withdrawal-form" class="form-horizontal" method="post" action="{{ route('wallet.withdraw') }}">
                                            @csrf
                                            <br/>
                                            <div style="display:none; margin: 10px 10px;" id="balance" data-balance="{{ Auth::user()->balance }}">
                                                <p class="text-center well well-sm no-shadow alert-info" style="line-height:1.5;">
                                                    Your Withdrawable Balance is <strong><span style="18px">@naira(Auth::user()->balance - $charge)</span></strong>
                                                </p>
                                            </div>
                                            <div class="form-group" id="amount-field">
                                                <label class="col-sm-2 control-label">Amount</label>
                                                <div class="col-sm-10 form-grouping">
                                                    <input id="amount" type="text" class="form-control" name="amount" placeholder="Enter you want to withdraw" required>
                                                    <p id="amount-error" style="display:none;" class="help-block">Amount Exceed Withdrawable Balance</p>
                                                </div>
                                            </div>
                                            <div class="form-group" id="chooseBank">
                                                <label class="col-sm-2 control-label">Bank</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" id="bank" name="bankId">
                                                        <option value="" disabled selected>Select Our Bank </option>
                                                        @foreach ($banks as $item)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->bank_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <p class="help-block text-olive">Bank to transfer to</p>
                                                </div>
                                                <div class="col-sm-10 col-sm-offset-2">
                                                    <div class="radio" style="display:none; border: 2px solid #605ca8;">
                                                        <p class="text-center well no-shadow" style="margin:-6px 0px 0px 0px; padding: 2px 7px;">
                                                            <span class="bankName"></span><br/>
                                                            <strong><span class="accNo"></span></strong><br/>
                                                            <span class="accName"></span>
                                                        </p>
                                                    </div>
                                                </div>
                                                <br/>
                                                <br/>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-3">
                                                    <button id="submit" class="btn bg-purple btn-flat" disabled="true">Withdraw</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
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

                $('#withdrawal-form').validate({
                    rules: {
                        amount: {
                            required: true,
                            min: 500,
                            max: 500000
                        }
                    },
                    messages: {
                        amount: {
                            required: "Pls enter withdrawal amount.",
                            min: jQuery.validator.format("Minimum withdrawal amount cannot be less than ₦{0}"),
                            max: jQuery.validator.format("Miximum withdrawal amount cannot be more than ₦{0}")
                        }
                    }
                });

                $('#amount').keyup(function(){
                    var amount = $('#amount').val();
                    var balance = {{ Auth::user()->balance }};
                    var withdrawableBalance = balance - {{ $charge }};
                    if(amount > withdrawableBalance){
                        $('#amount')
                            .closest('.form-grouping')
                            .addClass('has-error');
                        $('#amount-error').show();
                    }else{
                        $('#amount')
                            .closest('.form-grouping')
                            .removeClass('has-error');
                        $('#amount-error').hide();
                    }
                });

                $('#chooseBank').change(function(){
                    let banks = @json($banks);
                    let bankDetails = banks[ $('#bank').val() - 1 ];
                    $('.radio').find('.bankName').text(bankDetails.bank_name);
                    $('.radio').find('.accNo').text(bankDetails.acc_no);
                    $('.radio').find('.accName').text(bankDetails.acc_name);
                    $('.radio').show();
                    $('#submit').removeAttr('disabled');
                });
            });

        </script>
    @endSection
