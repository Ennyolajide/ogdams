@extends('dashboard.layouts.master')

    @section('css')
        <!-- Switchery -->
        <link href="\plugins/switchery/dist/switchery.min.css" rel="stylesheet">
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
                                <form method="POST" action="{{ route('admin.data.switch.edit',['network' => $network->id ] ) }}">
                                    @method('patch') @csrf
                                    <div class="form-group row text-center">
                                        <!--label class="col-sm-2 control-label">Availability : </label-->
                                        <div class="col-sm-4 form-grouping availability-status">
                                            <input type="checkbox" name="availabilityStatus" class="js-switch" {{ $network->available ? 'checked' : '' }} data-switchery="true" style="display: none;">
                                            <span class="help-block text-bold">Availability</p>
                                        </div>
                                        <!--label class="col-sm-2 control-label">Availability : </label-->
                                        <div class="col-sm-4 form-grouping hosted-sim-status">
                                            <input type="checkbox" name="hostedSimStatus" class="js-switch" {{ $network->hosted_sim_status ? 'checked' : '' }} data-switchery="true" style="display: none;"
                                            {{ $network->available ? '' : 'disabled'}}
                                            >
                                            <span class="help-block text-bold">Hosted Sim Status</p>
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-success btn-flat">Adjust</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <table id="transactions-table" class="table table-striped table-hover table-bordered table-responsive">
                            <thead class="bg-blue">
                                <tr>
                                    <th><small>id</small></th>
                                    <th><small>Net<span class="hidden-xs">work</span></small></th>
                                    <th><small>Size</small></th>
                                    <th><small>Amount</small></th>
                                    <th><small>Action</small></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($plans as $item)
                                    <tr>
                                        <td><small>{{ $item->id }}</small></td>
                                        <td><img src="\images/networks/{{ strtolower($item->network).'.png'  }}" style="max-height: 32px; display:inline-block;"></td>
                                        <td><small>{{ $item->volume }}</small></td>
                                        <td><small>@naira($item->amount)</small></td>
                                        <td>
                                            <a href="" data-toggle="modal" data-target="#{{ $item->id }}" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</a>
                                            <form action="{{ route('admin.dataplan.delete', ['plan' => $item->id ]) }}" method="POST">
                                                @csrf @method('patch')
                                                <button class="btn btn-danger btn-xs"><i class="fa fa-delete"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->

                    <!-- .box-footer -->
                    <div class="box-footer clearfix">
                        <a href="#" data-toggle="modal" data-target="#editPhoneNotification" class="btn btn-sm btn-success btn-flat pull-left" {{ $network->available ? '' : 'disabled' }}>Settings</a>
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
                            <div class="form-group row">
                                <label class="col-sm-2 col-sm-offset-1 control-label">Notification</label>
                                <div class="col-sm-8 form-grouping">
                                    <input type="text" class="form-control" name="notification" value="{{ $item->notification_content }}" required>
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
                        <div class="form-group row">
                            <label class="col-sm-2 col-sm-offset-1 control-label">Notification</label>
                            <div class="col-sm-8 form-grouping">
                                <input type="text" class="form-control" name="notification" value="" required>
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
                        <div class="form-group row notification-forms text-center">
                            <!--label class="col-sm-2 control-label">Status : </label-->
                            <div class="col-sm-5 col-xs-5 form-grouping">
                                <input type="checkbox" name="phoneNotificationStatus" class="js-switch" {{ $network->phone_notification_status ? 'checked' : '' }} data-switchery="true" style="display: none;">
                                <span class="help-block text-bold">Phone Notification status</p>
                            </div>
                            <!--label class="col-sm-2 control-label">Phone : </label-->
                            <div class="col-sm-6 col-xs-7 form-grouping text-input">
                                <input type="text" class="form-control" name="phone" value="{{ $network->notification_phone }}" {{ $network->phone_notification_status ? '' : 'disabled' }}>
                                <span class="help-block text-bold">Phone to receive Data orders</p>
                            </div>
                        </div>

                        <div class="form-group row notification-forms text-center">
                            <!--abel class="col-sm-2 control-label">Status : </label-->
                            <div class="col-sm-5 col-xs-5 form-grouping">
                                <input type="checkbox" name="emailNotificationStatus" class="js-switch" {{ $network->email_notification_status ? 'checked' : '' }} data-switchery="true" style="display: none;">
                                <span class="help-block text-bold">Email Notification status</p>
                            </div>
                            <!--label class="col-sm-2 control-label">Phone : </label-->
                            <div class="col-sm-6 col-xs-7 form-grouping text-input">
                                <input type="text" class="form-control" name="email" value="{{ $network->notification_email }}" {{ $network->email_notification_status ? '' : 'disabled' }}>
                                <span class="help-block text-bold">Email to receive Data orders</p>
                            </div>
                        </div>

                        <div class="form-group row hosted-sims-forms text-center">
                            <label class="col-sm-3 col-xs-3 control-label">SIMS API TOKEN : </label>
                            <div class="col-sm-9 col-xs-9 form-grouping text-input">
                                <input type="text" class="form-control" name="hostedSimApiToken" value="{{ $network->hosted_sim_api_token }}" {{ config('constants.hostedSims.apiToken') ?  'disabled' : ''}}>
                                <span class="help-block text-bold">Hosted Sim Card Api Token</p>
                            </div>
                        </div>

                        <div class="form-group row hosted-sims-forms text-center">
                            <label class="col-sm-3 col-xs-3 control-label"><small> SERVER TOKEN </small> </label>
                            <div class="col-sm-9 col-xs-9 form-grouping text-input">
                                <input type="text" class="form-control" name="hostedSimServerToken" value="{{ $network->hosted_sim_server_token }}">
                                <span class="help-block text-bold">Hosted Sim Card Server Token</p>
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

        <script>
            $('.availability-status').find(':checkbox').change(function(){
                $('.hosted-sim-status').find(':checkbox').attr('disabled', !$(this).is(':checked'));
            });
            $('.notification-forms').find(':checkbox').change(function(){
                $(this).parent().siblings('.text-input').find(':text').attr('disabled', !$(this).is(':checked'));
            });
            $('.hosted-sim-status').find(':checkbox').is(':checked') ? $('.notification-forms').hide() : $('.hosted-sims-forms').hide();
            //$('.availability-status').find(':checkbox').is(':checked') ? $('.notification-forms').hide() : $('.hosted-sims-forms').hide();

        </script>
    @endSection
