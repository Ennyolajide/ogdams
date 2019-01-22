
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
            <h1>Fund Wallet With Bank</h1>
            <ol class="breadcrumb">
                <li>
                    <a href="#"><i class="fa fa-dashboard"></i> Home</a>
                </li>
                <li class="active">Fund Wallet With Bank</li>
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
                        <div style="margin: 10px 10px;">
                            <p class="text-center well well-sm no-shadow alert-info" style="line-height:1.5;">
                                Make a mobile transfer or bank deposit of @naira(session('amount')) to the selected preferred bank using ogmd as narrator, description or remarks.
                                <br/>
                                Use the "SUBMIT" button, once you have successfully made a payment

                            </p>
                            <form method="post" action="{{ route('wallet.fund.bank') }}">
                                @csrf
                                <div class="radio-group">
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
                                <button id="continue" style="margin:20px 0px;" class="btn bg-purple btn-block btn-flat" disabled="disabled">Continue</button>
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

                $('.radio-group .radio').click(function(){
                    $(this).parent().find('.radio').removeClass('selected');
                    $(this).addClass('selected');
                    var val = $(this).attr('data-value');
                    $('#bank').val(val);
                    if($(this).hasClass('selected')){
                        $('#continue').removeAttr('disabled');
                    }
                });
            });

        </script>
    @endSection
