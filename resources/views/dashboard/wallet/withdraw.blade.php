
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
    <div class="page-title">
        <div class="title_left">
            <h4>Withdraw to Bank</h4>
        </div>
        <div class="pull-right">
            <ol class="breadcrumb">
                <li>
                    <a href="#"><i class="fa fa-dashboard"></i> Dashboard</a>
                </li>
                <li class="active">Withdraw to Bank</li>
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
                    <h2>Withdraw funds</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
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
                                <br/>
                                <div class="form-group" id="amount-field">
                                    <label class="col-sm-3 col-xs-12 control-label">Amount</label>
                                    <div class="col-sm-9 col-xs-12 form-grouping">
                                        <input id="amount" type="text" class="form-control" name="amount" placeholder="Enter you want to withdraw" required>
                                        <p id="amount-error" style="display:none; font-size:14px;" class="orange">Amount Exceed Withdrawable Balance</p>
                                    </div>
                                </div>
                                <br/>
                                <div class="form-group" id="chooseBank">
                                    <label class="col-sm-3 col-xs-12 control-label">Bank</label>
                                    <div class="col-sm-9 col-xs-12">
                                        <select class="form-control" id="bank" name="bank">
                                            <option value="" disabled selected>Select Our Bank </option>
                                            @foreach ($banks as $item)
                                                <option value="{{ $loop->index }}">
                                                    {{ $item->bank_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" id="bankId" name="bankId">
                                        <p class="help-block blue font-size:14px;">Bank to transfer to</p>
                                    </div>
                                    <div class="col-sm-9  col-xs-12 col-sm-offset-3">
                                        <div class="radio" style="display:none; border: 2px solid #605ca8;">
                                            <p class="text-center well no-shadow" style="margin:-6px 0px 0px 0px; padding: 2px 7px;">
                                                <span class="bankName"></span><br/>
                                                <strong><span class="accNo"></span></strong><br/>
                                                <span class="accName"></span>
                                            </p>
                                        </div>
                                    </div>
                                    <br/>
                                </div>
                                <br/>
                                <div class="form-group">
                                    <div class="col-sm-12 col-xs-12">
                                        <button id="submit" class="btn btn-success btn-flat pull-right" disabled="true">Withdraw</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @include('dashboard.layouts.errors')
                </div>
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
            $.validator.setDefaults({
                errorClass: 'help-block',
                highlight: function (element) {
                    $(element)
                        .closest('.form-grouping')
                        .addClass('orange');
                },
                unhighlight: function (element) {
                    $(element)
                        .closest('.form-grouping')
                        .removeClass('orange');
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
                        .addClass('orange');
                    $('#amount-error').show();
                }else{
                    $('#amount')
                        .closest('.form-grouping')
                        .removeClass('orange');
                    $('#amount-error').hide();
                }
            });

            $('#bank').change(function(){
                let banks = @json($banks);
                let bankDetails = banks[ $('#bank').val() ];
                console.log(bankDetails);
                $('#bankId').val(bankDetails.id);
                $('.radio').find('.bankName').text(bankDetails.bank_name);
                $('.radio').find('.accNo').text(bankDetails.acc_no);
                $('.radio').find('.accName').text(bankDetails.acc_name);
                $('.radio').show();
                $('#submit').removeAttr('disabled');
            });
        });

    </script>
@endSection
