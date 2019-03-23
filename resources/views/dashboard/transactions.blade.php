@extends('dashboard.layouts.master')

@section('css')
      <!-- DataTables -->
  <link rel="stylesheet" href="\bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endsection

@section('content-header')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Transactions
          <small>My Transactions</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li class="active">Transactions</li>
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
                        <h3 class="box-title">My Transactions</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="transactions-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Reference</th>
                                    <th>Amount</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    function getStatus($status){
                                        $array = ['Success','Pending','Cancel'];
                                        return $status ? $array[$status] : 'Decline';
                                    }
                                @endphp

                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>{{ $transaction->id }}</td>
                                        <td>{{ $transaction->amount }}</td>
                                        <td>xxxx</td>

                                        <td>{{ getStatus($transaction->status) }}</td>
                                        <td>{{ $transaction->created_at }}</td>
                                        <td><a href="#"><i class="fa fa-eye"></i>view</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Reference</th>
                                    <th>Amount</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
      <!-- /.content -->
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
