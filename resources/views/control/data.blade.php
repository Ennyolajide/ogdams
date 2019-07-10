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
            <div class="col-xs-10">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data Setings</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-striped table-hover table-bordered table-responsive">
                            <tbody>
                                <tr>
                                    <td>{{ $network->id }}</td>
                                    <td><img src="\images/networks/{{ strtolower($network->network).'.png'  }}" style="max-height: 50px; display:inline-block;"></td>
                                    <td>{{ $network->notification_phone }}</td>
                                    <td><a href="" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</a></td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-striped table-hover table-bordered table-responsive">
                            <thead class="bg-blue">
                                <tr>
                                    <th>id</th>
                                    <th>Network</th>
                                    <th>Volume</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($plans as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td><img src="\images/networks/{{ strtolower($item->network).'.png'  }}" style="max-height: 50px; display:inline-block;"></td>
                                        <td>{{ $item->volume }}</td>
                                        <td>@naira($item->amount)</td>
                                        <td><a href="" data-toggle="modal" data-target="#{{ $item->id }}" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    @include('dashboard.layouts.errors')
                    <!-- .box-footer -->
                    <div class="box-footer clearfix">
                        <a href="#" data-toggle="modal" data-target="#editPhoneNotification" class="btn btn-sm bg-purple btn-flat pull-left">Edit Not. Phone</a>
                        <a href="#" data-toggle="modal" data-target="#newDataPlan" class="btn btn-sm btn-default btn-flat pull-right">Add New Data Plan</a>
                    </div>
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

    @foreach ($plans as $item)
        <!--Modal-->
        <div id="{{ $item->id }}" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">
                            Edit Data Plan
                            <img src="\images/networks/{{ strtolower($item->network).'.png'  }}" style="max-height: 40px; display:inline-block;">
                        </h4>
                    </div>
                    <form method="POST" action="{{ route('admin.dataplan.edit',['network' => $item->id ] ) }}">
                        @method('patch') @csrf
                        <div class="modal-body block-center">
                            <br/>
                            <div class="form-group row">
                                <label class="col-sm-2 col-sm-offset-1 control-label">Volume</label>
                                <div class="col-sm-8 form-grouping">
                                    <input type="text" class="form-control" name="volume" value="{{ $item->volume }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-sm-offset-1 control-label">Amount</label>
                                <div class="col-sm-8 form-grouping">
                                    <input type="text" class="form-control" name="amount" value="{{ $item->amount }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button"  data-dismiss="modal" class="btn btn-danger pull-left">Deline</button>
                            <button type="submit" name="completed" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Modal -->
    @endforeach

    <!--Modal-->
    <div id="newDataPlan" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">
                        New Data Plan
                        <img src="\images/networks/{{ strtolower($network->network).'.png'  }}" style="max-height: 40px; display:inline-block;">
                    </h4>
                </div>
                <form method="POST" action="{{ route('admin.dataplan.new',['network' => $network->id ] ) }}">
                    @csrf
                    <div class="modal-body block-center">
                        <br/>
                        <div class="form-group row">
                            <label class="col-sm-2 col-sm-offset-1 control-label">Volume</label>
                            <div class="col-sm-8 form-grouping">
                                <input type="text" class="form-control" name="volume" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-sm-offset-1 control-label">Amount</label>
                            <div class="col-sm-8 form-grouping">
                                <input type="text" class="form-control" name="amount" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button"  data-dismiss="modal" class="btn btn-danger pull-left">Deline</button>
                        <button type="submit" name="completed" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Modal -->

    <!--Modal-->
    <div id="editPhoneNotification" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">
                        Edit Notification Number
                        <img src="\images/networks/{{ strtolower($network->network).'.png'  }}" style="max-height: 40px; display:inline-block;">
                    </h4>
                </div>
                <form method="POST" action="{{ route('admin.data.edit',['network' => $network->id ] ) }}">
                    @method('patch') @csrf
                    <div class="modal-body block-center">
                        <br/>
                        <div class="form-group row">
                            <label class="col-sm-2 col-sm-offset-1 control-label">Phone : </label>
                            <div class="col-sm-8 form-grouping">
                                <input type="text" class="form-control" name="phone" value="{{ $network->notification_phone }}" required>
                            </div>
                        </div>
                        <p class="text-success text-center text-bold">Phone to receive Data orders</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button"  data-dismiss="modal" class="btn btn-danger pull-left">Deline</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Modal -->


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
