@extends('dashboard.layouts.master')

    @section('css')
        <!-- DataTables -->
        <link rel="stylesheet" href="\bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    @endsection

    @section('content-header')
        <div class="page-title">
            <div class="title_left">
                <h3>Airtime Transactions</h3>
            </div>
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-dashboard"></i> Airtime</a>
                    </li>
                    <li class="active">Airtime Transactions</li>
                </ol>
            </div>
        </div>
        <div class="clearfix"></div>
    @endsection

    @section('content')
        <!-- Main content -->
        <div class="row">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Airtime Topup</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-12 col-sm-12 col-xs-12">

                                <table id="transactions-table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
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
                                                $array = ['Declined','Pending','Completed','Canceled'];
                                                return $array[$status];
                                            }
                                        @endphp

                                        @foreach ($transactions as $transaction)
                                            <tr>
                                                <td class="hidden-xs">{{ $transaction->reference }}</td>
                                                <td>{{ $transaction->amount }}</td>
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
                                    <tfoot>
                                        <tr>
                                            <th class="hidden-xs">Reference</th>
                                            <th>Amount</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th class="hidden-xs">Date</th>
                                            <th >Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                @include('dashboard.layouts.errors')
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <!-- .box-footer -->
                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
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
                                @if($transaction->class->transaction_type == 1)
                                    <div class="col-md-5 col-xs-6 col-sm-offset-1 col-md-offset-1">
                                        <small>Network : </small>
                                        <p class="text-olive h4"><b>{{ $transaction->class->networkName->network }}</b></p>
                                    </div>
                                    <div class="col-md-5 col-xs-6 col-sm-offset-1 col-md-offset-1">
                                        <small>Phone : </small>
                                        <p class="text-olive h4"><b>{{ $transaction->class->to_phone }}</b></p>
                                    </div>
                                @endif

                                @if($transaction->class->transaction_type == 2)
                                    <div class="col-md-3 col-xs-3 col-xs-offset-1 col-md-offset-1">
                                        <img class="img-responsive block-center"  style="height:50px;" src="\images/networks/{{ strtolower($transaction->class->from_network).'.png' }}">
                                        <span class="text-purple text-bold">@naira($transaction->class->amount)</span>
                                        <p class=""><b>{{ $transaction->class->from_phone }}</b></p>
                                    </div>
                                    <div class="col-md-3 col-xs-3 text-center">
                                        <i class="fa fa-arrow-right fa-2x" style="height:40px;"></i>
                                    </div>
                                    <div class="col-md-4 col-xs-4">
                                        <p class=""><b>{{ $transaction->class->bank->bank_name }}</b></p>
                                        <span class="text-success text-bold">@naira($transaction->class->amount * $transaction->class->percentage / 100)</span>
                                        <p class=""><b>{{ $transaction->class->bank->acc_no }}</b></p>
                                        <p class="text-olive h4"><b> {{ $transaction->class->bank->acc_name }} </b></p>
                                    </div>
                                @endif

                                @if($transaction->class->transaction_type == 3)
                                    <div class="col-md-3 col-xs-3 col-sm-offset-1 col-md-offset-1">
                                        <img class="img-responsive block-center"  style="height:50px;" src="\images/networks/{{ strtolower($transaction->class->from_network).'.png' }}">
                                        <span class="text-purple text-bold">@naira($transaction->class->amount)</span>
                                        <p class=""><b>{{ $transaction->class->from_phone }}</b></p>
                                    </div>
                                    <div class="col-md-3 col-xs-3 text-center">
                                        <i class="fa fa-arrow-right fa-2x" style="height:40px;"></i>
                                    </div>
                                    <div class="col-md-5 col-xs-5">
                                        <img class="img-responsive block-center"  style="height:50px;" src="\images/networks/{{ strtolower($transaction->class->to_network).'.png' }}">
                                        <span class="text-success text-bold">@naira($transaction->class->amount * $transaction->class->percentage / 100)</span>
                                        <p class=""><b>{{ $transaction->class->to_phone }}</b></p>
                                    </div>
                                @endif


                                @if($transaction->class->transaction_type == 4)
                                    <div class="col-md-3 col-xs-3 col-xs-offset-1 col-md-offset-1">
                                        <img class="img-responsive block-center"  style="height:50px;" src="\images/networks/{{ strtolower($transaction->class->from_network).'.png' }}">
                                        <span class="text-purple text-bold">@naira($transaction->class->amount)</span>
                                        <p class=""><b>{{ $transaction->class->from_phone }}</b></p>
                                    </div>
                                    <div class="col-md-3 col-xs-3 text-center">
                                        <i class="fa fa-arrow-right fa-2x" style="height:40px;"></i>
                                    </div>
                                    <div class="col-md-4 col-xs-4">
                                        <img class="img-responsive block-center"  style="height:2px;" src="\images/networks/{{ strtolower($transaction->class->from_network).'.png' }}">
                                        <i class="fa fa-bank fa-2x" style="display: block; margin-bottom: 9px;"></i>
                                        <span class="text-success text-bold">@naira($transaction->class->amount * $transaction->class->percentage / 100)</span>
                                        <p class=""><b>{{ str_limit($transaction->class->user->name, 10, '...')  }}</b></p>
                                    </div>
                                @endif
                                <br/>
                                <div class="col-md-5 col-xs-5 col-xs-offset-1 col-sm-offset-1 col-md-offset-1">
                                    <small> Before : </small>
                                    <p class=""><b>@naira($transaction->balance_before) </b></p>
                                </div>
                                <div class="col-md-5 col-xs-6 col-sm-offset-1 col-md-offset-1">
                                    <small>Balance After : </small>
                                    <p class=""><b>@naira($transaction->balance_after)</b></p>
                                </div>
                                <div class="col-md-5 col-xs-5 col-xs-offset-1 col-sm-offset-1 col-md-offset-1">
                                    <small> Type : </small>
                                    <p class=""><b> {{ $transaction->class->type }} </b></p>
                                </div>
                                <div class="col-md-5 col-xs-6 col-sm-offset-1 col-md-offset-1">
                                    <small> Status </small>
                                    <p class=""><b> {{ getStatus($transaction->status) }} </b></p>
                                </div>
                                @if($transaction->class->transaction_type > 1)
                                    <div class="col-md-11 col-xs-11 text-center">
                                        <small class="text-bold">Recepients Numbers </small>
                                        @php
                                            $recipients = json_decode($transaction->class->recipients )
                                        @endphp
                                        <p class="text-bold text-orange">
                                            <ul  class="list-inline h3 text-center text-primary">
                                                @foreach ($recipients as $recipient)
                                                    <li> {{ $recipient }} </li>
                                                @endforeach
                                            </ul>
                                        </p>
                                    </div>
                                @endif
                                <div class="col-md-11 col-xs-11 text-center">
                                    <small class="text-bold">Transaction Reference :</small>
                                    <p class="h4"><b> {{ $transaction->reference }} </b></p>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            @if($transaction->class->transaction_type == 4)
                                <form method="POST" action="{{ route('admin.airtimes.fundings',['trans' => $transaction->id] ) }}">
                            @else
                                <form method="POST" action="{{ route('admin.airtimes.edit',['trans' => $transaction->id] ) }}">
                            @endif
                                @method('patch') @csrf
                                <button type="submit" name="decline" class="btn btn-danger pull-left">Deline</button>
                                <button type="submit" name="completed" class="btn btn-primary">Completed</button>
                            </form>
                        </div>
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
    @endSection
