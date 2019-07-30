@extends('dashboard.layouts.master')

    @section('css')
        <!-- DataTables -->
        <link rel="stylesheet" href="\bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    @endsection

    @section('content-header')
        <div class="page-title">
            <div class="title_left">
                <h3>Charges Settings</h3>
            </div>
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-dashboard"></i> Configuration</a>
                    </li>
                    <li class="active">Charges</li>
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
                            <h2>Bulk Sms Charges Settings</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-12">
                                <table id="transactions-table" class="table table-striped table-hover table-bordered table-responsive">
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
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

                    <!-- Main content -->
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Service Charges Setings</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <!-- /.box-header -->
                        <div class="x_content">
                            <div class="col-md-12 col-sm-12 col-xs-12">
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
                                @include('dashboard.layouts.errors')
                            </div>
                        </div>
                        <!-- /.box-body -->

                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
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
