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
                                    <a href="#">
                                        <i class="fa fa-inbox"></i>
                                            Inbox
                                        <span class="label label-primary pull-right">
                                            {{ $messages->where('read',0)->count() }}
                                        </span></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-envelope-o"></i> Sent</a>
                                </li>
                                <li></li>
                                <li>
    </li>
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
                <div class="col-md-9">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Inbox</h3>
                            <div class="box-tools pull-right">
                                <div class="has-feedback">
                                    <input type="text" class="form-control input-sm" placeholder="Search Mail">
                                    <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                </div>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <div class="mailbox-controls">
                                <!-- Check all button -->
                                <button type="button" class="btn btn-default btn-sm checkbox-toggle">
                                    <i class="fa fa-square-o"></i>
                                </button>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                    <button type="button" class="btn btn-default btn-sm">
                                        <i class="fa fa-reply"></i>
                                    </button>
                                    <button type="button" class="btn btn-default btn-sm">
                                        <i class="fa fa-share"></i>
                                    </button>
                                </div>
                                <!-- /.btn-group -->
                                <button type="button" class="btn btn-default btn-sm">
                                    <i class="fa fa-refresh"></i>
                                </button>

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
                                <!-- /.pull-right -->
                            </div>
                            <div class="table-responsive mailbox-messages">
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
                            <!-- /.mail-box-messages -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer no-padding">
                            <div class="mailbox-controls">
                                <!-- Check all button -->
                                <button type="button" class="btn btn-default btn-sm checkbox-toggle">
                                    <i class="fa fa-square-o"></i>
                                </button>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                    <button type="button" class="btn btn-default btn-sm">
                                        <i class="fa fa-reply"></i>
                                    </button>
                                    <button type="button" class="btn btn-default btn-sm">
                                        <i class="fa fa-share"></i>
                                    </button>
                                </div>
                                <!-- /.btn-group -->
                                <button type="button" class="btn btn-default btn-sm">
                                    <i class="fa fa-refresh"></i>
                                </button>

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
                                <!-- /.pull-right -->
                            </div>
                        </div>
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
