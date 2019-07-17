@extends('dashboard.layouts.master')

    @section('content-header')
        <div class="page-title">
            <div class="title_left">
                <h4>{{ $messages->where('read',0)->count() }} new messages</h4>
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
                                                <span class="label label-primary pull-right text-bold">
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

                            <div class="col-sm-9 mail_view">
                                <div class="inbox-body">
                                    <div class="mail_heading row">

                                        <div class="col-md-8">
                                           <div class="btn-group">
                                                <button class="btn btn-sm btn-primary" type="button"><i class="fa fa-reply"></i> Reply</button>
                                                <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Forward"><i class="fa fa-share"></i></button>
                                                <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Print"><i class="fa fa-print"></i></button>
                                                <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Trash"><i class="fa fa-trash-o"></i></button>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-right">
                                            <p class="date">{{ $message->created_at->diffForHumans() }}</p>
                                        </div>
                                        <div class="col-md-12">
                                            <h4 class="text-bold"> {{ $message->subject }}</h4>
                                        </div>
                                    </div>
                                    <div class="sender-info">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <strong>From: {{ $message->sender->name }}</strong>
                                                <span>(<a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="69030607470d060c290e04080005470a0604">[email&#160;protected]</a>)</span> to
                                                <strong>me</strong>
                                                <a class="sender-dropdown"><i class="fa fa-chevron-down"></i></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="view-mail" style="padding: 30px; line-height:2; font-size: 16px;">
                                        @if($message->repliedMessage)
                                            To : me
                                            <br/>
                                            {{ $message->repliedMessage->content }}
                                            <div class="mailbox-read-message">
                                                To : {{ $message->sender->name }}
                                                <br/>
                                                {{ $message->content }}
                                            </div>
                                            <br/>
                                        @else
                                            {{ $message->content }}
                                        @endif
                                    </div>

                                    <!-- /#replyBox -->
                                    <div id="replyBox" class="box-body" style="display: none">
                                        <form id="reply-form" method="POST" action="{{ route('messages.reply',$message->id) }}">
                                            @csrf
                                            <div class="form-group">
                                                <input class="form-control" id="subject" name="subject" value="Re: {{ $message->subject }}">
                                            </div>
                                            <div class="form-group">
                                                <i class="fa fa-reply"></i> {{ $message->sender->name }}
                                            </div>
                                            <div class="form-group">
                                                <textarea id="compose-textarea" name="content" class="form-control" style="height: 200px"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <div class="pull-right">
                                                        <button type="reset" class="btn btn-default">
                                                            <i class="fa fa-pencil"></i> Discard
                                                        </button>
                                                        <button id="send" class="btn btn-primary btn-flat">
                                                            <i class="fa fa-envelope-o"></i> Send
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /#replyBox -->

                                    <br/>


                                    <div class="col-xs-12 col-md-6">
                                        <form method="POST" action="{{ route('messages.delete',$message->id) }}">
                                            @method('DELETE') @csrf
                                            <button type="submit" class="btn btn-default">
                                                <i class="fa fa-trash-o"></i> Delete
                                            </button>
                                            <button type="button" class="btn btn-default">
                                                <i class="fa fa-print"></i> Print
                                            </button>
                                        </form>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <div class="pull-right">
                                            <button id="reply" type="button" class="btn btn-default">
                                                <i class="fa fa-reply"></i> Reply
                                            </button>
                                            <button type="button" class="btn btn-default">
                                                <i class="fa fa-share"></i> Forward
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- /#actionFooterBox -->
                            </div>
                            <!-- /. box -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
        </div>
        <!-- /.content -->

    @endSection

    @section('scripts')

        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.16.0/jquery.validate.min.js"></script>
        <script>
            $(function () {
                $('#reply').click(function(){
                    $('#replyBox').toggle('slow');
                    $('#actionFooterBox').hide();
                });
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
                    $('#reply-form').validate({
                        rules: {
                            content: {
                                required: true,
                                minlength: 30,
                                maxlength: 300
                            },
                            subject: {
                                required: true,
                                minlength: 5,
                                maxlength: 50
                            }
                        },
                        messages: {
                            content: {
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

