@extends('dashboard.layouts.master')

    @section('css')
        {{-- <!-- iCheck -->
        <link rel="stylesheet" href="\plugins/iCheck/square/blue.css"> --}}
        <!-- switchery -->
        <link href="\plugins/switchery/dist/switchery.min.css" rel="stylesheet">
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
                        @include('dashboard.layouts.errors')
                        <table id="transactons-table" class="table table-striped table-hover table-bordered table-responsive">
                            <thead class="bg-orange">
                                <tr>
                                    <th class="hidden-xs"><small>id</small></th>
                                    <th><small>Network</small></th>
                                    <th><small>Topup Status</small></th>
                                    <th><small>Hosted Sim Route</small></th>
                                    <th><small>Action</small></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($networks as $item)
                                    <form method="POST" action="{{ route('admin.airtime.switch.edit',['network' => $item->id ] ) }}">
                                        @method('patch') @csrf
                                        <tr>
                                            <td class="hidden-xs">{{ $item->id }}</td>
                                            <td><img src="\images/networks/{{ strtolower($item->network).'.png'  }}" style="max-height: 32px; display:inline-block;"></td>
                                            <td><input type="checkbox" name="airtimeTopupStatus" class="js-switch" {{ $item->airtime_topup_status ? 'checked' : '' }} data-switchery="true" style="display: none;"></td>
                                            <td><input type="checkbox" name="airtimeTopupSimRoute" class="js-switch" {{ $item->airtime_topup_sim_route ? 'checked' : '' }} data-switchery="true" style="display: none;"></td>
                                            <td><button type="submit" class="btn btn-success btn-xs"><i class="fa fa-check"></i>&nbsp;Adjust</button></td>
                                        </tr>
                                    </form>
                                @endforeach
                            </tbody>
                        </table>
                            {{-- <form method="POST" action="{{ route('admin.data.switch.edit',['network' => $network->id ] ) }}">
                                @method('patch') @csrf
                                <div class="form-group row text-center">
                                    <!--label class="col-sm-2 control-label">Availability : </label-->
                                    <div class="col-sm-4 form-grouping availability-status">
                                        <input type="checkbox" name="availabilityStatus" class="js-switch" {{ $networks->airtime_topup_status ? 'checked' : '' }} data-switchery="true" style="display: none;">
                                        <span class="help-block text-bold">Availability</p>
                                    </div>
                                    <!--label class="col-sm-2 control-label">Availability : </label-->
                                    <div class="col-sm-4 form-grouping hosted-sim-status">
                                        <input type="checkbox" name="hostedSimStatus" class="js-switch" {{ $networks->airtime_topup_sim_route ? 'checked' : '' }} data-switchery="true" style="display: none;"
                                        {{ $networks->airtime_topup_sim_route ? '' : 'disabled'}}
                                        >
                                        <span class="help-block text-bold">Hosted Sim Status</p>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-success btn-flat">Adjust</button>
                                </div>
                            </form> --}}
                        </div>
                        <table id="transactons-table" class="table table-striped table-hover table-bordered table-responsive">
                            <thead class="bg-green">
                                <tr>
                                    <th class="hidden-xs"><small>id</small></th>
                                    <th><small>Network</small></th>
                                    <th><small>Swap %</small></th>
                                    <th><small>Topup %</small></th>
                                    <th class="hidden-xs"><small>Transfer Code</small></th>
                                    <th><small>Action</small></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($networks as $item)
                                    <tr>
                                        <td class="hidden-xs"><small>{{ $item->id }}</small></td>
                                        <td><img src="\images/networks/{{ strtolower($item->network).'.png'  }}" style="max-height: 32px; display:inline-block;"></td>
                                        <td><small>{{ $item->airtime_swap_percentage }}%</small></td>
                                        <td><small>{{ $item->airtime_topup_percentage }}%</small></td>
                                        <td class="hidden-xs text-primary"><small>{{ $item->transfer_code }}</small></td>
                                        <td><a href="" data-toggle="modal" data-target="#{{ $item->airtime_topup_status ? $item->id : '' }}" class="btn btn-info btn-xs" {{ $item->airtime_topup_status ? '' : 'disabled'}}><i class="fa fa-edit"></i> Edit</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- /.box-body -->
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
                            <div class="row text-center">
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
                            <div class="row" style="display:{{ $item->airtime_topup_sim_route ? 'none;' : '' }}">
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
                            <div class="row" style="display:{{ $item->airtime_topup_sim_route ? '' : 'none;' }}">
                                <p class=""><strong>Hosted Sims</strong></p>
                                <hr class="">
                                <div class="row">
                                    <div class="form-group row text-center">
                                        <div class="col-sm-12 col-xs-12">
                                            <label class="col-sm-3 col-xs-12 control-label">Sim Api Token</label>
                                            <div class="col-sm-8 col-xs-12 form-grouping">
                                                <input type="text" class="form-control" name="hostedSimApiToken" value="{{ $item->hosted_sim_api_token }}" {{ config('constants.hostedSims.apiToken') ?  'disabled' : ''}}>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group row text-center">
                                        <div class="col-sm-12 col-xs-12">
                                            <label class="col-sm-3 col-xs-12 control-label">Sim Server Token</label>
                                            <div class="col-sm-8 col-xs-12 form-grouping">
                                                <input type="text" class="form-control" name="hostedSimServerToken" value="{{ $item->hosted_sim_server_token }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group row text-center">
                                        <div class="col-sm-12 col-xs-12">
                                            <label class="col-sm-3 col-xs-12 control-label">Ussd Code </label>
                                            <div class="col-sm-8 col-xs-12 form-grouping">
                                                <input type="text" class="form-control" name="airtimeTopupUssdCode" value="{{ $item->airtime_topup_ussd_code }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br/>
                            </div>
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
    @endSection
