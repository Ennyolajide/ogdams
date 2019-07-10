@extends('control.layouts.master')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="\bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endsection

@section('content-header')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Configuration

          <small>Settings</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Configuration</a></li>
          <li class="active">Settings</li>
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
                        <h3 class="box-title">Bulk Sms Settings</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-striped table-hover table-bordered table-responsive">
                            <thead class="bg-green">
                                <tr>
                                    <th>id</th>
                                    <th>&nbsp;&nbsp;Route &nbsp;&nbsp;&nbsp;</th>
                                    <th>Amount(₦)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($smsConfigs as $item)
                                    <form action="{{ route('admin.sms.config.edit', ['route' => $item->id])  }}"method="POST">
                                        @method('patch') @csrf
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->route }}</td>
                                            <td><input type="text" style="max-width: 50px;" name="amount" value="{{ $item->amount_per_unit / 100 }}" required></td>
                                            <td><button type="submit" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</button></td>
                                        </tr>
                                    </form>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Service Charges Settings</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-striped table-hover table-bordered table-responsive">
                            <thead class="bg-green">
                                <tr>
                                    <th>id</th>
                                    <th>Service</th>
                                    <th>Amount(₦)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($charges as $item)
                                    <form action="{{ route('admin.charges.config.edit', ['service' => $item->id])  }}"method="POST">
                                        @method('patch') @csrf
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->service }}</td>
                                            <td><input type="text" style="max-width: 50px;" name="amount" value="{{ $item->amount }}" required></td>
                                            <td><button type="submit" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</button></td>
                                        </tr>
                                    </form>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    @include('dashboard.layouts.errors')
                    <!-- .box-footer -->
                    <!-- /.box-footer -->
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



        <script>


        </script>

    @endSection
