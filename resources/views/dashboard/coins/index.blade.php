@extends('dashboard.layouts.master')

    @section('content-header')
        <section class="content-header">
            <h1>Transact Coins</h1>
            <ol class="breadcrumb">
                <li>
                    <a href="#"><i class="fa fa-dashboard"></i> Home</a>
                </li>
                <li class="active">Coins</li>
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
                            <h3 class="box-title">Transact Coin</h3>

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
                                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7">
                                        <div class="row">
                                            <div class="col-sm-6 block-center">
                                                <img class="img-responsive" src="/images/coins/buy-button.jpg"><br/>
                                                @foreach($coins as $coin)
                                                    <h4 class="text-center text-bold">{{ $coin->name }} : {{ $coin->buy_rate }}</h4>
                                                @endforeach
                                            </div>
                                            <div class="col-sm-6 block-center">
                                                <img class="img-responsive" src="/images/coins/sell-button.jpg"><br/>
                                                @foreach($coins as $coin)
                                                    <h4 class="text-center text-bold">{{ $coin->name }} : {{ $coin->sell_rate }}</h4>
                                                @endforeach
                                            </div>
                                        </div>
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

                $('#coin').change(function() {
                    var coin = $('#coin').val();
                    console.log(coin);

                    if(coin == 1){
                        $('#coinImages,.ethereum').hide();
                        $('.bitcoin,.otherFields').show();
                    }else if(network == 2){
                        $('#coinImages,.bitcoin').hide();
                        $('.ethereum,.otherFields').show();
                    }else{
                        $('.mtn,.bitcoin,.ethereum,.otherFields').hide();
                        $('#coinImages').show();
                    }

                });

                $('#submit').click(function() {
                    $('#coin-option-form').validate({
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
