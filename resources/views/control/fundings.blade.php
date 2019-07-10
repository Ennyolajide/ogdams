@extends('control.layouts.master')

@section('css')
      <!-- DataTables -->
  <link rel="stylesheet" href="\bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endsection

@section('content-header')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Wallet
          <small>Funding Requests</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li class="active">Wallet</li>
        </ol>
    </section>

@endSection

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Funding Requests</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
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
                                        $array = ['Declined','Pending','Success','Canceled'];
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
                    </div>
                    <!-- /.box-body -->
                    @include('dashboard.layouts.errors')
                    <!-- .box-footer -->
                    @include('dashboard.layouts.box-footer')
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
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
                            <div class="col-md-5 col-xs-5  col-xs-offset-1 col-sm-offset-1 col-md-offset-1">
                                <small>Bank :</small>
                                <p class=""><b> {{ $transaction->class->bank->bank_name }} </b></p>
                            </div>
                            <div class="col-md-5 col-xs-6 col-sm-offset-1 col-md-offset-1">
                                <small>Account No : </small>
                                <p class=""><b> {{ $transaction->class->bank->acc_no }} </b></p>
                            </div>
                            <div class="col-md-5 col-xs-5 col-xs-offset-1 col-sm-offset-1 col-md-offset-1">
                                <small>Amount :</small>
                                <p class=""><b>@naira($transaction->amount)</b></p>
                            </div>
                            <div class="col-md-5 col-xs-6 col-sm-offset-1 col-md-offset-1">
                                <small>Account Name : </small>
                                <p class="text-olive h4"><b> {{ $transaction->class->bank->acc_name }} </b></p>
                            </div>
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
                            <div class="col-md-11 col-xs-11 text-center">
                                <small class="text-bold">Transaction Reference :</small>
                                <p class="h4"><b> {{ $transaction->reference }} </b></p>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <form method="POST" action="{{ route('admin.fundings.edit',['trans' => $transaction->id] ) }}">
                            @method('patch')
                            @csrf
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
