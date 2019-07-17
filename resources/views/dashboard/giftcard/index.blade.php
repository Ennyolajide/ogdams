@extends('dashboard.layouts.master')


    @section('content-header')
        <div class="page-title">
            <div class="title_left">
                <h4>Gift Card</h4>
            </div>
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li class="active">Gift Card</li>
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
                            <h2>Sell Gift Card</h2>
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
                                        <h3 class="text-danger text-center"><strong>Please follow the instruction below: </strong></h3>


                                        <p>When you contact us , please upload a clear card showing the price, if your card has no price on it please provide the receipt </p>
                                        <p>
                                            Please follow the instruction below:

                                            When you contact us , please upload a clear card showing the price, if your card has no price on it please provide the receipt

                                            Please be patient when you send your card. At this stage we are verifying that your card is valid and usable , please we do not make payment for used or none activated cards. </p>
                                        <p>
                                            At this stage your card has been verified to be valid and usable , we will request for your prefered bank account and make payment to the Naira bank account which you have provided, our payments are instant and swift.
                                        </p>
                                        <form class="form-horizontal">
                                            <br/>
                                            <div class="form-group">
                                                <div class="col-xs-12">
                                                    <button id="proceed" type="submit" class="btn bg-purple btn-flat pull-right">Proceed</button>
                                                </div>
                                            </div>
                                            <br/><br/>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @include('dashboard.layouts.errors')
                        </div>
                        @include('dashboard.layouts.box-footer')
                    </div>
                </div>
                 <!-- /.box -->
            </div>
        </div>
    @endSection

    @section('scripts')
        @php $link = 'https://wa.me/'.$action->contact.'?text='.urlencode('Hi Admin, I want to transact gift card');@endphp
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

                $('#bitcoin-form').validate({
                    rules: {
                        amount: { required: true },
                    },
                    messages: {
                        amount: { required: 'Bill amount cannot be blank' },
                    }
                });

                $('#proceed').click(function(e){
                    e.preventDefault();
                    let url = '{{ $link }}';
                    $(location).attr('href', url);
                });
            });
        </script>
    @endSection
