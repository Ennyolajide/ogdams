@extends('dashboard.layouts.master')

    @section('css')
        <!-- Switchery -->
        <link href="\plugins/switchery/dist/switchery.min.css" rel="stylesheet">
        <!-- DataTables -->
        <link rel="stylesheet" href="\bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    @endsection

    @section('content-header')
        <div class="page-title">
            <div class="title_left">
                <h3>Data Settings</h3>
            </div>
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-dashboard"></i> Configuration</a>
                    </li>
                    <li class="active">Data</li>
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
                        <h2>Data Setings</h2>
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
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                @include('dashboard.layouts.errors')
                                <table class="table table-striped table-hover table-bordered table-responsive">
                                    <tbody>
                                        <tr>
                                            <td>#</td>
                                            <td>Phone</td>
                                            <td class="text-bold">{{ $network->notification_phone }}</td>
                                            <td>
                                                <label>
                                                    <input type="checkbox" name="phoneNotificationStatus" class="js-switch" {{ $network->phone_notification_status ? 'checked' : '' }} data-switchery="true" style="display: none;">
                                                </label>
                                            </td>
                                                <!--a href="" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</a></td-->
                                        </tr>
                                        <tr>
                                            <td>#</td>
                                            <td>Email</td>
                                            <td class="text-bold">{{ $network->notification_email }}</td>
                                            <td>
                                                <label>
                                                    <input type="checkbox" class="js-switch" {{ $network->email_notification_status ? 'checked' : '' }} data-switchery="true" style="display: none;">
                                                </label>
                                            </td>
                                                <!--a href="" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</a></td-->
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <table id="transactions-table" class="table table-striped table-hover table-bordered table-responsive">
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
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <!-- .box-footer -->
                    <div class="box-footer clearfix">
                        <a href="#" data-toggle="modal" data-target="#editPhoneNotification" class="btn btn-sm btn-success btn-flat pull-left">Settings</a>
                        <a href="#" data-toggle="modal" data-target="#newDataPlan" class="btn btn-sm btn-primary btn-flat pull-right">Add New Data Plan</a>
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        </div>
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
                        <div class="form-group row notification-status">
                            <label class="col-sm-2 control-label">Phone : </label>
                            <div class="col-sm-5 form-grouping text-input">
                                <input type="text" class="form-control" name="phone" value="{{ $network->notification_phone }}" {{ $network->phone_notification_status ? '' : 'disabled' }} required>
                                <span class="help-block text-bold">Phone to receive Data orders</p>
                            </div>
                            <label class="col-sm-2 control-label">Status : </label>
                            <div class="col-sm-3 form-grouping">
                                <input type="checkbox" name="phoneNotificationStatus" class="js-switch" {{ $network->phone_notification_status ? 'checked' : '' }} data-switchery="true" style="display: none;">
                                <span class="help-block text-bold">Phone Notification status</p>
                            </div>
                        </div>
                        <div class="form-group row notification-status">
                            <label class="col-sm-2 control-label">Phone : </label>
                            <div class="col-sm-5 form-grouping text-input">
                                <input type="text" class="form-control" name="email" value="{{ $network->notification_email }}" {{ $network->email_notification_status ? '' : 'disabled' }} required>
                                <span class="help-block text-bold">Email to receive Data orders</p>
                            </div>
                            <label class="col-sm-2 control-label">Status : </label>
                            <div class="col-sm-3 form-grouping">
                                <input type="checkbox" name="emailNotificationStatus" class="js-switch" {{ $network->email_notification_status ? 'checked' : '' }} data-switchery="true" style="display: none;">
                                <span class="help-block text-bold">Email Notification status</p>
                            </div>
                        </div>

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
        <script src="\plugins/switchery/dist/switchery.min.js"></script>
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
            $('.notification-status').find(':checkbox').change(function(){
                $(this).parent().siblings('.text-input').find(':text').attr('disabled', !$(this).is(':checked'));
            });
        </script>
    @endSection
    });
