@extends('dashboard.layouts.master')

    @section('content-header')
        <section class="content-header">
            <h1>Compose</h1>
            <ol class="breadcrumb">
                <li>
                    <a href="#"><i class="fa fa-dashboard"></i> Home</a>
                </li>
                <li class="active">Messages</li>
            </ol>
        </section>
    @endsection

    @section('content')
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <a href="compose" class="btn btn-primary btn-block margin-bottom">Support</a>
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Folders</h3>
                            <div class="box-tools">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body no-padding">
                            <ul class="nav nav-pills nav-stacked">
                                <li class="active">
                                    <a href="{{ route('messages.inbox') }}">
                                        <i class="fa fa-inbox"></i> Inbox
                                        <span class="label label-primary pull-right">
                                            {{ $messages->where('read',0)->count() }}
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-envelope-o"></i> Sent</a>
                                </li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /. box -->
                    <div class="box box-solid">
                        <div class="box-body no-padding">
                            <ul class="nav nav-pills nav-stacked">
                                <li></li>
                                <li></li>
                            </ul>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->

                <!-- /.col -->
                <div class="col-md-9" id="compose">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Compose New Message</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form id="compose-form" method="POST" action="{{ route('messages.compose') }}">
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
                                <div class="form-group">
                                    <div class="col-md-5">
                                        <div class="btn btn-default btn-file">
                                            <i class="fa fa-paperclip"></i> Attachment
                                            <input type="file" name="attachment">
                                        </div>

                                        <p class="help-block">Max. 50KB</p>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="pull-right" id="result">


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
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
                            </form>
                        </div>

                        <!-- /.box-footer -->
                    </div>
                    <!-- /. box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
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
