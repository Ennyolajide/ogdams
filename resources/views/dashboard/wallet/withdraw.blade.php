
@extends('dashboard.layouts.master')
    @section('style')
        <style>
            .radio.selected{
                border: 2px solid #605ca8;
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
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                  <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Choose Bank</h3>
                        </div>
                        <div style="margin: 10px 10px;" id="balance" data-balance="{{ Auth::user()->balance }}">
                            <p class="text-center well well-sm no-shadow alert-info" style="line-height:1.5;">
                                Your Withdrawable Balance is <strong>@naira(Auth::user()->balance - $charges)</strong>
                            </p>

                    
                            <form id="withdrawal-form" method="post" action="{{ route('wallet.withdraw') }}">
                                @csrf

                                <div id="amount-field">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Amount</label>
                                        <div class="col-sm-10 form-grouping" >
                                            <input id="amount" type="text" class="form-control" name="amount" placeholder="Enter you want to withdraw" required>
                                            <p id="amount-error" style="display:none;" class="help-block">Amount Exceed Withdrawable Balance</p>
                                        </div>
                                    </div>
                                </div>  
                                <div class="continue">
                                    <br/><br/>
                                        <button id="continue" style="margin:20px 0px;" class="btn bg-purple btn-block btn-flat">Continue</button>
                                    <br/>
                                </div>
                                <div class="radio-group" style="display:none;">
                                    @foreach ($banks as $bank)
                                        <div class='radio' data-value="{{ $bank->id }}">
                                            <p class="text-center well well-sm no-shadow" style="margin-bottom:5px;">
                                                {{ $bank->bank_name }}<br/>
                                                <strong>{{ $bank->acc_no }}</strong><br/>
                                                {{ $bank->acc_name }}
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                                <input id="bank" type="hidden" name="bank_id"/>
                                <button id="submit" style="margin:20px 0px; display:none;" class="btn bg-purple btn-block btn-flat" disabled="disabled">Withdraw</button>
                            </form>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

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


                $('#amount').keyup(function(){
                    var amount = $('#amount').val();
                    var balance = $('#balance').data('balance');
                    var withdrawableBalance = balance - {{ $charges }};
                    if(amount > withdrawableBalance){
                        $('#amount')
                            .closest('.form-grouping')
                            .addClass('has-error');
                        $('#amount-error').show();
                        $('#continue').attr('disabled','disabled');
                    }else{
                        $('#amount')
                            .closest('.form-grouping')
                            .removeClass('has-error');
                        $('#amount-error').hide();
                        $('#continue').removeAttr('disabled');
                    }
                });
                $('#continue').click(function(e){
                    e.preventDefault();
                    $('.radio-group,#submit').show();
                    $('#continue').hide();
                    //$('#amount').attr('disabled','disabled');
                });
                $('.radio-group .radio').click(function(){
                    $(this).parent().find('.radio').removeClass('selected');
                    $(this).addClass('selected');
                    var val = $(this).attr('data-value');
                    $('#bank').val(val);
                    if($(this).hasClass('selected')){
                        $('#submit').removeAttr('disabled');
                    }
                });
                $('#submit').click(function() {
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
                });
            });

        </script>
    @endSection
