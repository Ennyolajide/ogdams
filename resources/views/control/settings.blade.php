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
                        <h3 class="box-title">Site Setings</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <fieldset>
                                    <legend>
                                        Data Plans
                                    </legend>
                                    <div class="row">
                                        @foreach ($networks as $item)
                                            <div class="col-sm-3 col-xs-3 cursor text-center">
                                                <a href="{{ route('admin.dataplan', ['network' => $item->id ]) }}">
                                                    <img src="\images/networks/{{ strtolower($item->network).'.png' }}" class="img-thumbnail" style="max-height: 50px; display:inline-block;">
                                                    <p class="text-bold">{{ $item->network }}</p>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </fieldset>
                                <hr>
                            </div>
                            <div class="col-sm-6">
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
                            <div class="col-sm-6">
                                <fieldset>
                                    <legend>
                                        Airtime
                                    </legend>
                                    <div class="row">
                                        @foreach ($networks as $item)
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
                            <div class="col-sm-6">
                                <fieldset>
                                    <legend>
                                        Others
                                    </legend>
                                    <div class="row">
                                        <div class="col-sm-6 col-xs-6 text-center">
                                            <a href="{{ route('admin.charges.config') }}"><i class="fa fa-envelope fa-3x"></i></a>
                                            <p class="">SMS</p>
                                        </div>
                                        <div class="col-sm-6 col-xs-6 text-center">
                                            <a href="{{ route('admin.charges.config') }}"><i class="fa fa-money fa-3x"></i></a>
                                            <p class="">Charges</p>
                                        </div>
                                    </div>

                                </fieldset>
                                <hr>
                                <br/>
                            </div>
                        </div>



                    </div>
                    <!-- /.box-body -->
                    @include('dashboard.layouts.errors')
                    <!-- .box-footer -->
                    @include('dashboard.layouts.box-footer')
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
    @endSection
