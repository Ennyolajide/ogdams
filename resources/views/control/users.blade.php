@extends('dashboard.layouts.master')

    @section('content-header')
        <div class="page-title">
            <div class="title_left">
                <h3>Users</h3>
            </div>
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-dashboard"></i> Control</a>
                    </li>
                    <li class="active">Users</li>
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
                        <h2>Users  &nbsp;&nbsp;&nbsp;<a href="{{ route('admin.user.search.index') }}" class="btn btn-rounded btn-default">Search</a></h2>
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
                            <table id="transactions-table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th class="hidden-xs">Balance</th>
                                        <th class="hidden-xs">Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="hidden-xs">{{ $loop->iteration }}</td>
                                            <td>{{ str_limit($user->name, 10, '') }}</td>
                                            <td>{{ $user->email }}</td>

                                            <td>{{ $user->number }}</td>
                                            <td class="hidden-xs">@naira($user->balance)</td>
                                            <td class="hidden-xs">{{ $user->created_at }}</td>
                                            <td>
                                                <a href="{{ route('admin.user.view',['user' => $user->id ]) }}">
                                                    <i class="fa fa-eye"></i>view
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="hidden-xs">#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th class="hidden-xs">Balance</th>
                                        <th class="hidden-xs">Date</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="col-md-12 col-xs-12">
                                @php $paginator = $users; @endphp
                                <span class="hidden-xs text-bold" style="font-size:16px;">
                                    {{ $users->firstItem() }} - {{ $users->lastItem() }}/{{ $users->total() }}
                                </span>
                                <span class="pull-right">
                                    @include('dashboard.layouts.pagination')
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endSection


