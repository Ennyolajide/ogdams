@extends('dashboard.layouts.master')


    @section('content-header')
        <div class="page-title">
            <div class="title_left">
                <h4>Bitcoin</h4>
            </div>
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li class="active">Bitcoin</li>
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
                            <h2>{{ ucwords($action->action) }} Bitcoin</h2>
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
                                            <h3 class="text-danger text-center"><strong>We {{ $action->action }} @naira($action->rate)/$ </strong></h3>
                                        </div>
                                        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5  pull-right">
                                            <br/>
                                            <img style="height: 80px; width:100px; margin-right:5px;" src="\images/{{ $action->logo }}" class="pull-right">
                                        </div>
                                    </div>
                                    <form id="bitcoin-form" class="form-horizontal">
                                        @csrf
                                        <br/>
                                        <div class="form-group">
                                            <label class="col-sm-2 col-xs-12 control-label">Action</label>
                                            <div class="col-sm-10 col-xs-12 form-grouping text-bold">
                                                <select style="height: 40px;" class="form-control">
                                                    <option  selected><strong>{{ $action->action }} Bitcoin</strong></option>
                                                </select>
                                            </div>
                                        </div>
                                        <br/>

                                        <div class="form-group">
                                            <label class="col-sm-2 col-xs-12 control-label">Amount</label>
                                            <div class="col-sm-10 col-xs-12 form-grouping">
                                                <input type="text" id="amount" value="" class="form-control" name="amount" placeholder="Enter amount" required>
                                            </div>
                                        </div>
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
        @php $link = 'https://wa.me/'.$action->contact.'?text='.urlencode('Hi Admin, I want to '.$action->action.' $' ) ;@endphp
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
                    let url = '{{ $link }}'+ $('#amount').val() + ' worth of bitcoin';
                    $(location).attr('href', url);
                });
            });
        </script>
    @endSection
