@extends('dashboard.layouts.master')

    @section('content-header')
        <div class="page-title">
            <div class="title_left">
                <h4>Compose</h4>
            </div>
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-dashboard"></i> Home</a>
                    </li>
                    <li class="active">Message</li>
                </ol>
            </div>
        </div>
        <div class="clearfix"></div>
    @endsection


    @section('content')
        <!-- Main content -->
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="clearfix"></div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-3 col-xs-12 mail_list_column">
                                <a href="{{ route('messages.compose') }}" class="btn btn-success btn-block margin-bottom">COMPOSE</a>
                                <h3 class="x_title">Folders</h3>
                                <div class="box-body no-padding">
                                    <ul class="nav nav-pills nav-stacked">
                                        <li class="active">
                                            <a href="{{ route('messages.inbox') }}">
                                                <i class="fa fa-inbox"></i>
                                                    Inbox
                                                <span class="label label-primary pull-right">
                                                    {{ $messages->where('read',0)->count() }}
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-envelope-o"></i> Sent</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /.box-body -->

                            </div>

                            <div class="col-sm-9 col-xs-12 mail_view">
                                <div class="inbox-body">
                                    <div class="mail_heading row">
                                        <div class="col-md-4">
                                            <span class="h4">Compose New Message</span>
                                        </div>
                                        <div class="col-md-8 text-right">
                                            <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                                            <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
                                        </div>
                                    </div>

                                    <form id="compose-form" method="POST" action="{{ route('messages.compose') }}">
                                        <div class="box-body">
                                            @csrf
                                            <div class="form-group">
                                                @if(Auth::user()->role == 'customer')
                                                    <input class="form-control" placeholder="To : Support" disabled>
                                                @else
                                                    <input class="form-control" placeholder="To : All Customers | Rellers" disabled>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" id="subject" name="subject" placeholder="Subject:">
                                            </div>
                                            <div class="form-group">
                                                <textarea id="compose-textarea" name="content" class="form-control" style="height: 300px"></textarea>
                                            </div>

                                        </div>
                                        <br/>
                                        <!-- /.box-body -->
                                        <div class="col-md-12">
                                            <div class="pull-right">
                                                <button type="button" class="btn btn-default">
                                                    <i class="fa fa-pencil"></i> Draft
                                                </button>
                                                <button id="send" class="btn btn-primary btn-flat">
                                                    <i class="fa fa-envelope-o"></i> Send
                                                </button>
                                            </div>

                                            <button type="reset" class="btn btn-default">
                                                <i class="fa fa-times"></i> Discard
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /. box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.content -->
    @endSection

    @section('scripts')
        @if (session('response'))
            <script>alert('{{ session('response') }}');</script>
        @endif

        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.16.0/jquery.validate.min.js"></script>
        <script>
            $(function () {
                $.validator.setDefaults({
                    errorClass: 'help-block',
                    highlight: function (element) {
                        $(element)
                            .closest('.form-group')
                            .addClass('has-error');
                    },
                    unhighlight: function (element) {
                        $(element)
                            .closest('.form-group')
                            .removeClass('has-error');
                    }
                });

                $('#send').click(function(m) {
                    $('#compose-form').validate({
                        rules: {
                            message: {
                                required: true,
                                minlength: 15,
                                maxlength: 300
                            },
                            subject: {
                                required: true,
                                minlength: 5,
                                maxlength: 50
                            }
                        },
                        messages: {
                            message: {
                                required: "Message cannot be empty.",
                                minlength: jQuery.validator.format("Minimum of {0} characters required."),
                                maxlength: jQuery.validator.format("Maximum {0} characters.")
                            },
                            subject: {
                                required: "Subject cannot be empty.",
                                minlength: jQuery.validator.format("Minimum of {0} characters required."),
                                maxlength: jQuery.validator.format("Maximum {0} characters.")
                            }

                        }
                    });
                });
            });
        </script>

    @endsection
