@extends('control.layouts.master')

@section('css')
    <!-- iCheck -->
    <link rel="stylesheet" href="\plugins/iCheck/square/blue.css">
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
                        <h3 class="box-title">Airtime Setings</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-striped table-hover table-bordered table-responsive">
                            <thead class="bg-green">
                                <tr>
                                    <th>id</th>
                                    <th>Network</th>
                                    <th>Swap %</th>
                                    <th>Transfer Code</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($networks as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td><img src="\images/networks/{{ strtolower($item->network).'.png'  }}" style="max-height: 50px; display:inline-block;"></td>
                                        <td>{{ $item->airtime_swap_percentage }}%</td>
                                        <td class="text-primary">{{ $item->transfer_code }}</td>
                                        <td><a href="" data-toggle="modal" data-target="#{{ $item->id }}" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</a></td>
                                    </tr>
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
                            <section>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="checkbox icheck">
                                        <label class="">
                                            <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false" style="position: relative;">
                                                <input type="checkbox" name="swapStatus" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;" {{ $item->airtime_swap_percentage_status ? 'checked' : '' }}>
                                                <ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                            </div> Airtime Swap
                                        </label>
                                    </div>
                                    <br/>
                                </div>
                                <div class="col-md-5 col-sm-6 col-xs-6">
                                    <div class="checkbox icheck">
                                        <label class="">
                                            <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false" style="position: relative;">
                                                <input type="checkbox" name="cashStatus" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;" {{ $item->airtime_to_cash_percentage_status ? 'checked' : '' }}>
                                                <ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                            </div> Airtime 2 Cash
                                        </label>
                                    </div>
                                    <br/>
                                </div>

                                <div class="row">
                                    <br/>
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
                                            <label class="col-sm-5 control-label">Process Time(minutes)</label>
                                            <div class="col-sm-4 form-grouping">
                                                <input type="text" class="form-control" name="processTime" value="{{ $item->process_time }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Swap Numbers</label>
                                        <div class="col-sm-8 form-grouping">
                                            <input type="text" class="form-control" name="swapNumbers" value="{{ $item->airtime_to_cash_phone_numbers }}" required>
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Transfer Code </label>
                                        <div class="col-sm-8 form-grouping">
                                            <input type="text" class="form-control" name="transferCode" value="{{ $item->transfer_code }}" required>
                                        </div>
                                    </div>
                                 </div>
                            </section>
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
