@extends('dashboard.layouts.master')

    @section('content-header')
        <div class="page-title">
            <div class="title_left">
                <h4>Bulk Sms</h4>
            </div>
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-dashboard"></i> Home</a>
                    </li>
                    <li class="active">Sms</li>
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
                        <h2>Pay Bills</h2>
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
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <br/>
                                <form id="send-bulk-sms-form" method="POST" action="">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-xs-12 control-label">Package</label>
                                        <div class="col-sm-8 col-xs-12 form-grouping text-bold">
                                            <select style="height: 40px;" class="form-control" id="route" name="route">
                                                <option value="" disabled selected><strong>Choose Sms Type</strong></option>
                                                @foreach ($smsConfigs as $smsConfig)
                                                    <option value="{{ $smsConfig }}">

                                                        {{ $smsConfig->route }} =
                                                        <span class="pull-right">
                                                            @if($smsConfig->amount_per_unit == 0 )
                                                                @foreach ($smsConfigs as $item)
                                                                    @continue($item->amount_per_unit == 0 )
                                                                    @naira($item->amount_per_unit / 100)
                                                                    @if($loop->first) / @endif
                                                                @endforeach
                                                            @else
                                                                @naira($smsConfig->amount_per_unit / 100)
                                                            @endif
                                                            Per Page Per Sms
                                                        </span>
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-xs-12 control-label">Sender Id</label>
                                        <div class="col-sm-8 col-xs-12 form-grouping">
                                            <input type="text" class="form-control" name="senderId" placeholder="Enter Sender Id" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-xs-12 control-label">Recepient</label>
                                        <div class="col-sm-8 col-xs-12 form-grouping">
                                            <textarea placeholder="Enter recepient number seperate by space or comma" id="recepients" name="recepients" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 2px solid #dddddd; padding: 10px;" disabled="true">07063637002</textarea>
                                            <div class="">
                                                <p id="numbers" class="pull-left text-success" style="font-size:18px"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-xs-12  control-label">Message</label>
                                        <div class="col-sm-8 col-xs-12  form-grouping">
                                            <textarea placeholder="Enter message" id="message" name="message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 2px solid #dddddd; padding: 10px;" disabled="true">{{ $faker->paragraph(3) }}</textarea>
                                            <div class="count">
                                                <p id="characters" class="pull-left text-success" style="font-size:18px"></p>
                                                <p id="pages" class="pull-right text-success" style="font-size:18px"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-xs-12 control-label"></label>
                                        <div class="col-sm-8 col-xs-12 form-grouping">
                                            <button id="continue" class="btn bg-purple btn-flat pull-right" disabled="true" type="submit">Send
                                                <i class="fa fa-arrow-circle-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <input type="hidden" id="smsPages">
                                    <input type="hidden" id="totalNumbersOfRecepient">
                                    <br/>
                                </form>
                                <!--/div-->
                            </div>
                        </div>
                        @include('dashboard.layouts.errors')
                    </div>

                    <!-- /.box-body -->

                    <!-- .box-footer -->
                    @include('dashboard.layouts.box-footer')
                    <!-- /.box-footer -->
                    <!-- /.box -->
                </div>
            </div>

            <!--Modal-->
            <div id="confirm-modal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">X</span>
                            </button>
                            <h4 class="modal-title">Confirm</h4>
                        </div>
                        <div class="modal-body">
                            <p style="font-size:18px;" class="text-bold text-center">You will be charge ₦<span id="total-charges"></span> <span id="both" style="display: none;"> or less due to variation in Basic & Corperate Route</span></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="button" id="sendSms" class="btn btn-primary">Send Sms</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /Modal-->


        </div>
    </div>
    @endSection

    @if(session('modal'))
        <!-- /Modal -->
        <div id="response-modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Response</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row" style="font-size: 20px;">
                            <div class="col-md-5 col-xs-5 col-xs-offset-1 col-sm-offset-1 col-md-offset-1">
                                <small> Unit Used: </small>
                                <span class="text-bold text-success">{{ session('modal')->units_used }}</span>
                            </div>
                            <div class="col-md-5 col-xs-6 col-sm-offset-1 col-md-offset-1">
                                <small> No. of Page(s) </small>
                                <span class="text-bold text-success">{{ session('modal')->sms_pages }}</span>
                            </div>
                            <div class="col-md-5 col-xs-5 col-xs-offset-1 col-sm-offset-1 col-md-offset-1">
                                <small>Basic Unit  : </small>
                                <span class="text-bold text-success">{{ session('modal')->basic_units }}</span>
                            </div>
                            <div class="col-md-5 col-xs-6 col-sm-offset-1 col-md-offset-1">
                                <small> Corp. Unit : </small>
                                <span class="text-bold text-success">{{ session('modal')->corp_units }}</span>
                            </div>
                            <div class="col-md-11 col-xs-11 text-center">
                                <fieldset>
                                <small class="text-bold">Successful</small>
                                <p class="h6 text-bold text-primary">
                                    {{ session('modal')->successful }}
                                </p>
                                </fieldset>
                            </div>

                            <div class="col-md-11 col-xs-11 text-center">
                                <small class="text-bold">DnD Numbers </small>
                                <p class="h6 text-bold text-primary">
                                    {{ session('modal')->realtime_dnd }}
                                </p>
                            </div>
                            <div class="col-md-11 col-xs-11 text-center">
                                <small class="text-bold">Invalid Numbers </small>
                                <p class="h6 text-bold text-dnager">
                                    {{ session('modal')->invalid }}
                                </p>
                            </div>
                            <div class="col-md-11 col-xs-11 text-center">
                                <small class="text-bold">Transaction Reference :</small>
                                <p class="h4"><b> {{ session('modal')->ref_id }} </b></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Modal -->
    @else
        <!-- Modal -->
        <div id="info-modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title text-orange text-bold">Important Info</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row" style="font-size: 20px;">
                            @foreach ($smsConfigs as $smsConfig)
                                <div class="col-md-12 col-xs-12 ">
                                    <p class="text-bold text-olive text-center">
                                        <u>
                                            @if($smsConfig->amount_per_unit > 0)
                                                {{ $smsConfig->route }} @naira($smsConfig->amount_per_unit / 100)  / Sms / Page
                                            @else
                                                {{ str_replace('( DND and Non DND )',' ',$smsConfig->route) }} @naira($smsConfigs[0]->amount_per_unit / 100) for non DND |
                                                @naira($smsConfigs[2]->amount_per_unit / 100) for DND  / Sms / Page

                                            @endif
                                        </u>
                                    </p>
                                    <p class="text-center"><small>{{ $smsConfig->description }}</small></p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
        <!-- /Modal -->
    @endif

    @section('scripts')
        <script src="/js/jquery-number.min.js"></script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.16.0/jquery.validate.min.js"></script>
        <script>
            $(document).ready(function() {
                const characterPerPage = 160;

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

                $('#misc-bill-form').validate({
                    rules: {
                        route: { required: true },
                        amount: { required: true },
                        email: { required: true, email: true, minlength: 7, maxlength: 50 },
                        phone: { required: true, minlength: 10, maxlength: 13 }
                    },
                    messages: {
                        route: { required: 'Pls choose your prefered package' },
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

                $('#route').change(function() {
                    let route = JSON.parse($(this).val());
                    $('#recepients').removeAttr('disabled');
                });

                $('#recepients').keyup(function(){
                    let numbers = $(this).val().split(',').length;
                    $('#totalNumbersOfRecepient').val(numbers);
                    $('#numbers').text('Total recepients ' +numbers+ ' number(s)');
                    numbers > 0 ? $('#message').removeAttr('disabled') : false;
                });

                //console.log(routeSelected);

                $('#message').keyup(function() {
                    let length = $(this).val().length;
                    let smsPages = Math.ceil(length / characterPerPage);
                    $('#smsPages').val(smsPages);
                    smsPages > 0 ? $('#continue').removeAttr('disabled') : false;
                    $('.count').find('#characters').text(length + ' character(s)');
                    $('.count').find('#pages').text(smsPages + ' page(s)');

                });

                $('#continue').click(function(f) {
                    f.preventDefault();
                    $('#both').hide();
                    let smsPages = $('#smsPages').val();
                    let route = JSON.parse($('#route').val());
                    let amountPerSms = route.amount_per_unit / 100;
                    let amount = amountPerSms == 0 ? 4 : amountPerSms;
                    let numbers = $('#totalNumbersOfRecepient').val();
                    let totalCharges = (amountPerSms == 0 ? 4 : amountPerSms) * numbers * smsPages;
                    $('#total-charges').text($.number(totalCharges));
                    amountPerSms == 0 ? $('#both').show() : false;
                    totalCharges > 0 ? $('#confirm-modal').modal('show') : false;
                });

                $('#sendSms').click(function(){
                    $('#send-bulk-sms-form').submit();
                });

            });
        </script>
        @if(!session('modal'))
            <script>
                $(document).ready(function() {
                    $('#info-modal').modal('show');
                });
            </script>
        @endif

    @endSection
