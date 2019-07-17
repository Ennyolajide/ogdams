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

                            <div class="col-sm-9 col-xs-12 mail_view">
                                <div class="inbox-body">
                                    <div class="mail_heading row">
                                        <div class="col-md-9">
                                            <span class="h4">Inbox</span>
                                        </div>
                                        <div class="col-md-3 text-right">
                                            <div class="pull-right">
                                                @if ($messages->hasPages())
                                                    {{ $messages->firstItem() }} - {{ $messages->lastItem() }}/{{ $messages->total() }}
                                                    <div class="btn-group">
                                                        {{-- Previous Page Link --}}
                                                        @if (!$messages->onFirstPage())
                                                            <button type="button" class="previousPage btn btn-default btn-sm">
                                                                <i class="fa fa-chevron-left"></i>
                                                            </button>
                                                        @endif
                                                        {{-- Next Page Link --}}
                                                        @if ($messages->hasMorePages())
                                                            <button type="button" class="nextPage btn btn-default btn-sm">
                                                                <i class="fa fa-chevron-right"></i>
                                                            </button>
                                                        @endif

                                                    </div>
                                                    <!-- /.btn-group -->
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                    <br/>
                                    <div class="mailbox-messages">
                                        <table class="table table-hover table-striped">
                                            <tbody>
                                            @foreach ($messages as $message)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox">
                                                    </td>
                                                    <td class="mailbox-star">

                                                        @if ($message->read)
                                                            <a href="#"><i class="fa fa-star-o text-yellow"></i></a>
                                                        @else
                                                            <a href='#'><i class='fa fa-star text-yellow'></i></a>
                                                        @endif


                                                    </td>

                                                    <td class="mailbox-name">
                                                        <a href="/dashboard/inbox/{{ $message->id }}" class="submit" type="submit">

                                                        {{ $message->sender->name }}</a>

                                                </form>
                                                    </td>
                                                    <td class="mailbox-subject">
                                                        <b>{{ $message->subject }}</b> -
                                                        <a href="{{ route('messages.message',$message->id) }}">{{ str_limit($message->content,100,'...') }}</a></td>
                                                    <td class="mailbox-attachment"></td>
                                                    <td class="mailbox-date">{{ $message->created_at->diffForHumans() }}</td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                        <!-- /.table -->
                                    </div>


                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="btn-group">
                                                <button class="btn btn-sm btn-primary" type="button"><i class="fa fa-reply"></i> Reply</button>
                                                <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Forward"><i class="fa fa-share"></i></button>
                                                <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Print"><i class="fa fa-print"></i></button>
                                                <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Trash"><i class="fa fa-trash-o"></i></button>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="text-right">
                                                @if ($messages->hasPages())
                                                    {{ $messages->firstItem() }} - {{ $messages->lastItem() }}/{{ $messages->total() }}
                                                    <div class="btn-group">
                                                        {{-- Previous Page Link --}}
                                                        @if (!$messages->onFirstPage())
                                                            <button type="button" class="previousPage btn btn-default btn-sm">
                                                                <i class="fa fa-chevron-left"></i>
                                                            </button>
                                                        @endif
                                                        {{-- Next Page Link --}}
                                                        @if ($messages->hasMorePages())
                                                            <button type="button" class="nextPage btn btn-default btn-sm">
                                                                <i class="fa fa-chevron-right"></i>
                                                            </button>
                                                        @endif

                                                    </div>
                                                    <!-- /.btn-group -->
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endSection

    @section('scripts')
        @if (session('response'))
            <script>alert('{{ session('response') }}');</script>
        @endif

        <script>
        $(function() {
            $('.previousPage').click( function(){
                window.location.href='{{ $messages->previousPageUrl() }}';
            });

            $('.nextPage').click( function(){
                window.location.href='{{ $messages->nextPageUrl() }}';
            });
        });
        </script>

    @endSection
