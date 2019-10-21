@extends('dashboard.layouts.master')

    @section('content-header')
        <div class="page-title">
            <div class="title_left">
                <h3>Paystack</h3>
            </div>
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-dashboard"></i> Transactions</a>
                    </li>
                    <li class="active">Index</li>
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
                        <h2>Paystack Transactions</h2>
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
                            <br/>
                            <form action="{{ route('paystack.transaction.query') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="col-sm-2 col-xs-3 control-label">Card Payments</label>
                                    <div class="col-sm-10 col-xs-9">
                                        <div class="input-group">
                                            <input type="text" name="reference" class="form-control" placeholder="Enter payment reference......."/>
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-primary btn-rounded">Query Reference</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </form>


                            <br/><br/>
                            <table id="transactions-table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Reference</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th class="hidden-xs">Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $item)
                                        <tr>
                                            <form action="{{ route('paystack.transaction.query') }}" method="post">
                                                @csrf
                                                <td>{{ $item['customer']['email'] }}
                                                <td class="hidden-xs">{{ $item['reference'] }}</td>
                                                <td>@naira(($item['amount'] - $item['fees'])/100)</td>
                                                <td>{{ $item['status'] }}</td>
                                                <td class="hidden-xs">{{ $item['paidAt'] }}</td>
                                                <input type="hidden" name="reference" value="{{ $item['reference'] }}">
                                                <td><button type="submit" class="btn btn-primary">Query</button></td>
                                            </form>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>User</th>
                                        <th>Reference</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th class="hidden-xs">Date</th>
                                    </tr>
                                </tfoot>
                            </table>

                            @include('dashboard.layouts.errors')
                        </div>
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.content -->

    @endSection
