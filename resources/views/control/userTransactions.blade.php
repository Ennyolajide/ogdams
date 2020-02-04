@extends('dashboard.layouts.master')

    @section('content-header')
        <div class="page-title">
            <div class="title_left">
                <h3>User Transactions</h3>
            </div>
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li class="active">User Transactions</li>
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
                        <h3>{{ ucwords($user->name) }}  Transactions</h3>
                        <div class="clearfix"></div>
                    </div>
                    <!-- /.box-header -->
                    <div class="x_content">
                        <div class="col-md-3 col-sm-3 col-xs-12 profile_left text-center">
                            <div class="profile_img text-center">
                                <div id="crop-avatar">
                                    <img class="avatar-view" src="\images/avatar/{{ $user->avatar }}" alt="Avatar" title="Change the avatar">
                                </div>
                            </div>
                            <h3>{{ $user->name }}</h3>
                            <ul class="list-unstyled user_data">
                                <li><h4><i class="fa fa-map-marker user-profile-icon"></i> {{ $user->email }}</h4></li>
                                <li><h4><i class="fa fa-briefcase user-profile-icon"></i> {{ $user->number }}</h4></li>
                                <li><h4><i class="fa fa-card user-profile-icon"></i> @naira($user->balance)</h4></li>
                            </ul>

                            <form action="{{ route('admin.toggle.user.status',['user' => $user->id]) }}" method="post">
                                @method('patch') @csrf
                                <input type="hidden" name="action" value="{{ $user->active ? 0 : 1 }}">
                                <button class="btn {{ $user->active ? 'btn-danger' : 'btn-success' }}"><i class="fa fa-edit m-right-xs"></i>{{ $user->active ? 'Block User' : 'Unblock User' }}</button>
                            </form>
                            <a href="{{ route('admin.user.transactions', ['user' => $user->id ]) }}" class="btn btn-primary">Transactions</a>
                            <br />
                        </div>

                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <table id="transactions-table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="hidden-xs">Reference</th>
                                        <th>Amount</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th class="hidden-xs">Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        function getStatus($status){
                                            $array = ['Declined','Pending','Success','Canceled'];
                                            return $status === NULL ? 'Pending' : $array[$status];
                                        }
                                    @endphp

                                    @foreach ($transactions as $transaction)
                                        <tr>
                                            <td class="hidden-xs">{{ str_limit($transaction->reference, 10, '...') }}</td>
                                            <td class="text-right">@naira($transaction->amount)</td>
                                            <td>{{ $transaction->class->type }}</td>

                                            <td>{{ getStatus($transaction->status) }}</td>
                                            <td class="hidden-xs">{{ $transaction->created_at }}</td>
                                            <td>
                                            <a href="#" data-toggle="modal" data-target="#{{ $transaction->id }}">
                                                    <i class="fa fa-eye"></i>view
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="hidden-xs">Reference</th>
                                        <th>Amount</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th class="hidden-xs">Date</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="col-md-12 col-xs-12">
                                @php $paginator = $transactions; @endphp
                                <span class="hidden-xs text-bold" style="font-size:16px;">
                                    {{ $transactions->firstItem() }} - {{ $transactions->lastItem() }}/{{ $transactions->total() }}
                                </span>
                                <span class="pull-right">
                                    @include('dashboard.layouts.pagination')
                                </span>
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        @foreach ($transactions as $transaction)
            <!-- Modal -->
            <div id="{{ $transaction->id }}" class="modal fade" role="dialog">
                <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">View transaction</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row" style="font-size: 20px;">
                            <div class="col-md-5 col-xs-11  col-xs-offset-1 col-sm-offset-1 col-md-offset-1">
                                <small>Transaction Reference :</small>
                                <p class="text-justify" style="font-size: 15px;"><b> {{ $transaction->reference }} </b></p>
                            </div>
                            <div class="col-md-5 col-xs-11 col-xs-offset-1 col-sm-offset-1 col-md-offset-1">
                                <small>Transaction Type : </small>
                                <p class=""><b> {{ $transaction->class->type }} </b></p>

                            </div>
                            <div class="col-md-5 col-xs-11 col-xs-offset-1 col-sm-offset-1 col-md-offset-1">
                            <small>Transaction Amount : </small>
                                <p class=""><b>@naira($transaction->amount) </b></p>
                            </div>
                            <div class="col-md-5 col-xs-11 col-xs-offset-1 col-sm-offset-1 col-md-offset-1">
                                <small> Before : </small>
                                <p class=""><b>@naira($transaction->balance_before) </b></p>
                            </div>
                            <div class="col-md-5 col-xs-11 col-xs-offset-1 col-sm-offset-1 col-md-offset-1">
                                <small>Balance After : </small>
                                <p class=""><b>@naira($transaction->balance_after)</b></p>
                            </div>
                            <div class="col-md-5 col-xs-11 col-xs-offset-1 col-sm-offset-1 col-md-offset-1">
                                <small>Transaction Status </small>
                                <p class=""><b> {{ getStatus($transaction->status) }} </b></p>
                            </div>


                        </div>
                    </div>
                    <!--div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div-->
                </div>

                </div>
            </div>
            <!-- /Modal -->
        @endforeach

    @endSection
