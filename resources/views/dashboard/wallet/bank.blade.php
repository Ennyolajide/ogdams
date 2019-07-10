
@extends('dashboard.layouts.master')
    @section('style')

    @endsection

    @section('content-header')
        <section class="content-header">
            <h1>Fund Wallet (Bank)</h1>
            <ol class="breadcrumb">
                <li>
                    <a href="#"><i class="fa fa-dashboard"></i> Home</a>
                </li>
                <li class="active">Fund Wallet (Bank)</li>
            </ol>
        </section>
    @endsection

    @section('content')
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- TABLE: LATEST ORDERS -->
                    <div class="box box-purple">
                        <div class="box-header with-border">
                            <h3 class="box-title">Fund Wallet (Bank)</h3>

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
                                    <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">

                                        <form class="form-horizontal" method="post" action="{{ route('wallet.fund.bank.action') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Depositor</label>
                                                <div class="col-sm-10 form-grouping">
                                                    <input type="text" class="form-control" name="depositor" value="" required>
                                                    <p class="help-block">Enter depositor name or account name.</p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Amount</label>
                                                <div class="col-sm-10 form-grouping">
                                                    <input type="text" class="form-control" name="amount" value="{{ $amount }}" required>
                                                    <p class="help-block">Enter amount deposit / transfer amount</p>
                                                </div>
                                            </div>
                                            <div class="form-group" id="chooseBank">
                                                <label class="col-sm-2 control-label">Bank</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" id="bank" name="network">
                                                        <option value="" disabled selected>Select Our Bank </option>
                                                        @foreach ($banks as $item)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->bank_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <p class="help-block">Bank to transfer to</p>
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
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Reference / Teller</label>
                                                <div class="col-sm-10 form-grouping">
                                                    <input type="text" class="form-control" name="amount" value="" required>
                                                    <p class="help-block">Enter amount reference / teller</p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Remarks</label>
                                                <div class="col-sm-10 form-grouping">
                                                    <textarea name="remarks" class="form-control" style="height: 80px"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-offset-2 col-sm-3">
                                                <button id="submit" type="submit" class="btn bg-purple btn-flat">Submit</button>
                                            </div>

                                        </form>
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

    @endsection

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

                $('#chooseBank').change(function(){
                    let banks = @json($banks);
                    let bankDetails = banks[ $('#bank').val() - 1 ];

                    $('.radio').find('.bankName').text(bankDetails.bank_name);
                    $('.radio').find('.accNo').text(bankDetails.acc_no);
                    $('.radio').find('.accName').text(bankDetails.acc_name);
                    $('.radio').show();
                });
            });

        </script>
    @endSection
