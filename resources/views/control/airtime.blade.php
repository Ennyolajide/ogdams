@extends('dashboard.layouts.master')

    @section('css')
        <!-- iCheck -->
        <link rel="stylesheet" href="\plugins/iCheck/square/blue.css">
        <!-- switchery -->
        <link href="\plugins/switchery/dist/switchery.min.css" rel="stylesheet">
        <!-- DataTables -->
        <link rel="stylesheet" href="\bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    @endsection

    @section('content-header')
        <div class="page-title">
            <div class="title_left">
                <h3>Airtime Settings</h3>
            </div>
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-dashboard"></i> Configuration</a>
                    </li>
                    <li class="active">Settings</li>
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
                        <h2>Airtime Setings</h2>
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
                            @include('dashboard.layouts.errors')
                            <table id="transactons-table" class="table table-striped table-hover table-bordered table-responsive">
                                <thead class="bg-green">
                                    <tr>
                                        <th class="hidden-xs">id</th>
                                        <th>Network</th>
                                        <th>Swap %</th>
                                        <th>Topup %</th>
                                        <th class="hidden-xs">Transfer Code</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($networks as $item)
                                        <tr>
                                            <td class="hidden-xs">{{ $item->id }}</td>
                                            <td><img src="\images/networks/{{ strtolower($item->network).'.png'  }}" style="max-height: 50px; display:inline-block;"></td>
                                            <td>{{ $item->airtime_swap_percentage }}%</td>
                                            <td>{{ $item->airtime_topup_percentage }}%</td>
                                            <td class="hidden-xs text-primary">{{ $item->transfer_code }}</td>
                                            <td><a href="" data-toggle="modal" data-target="#{{ $item->id }}" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.content -->
    @endSection

    @foreach ($networks as $item)
        <!--Modal-->
        <div id="{{ $item->id }}" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">
                            Edit {{ $item->network }} settings
                            <img src="\images/networks/{{ strtolower($item->network).'.png'  }}" style="max-height: 40px; display:inline-block;">
                        </h4>
                    </div>
                    <form method="POST" action="{{ route('admin.airtime.config.edit',['network' => $item->id ] ) }}">
                        @method('patch') @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <label>
                                        Swap
                                        <input type="checkbox" name="swapStatus" class="js-switch" {{ $item->airtime_swap_percentage_status ? 'checked' : '' }} data-switchery="true" style="display: none;">
                                    </label>
                                </div>
                                <div class="col-md-5 col-sm-6 col-xs-6">
                                    <label>
                                        Cash
                                        <input type="checkbox" name="cashStatus" class="js-switch" {{ $item->airtime_to_cash_percentage_status ? 'checked' : '' }} data-switchery="true" style="display: none;">
                                    </label>
                                </div>
                            </div>
                            <br/>

                            <div class="row">
                                <div class="col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" style="vertical-align: middle;">Swap %</label>
                                        <div class="col-sm-6 form-grouping">
                                            <input type="text" class="form-control" name="percentage" value="{{ $item->airtime_swap_percentage }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Process Time(mins)</label>
                                        <div class="col-sm-6 form-grouping">
                                            <input type="text" class="form-control" name="processTime" value="{{ $item->process_time }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label class="col-sm-3 col-xs-10 control-label">Airtime Topup %</label>
                                        <div class="col-sm-8 col-xs-12 form-grouping">
                                            <input type="text" class="form-control" name="topupPercentage" value="{{ $item->airtime_topup_percentage }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                @foreach (json_decode($item->airtime_to_cash_phone_numbers) as $swapNumber)
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-xs-12 control-label">Swap Number {{ $loop->iteration }}</label>
                                            <div class="col-sm-6 col-xs-12 form-grouping">
                                                <input type="text" class="form-control" name="swapNumber{{ $loop->iteration }}" value="{{ $swapNumber }}" {{ $loop->first ? 'required' : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label class="col-sm-3 col-xs-12 control-label">Transfer Code </label>
                                        <div class="col-sm-8 col-xs-12 form-grouping">
                                            <input type="text" class="form-control" name="transferCode" value="{{ $item->transfer_code }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br/>
                        </div>
                        <div class="modal-footer">
                            <button type="button"  data-dismiss="modal" class="btn btn-danger pull-left">Deline</button>
                            <button type="submit" name="completed" class="btn btn-primary">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Modal -->
    @endforeach




    @section('scripts')
        <script src="\plugins/switchery/dist/switchery.min.js"></script>
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

        <!-- iCheck -->
        <script src="\plugins/iCheck/icheck.min.js"></script>
        <script>
            $(function () {
                $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
                });
            });
        </script>

        <script>


        </script>

    @endSection
