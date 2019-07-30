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
                        <img class="avatar-view" src="\images/avatar/{{ Auth::user()->avatar }}" alt="Avatar" title="Change the avatar">
                    </div>
                </div>
                <h3>{{ Auth::user()->name }}</h3>
                <ul class="list-unstyled user_data">
                    <li><h4><i class="fa fa-map-marker user-profile-icon"></i> {{ Auth::user()->email }}</h4></li>
                    <li><h3><i class="fa fa-briefcase user-profile-icon"></i> {{ Auth::user()->number }}</h3></li>
                    <li class="m-top-xs">

                        <a data-toggle="modal" href="#myRefUrl" class="btn btn-primary">
                            <i class="fa fa-external-link user-profile-icon"></i>Show My Referral Link
                        </a>
                    </li>
                </ul>
                <a href="#tab_content2" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                <br />
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Add Bank(s)</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Profile</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Inbox</a>
                        </li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade  active in" id="tab_content1" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-sm-12 col-md-12" style="display:none;" id="newBankDiv">
                                    <form id="add-bank-details-form" class="form-horizontal" action="{{ route('user.bank.store') }}" method="POST">
                                        @csrf
                                        <br/>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Select Bank</label>
                                            <div class="col-sm-10 form-grouping text-bold">
                                                <select style="height: 40px;" class="form-control" id="banks">
                                                    <option value="" disabled selected><strong>Choose Bank</strong></option>
                                                    @foreach ($banks as $bank)
                                                        <option value="{{ json_encode($bank) }}">
                                                            {{ $bank->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <input type="hidden" id="bankCode" name="bankCode">
                                            <input type="hidden" id="bankName" name="bankName">
                                        </div>
                                        <br/>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Account Number</label>

                                            <div class="col-sm-10 form-grouping">
                                                <input type="text" class="form-control" name="accountNumber" id="accountNumber">
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="form-group" id="accountNameField"  style="display: none;">
                                            <label class="col-sm-2 control-label">Account Name</label>

                                            <div class="col-sm-10 form-grouping">
                                                <input  type="text" class="form-control name-input" name="accountName" id="accountName" disabled="true">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-3">
                                                <button  id="resolveBankDetails" class="btn btn-danger btn-flat" disabled="true">Proceed</button>
                                                <button  id="addBank" type="submit" class="btn btn-danger btn-flat" style="display: none;">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-sm-12 col-xs-12" id="bankListDiv">
                                    @if($myBanks->count())
                                        <table class="data table table-striped no-margin">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Bank</th>
                                                    <th>Account No.</th>
                                                    <th class="hidden-phone">Account Name</th>
                                                    <th>action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($myBanks as $bank)
                                                    <tr>
                                                        <form action="{{ route('user.bank.delete',['bank' => $bank->id]) }}" method="POST">
                                                            @method('patch') @csrf
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $bank->bank_name }}</td>
                                                            <td>{{ $bank->acc_no }}</td>
                                                            <td class="hidden-phone">{{ $bank->acc_name }}</td>
                                                            <td>
                                                                <button type="submit" class="btn btn-sm btn-danger">
                                                                    <i class="fa fa-times"></i>
                                                                </button>
                                                            </td>
                                                        </form>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                    <br/>
                                    <div class="text-center">
                                        <button id="addNewBankAccount" class="btn btn-warning btn-flat margin">
                                            <i class="fa fa-bank"></i>
                                            Add {{ $myBanks->count() > 0 ? 'More' : 'New' }} Bank Account
                                        </button>
                                    </div>
                                    <br/>
                                </div>
                            </div>

                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                            <form id="change-password-form" class="form-horizontal" action="{{ route('user.password.edit') }}" method="post">
                                @csrf
                                <br/>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Current Password</label>

                                    <div class="col-sm-10 form-grouping">
                                        <input type="password" class="form-control" name="currentPassword">
                                    </div>
                                </div>
                                <br/>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">New Password</label>

                                    <div class="col-sm-10 form-grouping">
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                </div>
                                <br/>
                                <div class="form-group">
                                    <label for="inputNo" class="col-sm-2 control-label">Comfirm Password</label>

                                    <div class="col-sm-10 form-grouping">
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                    </div>
                                </div>
                                <br/>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-danger btn-flat">Submit</button>

                                    </div>
                                </div>
                            </form>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">

                            <ul class="messages">
                                @foreach ($messages as $message)
                                <li>
                                    <img src="images/img.jpg" class="avatar" alt="Avatar">
                                    <div class="message_date">
                                        <h3 class="date text-info">{{ $message->created_at }}</h3>
                                        <p class="month">May</p>
                                    </div>
                                    <div class="message_wrapper">
                                        <h4 class="heading">{{ $message->sender->name }}</h4>
                                        <blockquote class="message">{{ str_limit($message->content,150,'...') }}</blockquote>
                                        <br />
                                        <p class="url">
                                            <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                            <a href="#"><i class="fa fa-paperclip"></i></a>
                                        </p>
                                    </div>
                                </li>
                                @endforeach
                            </ul>

                        </div>
                    </div>
                </div>
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
                        <p class="text-center"><a href="{{ route('user.register.referrer',['wallet' => Auth::user()->wallet_id]) }}"><span class="h3">{{ route('user.register.referrer',['wallet' => Auth::user()->wallet_id]) }}</span></a></p>
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

                $('#change-password-form').validate({
                    rules: {
                        currentPassword: {
                            required: true,
                        },
                        password: {
                            required: true,
                        },
                        password_confirmation: {
                            equalTo: "#password"
                        }
                    },
                    messages: {
                        password_confirmation: {
                            equalTo: 'Password does not match',
                        }

                    }

                });

                $('#add-bank-details-form').validate({

                });

                $('#addNewBankAccount').click(function(){
                    $('#bankListDiv').hide();
                    $('#newBankDiv').show();
                })

                $('#banks').change(function() {
                    $('#addBank,#accountNameField').hide();
                    $('#resolveBankDetails').show();
                    $('#bankCode').val(JSON.parse($(this).val()).code);
                    $('#bankName').val(JSON.parse($(this).val()).name);
                });

                $('#accountNumber').keyup(function(d){
                    ($(this).val().length >= 10) ? $('#resolveBankDetails').removeAttr('disabled') : $('#resolveBankDetails').attr('disabled',true);
                })


                $('#resolveBankDetails').click(function(e){
                    e.preventDefault();
                    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') } });
                    $('.overlay').show();
                    let timeOut = setTimeout(function(){ notifyError(); },10000);
                    $.ajax({
                        type:'POST',
                        url:'{{ route("paystack.bankDetails") }}',
                        data:{ bankCode : JSON.parse($('#banks').val()).code, bankName : JSON.parse($('#banks').val()).name, accountNumber : $('#accountNumber').val() },
                        success:function(data){
                            console.log(data);
                            clearTimeout(timeOut);
                            data ? addBank(data) : notifyError();
                        }
                    });

                    function addBank(data){
                        $('#accountName').val(data.data.account_name);
                        $('#resolveBankDetails,.overlay').hide();
                        $('#accountNameField,#addBank').show();
                    }

                    function notifyError(){
                        $('#modal-content').text('Invalid acccount details');
                        $('#error-modal').modal('show');
                        $('.overlay').hide();
                    }
                });


            });

        </script>
    @endSection
