@extends('dashboard.layouts.master')

@section('css')
      <!-- DataTables -->
  <link rel="stylesheet" href="\bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endsection

@section('content-header')

    <!-- Content Header (Page header) -->
    @section('content-header')
        <div class="page-title">
            <div class="title_left">
                <h4>Transaction</h4>
            </div>
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li class="active">Transactions</li>
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
                        <h2>My Transcations</h2>
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
                                <table id="transactions-table" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th class="hidden-xs">Reference</th>
                                            <th>Amount</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th class="hidden-xs">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            function getStatus($status){
                                                $array = ['Declined','Pending','Success','Canceled'];
                                                return $status ? $array[$status] : 'Decline';
                                            }
                                        @endphp

                                        @foreach ($transactions as $transaction)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td class="hidden-xs">{{ str_limit($transaction->reference, 10, '...') }}</td>
                                                <td class="text-right">@naira($transaction->amount)</td>
                                                <td>{{ $transaction->class->type }}</td>

                                                <td>{{ getStatus($transaction->status) }}</td>
                                                <td class="hidden-xs">{{ $transaction->created_at }}</td>
                                                <td>
                                                <a href="#" data-toggle="modal" data-target="#{{ $transaction->id }}">
                                                        <i class="fa fa-eye"></i>view
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>


                                </table>
                                <div class="col-md-12">
                                    <div class="text-right">
                                        @if ($transactions->hasPages())
                                            {{ $transactions->firstItem() }} - {{ $transactions->lastItem() }}/{{ $transactions->total() }}
                                            <div class="btn-group">
                                                {{-- Previous Page Link --}}
                                                @if (!$transactions->onFirstPage())
                                                    <button type="button" class="previousPage btn btn-default btn-sm">
                                                        <i class="fa fa-chevron-left"></i>
                                                    </button>
                                                @endif
                                                {{-- Next Page Link --}}
                                                @if ($transactions->hasMorePages())
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
                        @include('dashboard.layouts.errors')
                    </div>
                    <!-- /.box-body -->

                    <!-- .box-footer -->
                    @include('dashboard.layouts.box-footer')
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
      <!-- /.content -->
      @foreach ($transactions as $transaction)
        <!-- Modal -->
        <div id="{{ $transaction->id }}" class="modal fade" role="dialog">
            <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">View transaction</h4>
                </div>
                <div class="modal-body">
                    <div class="row" style="font-size: 20px;">
                        <div class="col-md-5 col-xs-11  col-xs-offset-1 col-sm-offset-1 col-md-offset-1">
                            <small>Transaction Reference :</small>
                            <p class=""><b> {{ '7e38yrb8383hnfj8f8' }} </b></p>
                        </div>
                        <div class="col-md-5 col-xs-11 col-xs-offset-1 col-sm-offset-1 col-md-offset-1">
                            <small>Transaction Type : </small>
                            <p class=""><b> {{ $transaction->class->type }} </b></p>

                        </div>
                        <div class="col-md-5 col-xs-11 col-xs-offset-1 col-sm-offset-1 col-md-offset-1">
                           <small>Transaction Amount : </small>
                            <p class=""><b>@naira($transaction->amount) </b></p>
                        </div>
                        <div class="col-md-5 col-xs-11 col-xs-offset-1 col-sm-offset-1 col-md-offset-1">
                            <small> Before : </small>
                            <p class=""><b>@naira($transaction->balance_before) </b></p>
                        </div>
                        <div class="col-md-5 col-xs-11 col-xs-offset-1 col-sm-offset-1 col-md-offset-1">
                            <small>Balance After : </small>
                            <p class=""><b>@naira($transaction->balance_after)</b></p>
                        </div>
                        <div class="col-md-5 col-xs-11 col-xs-offset-1 col-sm-offset-1 col-md-offset-1">
                            <small>Transaction Status </small>
                            <p class=""><b> {{ getStatus($transaction->status) }} </b></p>
                        </div>


                    </div>
                </div>
                <!--div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div-->
            </div>

            </div>
        </div>
        <!-- /Modal -->
        @endforeach
    @endSection

    @section('scripts')
        <!-- DataTables -->
        <script src="\bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="\bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script>
            $(function () {
              $('#transactions-table').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
              })
            })
          </script>

        <script>
            $(function() {
                $('.previousPage').click( function(){
                    window.location.href='{{ $transactions->previousPageUrl() }}';
                });

                $('.nextPage').click( function(){
                    window.location.href='{{ $transactions->nextPageUrl() }}';
                });
            });
        </script>
    @endSection
