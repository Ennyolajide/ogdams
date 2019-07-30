@extends('dashboard.layouts.master')

    @section('content-header')
        <div class="page-title">
            <div class="title_left">
                <h4>My Profile</h4>
            </div>
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-dashboard"></i> Home</a>
                    </li>
                    <li class="active">Profile</li>
                </ol>
            </div>
        </div>
        <div class="clearfix"></div>
    @endsection

    @section('content')
        <!-- Main content -->
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
                <br />
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Add Bank(s)</a>
                        </li>
                    </ul>
                    <div id="myTabContent" class="tab-content">

                        <div role="tabpanel" class="tab-pane active in" id="tab_content1" aria-labelledby="home-tab">
                            <br/>
                            <form action="{{ route('admin.alter.user.balance', ['user' => $user->id]) }}" method="POST">
                                @method('patch') @csrf
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button type="submit" name="debit" value="1" class="btn btn-danger">Debit User</button>
                                        </span>
                                        <input type="text" name="amount" class="form-control">
                                        <span class="input-group-btn">
                                            <button type="submit" name="credit" value="1" class="btn btn-primary">Credit User</button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @include('dashboard.layouts.errors')
            </div>

        </div>
        <!-- Modal -->
        <div class="modal fade" id="myRefUrl" role="dialog">
            <div class="modal-dialog">

            <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">My Referral Link</h4>
                    </div>
                    <div class="modal-body">
                        <p class="text-center"><a href="{{ route('user.register.referrer',['wallet' => $user->wallet_id]) }}"><span class="h3">{{ route('user.register.referrer',['wallet' => $user->wallet_id]) }}</span></a></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
    @endsection












    @section('scripts')

        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.16.0/jquery.validate.min.js"></script>
        <script>
            $(document).ready(function(){

                $.validator.setDefaults({
                    errorClass: 'help-block',
                    highlight: function (element) {
                        $(element)
                            .closest('.form-grouping')
                            .addClass('has-error');
                    },
                    unhighlight: function (element) {
                        $(element)
                            .closest('.form-grouping')
                            .removeClass('has-error');
                    }
                });


            });

        </script>
    @endSection
