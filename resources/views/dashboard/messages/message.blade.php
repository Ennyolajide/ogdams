@extends('dashboard.layouts.master')

    @section('content-header')
        <section class="content-header">
            <h1>
                Messages<small>{{ $messages->where('read',0)->count() }} new messages</small></h1>
            <ol class="breadcrumb">
                <li>
                    <a href="#"><i class="fa fa-dashboard"></i> Home</a>
                </li>
                <li class="active">Messages</li>
            </ol>
        </section>
    @endSection

    @section('content')

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <a href="{{ route('messages.compose') }}" class="btn btn-primary btn-block margin-bottom">Contact Support</a>
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
                                    <a href="{{  route('messages.inbox') }}"><i class="fa fa-inbox"></i>              Inbox
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
                    {{--<div id="loader" style="text-align: center;">
                            <img src="../dist/img/ajax-loader.gif">
                    </div> --}}

                <div class="col-md-9" id="read" display="none">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Read Messages</h3>

                            <div class="box-tools pull-right">
                                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <div class="mailbox-read-info">
                                <h3><strong>{{ $message->subject }}</strong></h3>
                                <h5>From: {{ $message->sender->name }}
                                <span class="mailbox-read-time pull-right">{{ $message->created_at->diffForHumans() }}</span></h5>
                            </div>
                            <!-- /.mailbox-read-info -->
                            <!-- /.mailbox-controls -->
                            <div class="mailbox-read-message text-primary" style="padding: 30px; line-height:2; font-size: 16px;">
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
                            <!-- /.mailbox-read-message -->
                        </div>
                        <!-- /.box-header -->

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
                                    <div class="col-md-5">
                                        <div class="btn btn-default btn-file">
                                            <i class="fa fa-paperclip"></i> Attachment
                                            <input type="file" name="attachment">
                                        </div>

                                        <p class="help-block">Max. 50KB</p>
                                    </div>
                                    <div class="col-md-7">
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

                         <!-- /#actionFooterBox -->
                        <div id="actionFooterBox" class="box-footer">
                            <div class="col-xs-12 col-md-6">
                                <form method="POST" action="{{ route('messages.delete',$message->id) }}">
                                    @method('DELETE')
                                    @csrf
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

