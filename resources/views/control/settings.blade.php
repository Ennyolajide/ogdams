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
                <h3>Configuration</h3>
            </div>
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-dashboard"></i> Settings</a>
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
                        <h2>Settings</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <fieldset>
                                    <legend>
                                        Settings
                                    </legend>
                                    <div class="row">
                                        <table id="transactons-table" class="table table-striped table-hover table-bordered table-responsive">
                                            <thead class="bg-success">
                                                <tr>
                                                    <th class="hidden-xs"><small>id</small></th>
                                                    <th><small>Name</small></th>
                                                    <th><small>Status</small></th>
                                                    <th><small>Action</small></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($settings as $item)
                                                    <form method="POST" action="{{ route('admin.settings.edit',['setting' => $item->id ] ) }}">
                                                        @method('patch') @csrf
                                                        <tr>
                                                            <td>#</td>
                                                            <td>{{ ucwords(str_replace('_', ' ', $item->name)) }}</td>
                                                            <td><input type="checkbox" name="status" class="js-switch" {{ $item->status ? 'checked' : '' }} data-switchery="true" style="display: none;"></td>
                                                            <td><button type="submit" class="btn btn-success btn-xs"><i class="fa fa-check"></i>&nbsp;Adjust</button></td>
                                                        </tr>
                                                    </form>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </fieldset>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <fieldset>
                                    <legend>
                                        Data Plans
                                    </legend>
                                    <div class="row">
                                        @foreach ($networks as $item)
                                            <div class="col-sm-3 col-xs-3 cursor text-center">
                                                <a href="{{ route('admin.dataplan', ['network' => $item->id ]) }}">
                                                    <img src="\images/networks/{{ strtolower($item->addon ? $item->group_network : $item->network).'.png' }}" class="img-thumbnail" style="max-height: 50px; display:inline-block;">
                                                    <p class="text-bold">{{ $item->has_addon ? $item->alternate_network : $item->network }}</p>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </fieldset>
                                <hr>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <fieldset>
                                    <legend>
                                        Bills
                                    </legend>

                                        @foreach($bills as $item)
                                            <div class="col-sm-3 col-xs-3 cursor text-center">
                                                <a href="{{ route('admin.bills.config', ['product' => $item->id]) }}">
                                                    <img src="\images/bills/{{ strtolower($item->logo) }}" class="img-thumbnail" style="max-height: 50px; display:inline-block;">
                                                    <p class="text-bold">{{ $item->name }}</p>
                                                </a>
                                            </div>
                                        @endforeach
                                </fieldset>
                                <hr>
                                <br/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <fieldset>
                                    <legend>
                                        Airtime
                                    </legend>
                                    <div class="row">
                                        @foreach ($networks as $item)
                                            @if($item->addon) @continue @endif
                                            <div class="col-sm-3 col-xs-3 cursor text-center">
                                                <a href="{{ route('admin.airtime.config') }}">
                                                    <img src="\images/networks/{{ strtolower($item->network).'.png' }}" class="img-thumbnail" style="max-height: 50px; display:inline-block;">
                                                    <p class="text-bold">{{ $item->network }}</p>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </fieldset>
                                <hr>
                                <br/>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <fieldset>
                                    <legend>
                                        Others
                                    </legend>
                                    <div class="row">
                                        <div class="col-sm-4 col-xs-4 text-center">
                                            <a href="{{ route('admin.charges.config') }}"><i class="fa fa-envelope fa-3x"></i></a>
                                            <p class="">SMS</p>
                                        </div>
                                        <div class="col-sm-4 col-xs-4 text-center">
                                            <a href="{{ route('admin.charges.config') }}"><i class="fa fa-money fa-3x"></i></a>
                                            <p class="">Charges</p>
                                        </div>
                                        <div class="col-sm-4 col-xs-4 text-center">
                                            <a href="{{ route('admin.charges.config') }}"><i class="fa fa-bank fa-3x"></i></a>
                                            <p class="">Banks</p>
                                        </div>
                                    </div>

                                </fieldset>
                                <hr>
                                <br/>
                            </div>
                        </div>

                        <!-- /.box-body -->
                        @include('dashboard.layouts.errors')

                    </div>
                    <!-- /.box-footer -->
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.content -->

    @endSection

    @section('scripts')
        <script src="\plugins/switchery/dist/switchery.min.js"></script>
    @endSection




