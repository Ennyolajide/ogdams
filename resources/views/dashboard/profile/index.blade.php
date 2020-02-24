@extends('dashboard.layouts.master')

    @section('title')Profile @endsection

    @section('style')
        <style>
            @import url(https://fonts.googleapis.com/css?family=Titillium+Web:400,200,200italic,300,300italic,900,700italic,700,600italic,600,400italic);
            .countdown-body{
                font-family: 'Titillium Web', cursive;
                width: auto;
                text-align: center;
                color: white;
                background: #222;
                font-weight: 70;
            }
            .countdown-div {
                display: inline-block;
                line-height: 1;
                padding: 8px;
                font-size: 40px;
            }
            .countdown-span {
                display: block;
                font-size: 12px;
                color: white;
            }
            .instructions-span{
                margin-bottom: 5px;
            }
            #minutes {
                font-size: 25px;
                color: #f6da74;
            }
            #seconds {
                font-size: 20px;
                color: #abcd58;
            }
        </style>
    @endsection

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
                        <img class="avatar-view" src="\images/avatar/{{ Auth::user()->avatar ?? 'default.png' }}" alt="Avatar" title="Change the avatar">
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
                    <li><h4>Wallet ID : <span class="text-primary">{{ Auth::user()->wallet_id }}</span></h4></li>
                </ul>
                <a href="{{ route('user.profile') }}#profile" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                <br />
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#inbox" id="inbox-tab" role="tab" data-toggle="tab" aria-expanded="true">Inbox</a>
                                </li>
                                <li role="presentation" class="">
                                    <a href="#profile" role="profile-tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Profile</a>
                                </li>
                                <li role="presentation" class="">
                                    <a href="#bank" role="bank-tab" id="bank-tab" data-toggle="tab" aria-expanded="false">Bank(s)</a>
                                </li>
                                <li role="presentation" class="">
                                    <a href="#verify" role="verify-tab" id="verify-tab" data-toggle="tab" aria-expanded="false">Verification</a>
                                </li>
                            </ul>
                            <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="inbox" aria-labelledby="inbox-tab">
                                    <div class="mailbox-messages">
                                        <table class="table table-hover table-striped">
                                            <tbody>
                                                @foreach ($messages as $message)
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox">
                                                        </td>
                                                        <td class="mailbox-star">
                                                            @if ($message->read)
                                                                <a href="#"><i class="fa fa-star-o text-yellow"></i></a>
                                                            @else
                                                                <a href='#'><i class='fa fa-star text-yellow'></i></a>
                                                            @endif
                                                        </td>
                                                        <td class="mailbox-name">
                                                            <a href="{{ route('messages.message',$message->id) }}" class="submit" type="submit">
                                                            {{ $message->sender->name }}</a>
                                                        </td>
                                                        <td class="mailbox-subject">
                                                            <b>{{ $message->subject }}</b> -
                                                            <a href="{{ route('messages.message',$message->id) }}">{{ str_limit($message->content,100,'...') }}</a></td>
                                                        <td class="mailbox-attachment"></td>
                                                        <td class="mailbox-date">{{ $message->created_at->diffForHumans() }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <!-- /.table -->
                                        <div class="col-md-12 text-right">
                                            <div class="pull-right">
                                                @if ($messages->hasPages())
                                                    {{ $messages->firstItem() }} - {{ $messages->lastItem() }}/{{ $messages->total() }}
                                                    <div class="btn-group">
                                                        {{-- Previous Page Link --}}
                                                        @if (!$messages->onFirstPage())
                                                            <button type="button" class="previousPage btn btn-default btn-sm">
                                                                <i class="fa fa-chevron-left"></i>
                                                            </button>
                                                        @endif
                                                        {{-- Next Page Link --}}
                                                        @if ($messages->hasMorePages())
                                                            <button type="button" class="nextPage btn btn-default btn-sm">
                                                                <i class="fa fa-chevron-right"></i>
                                                            </button>
                                                        @endif

                                                    </div>
                                                    <!-- /.btn-group -->
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <form id="change-password-form" class="form-horizontal" action="{{ route('user.password.edit') }}" method="post">
                                                @csrf
                                                <br/>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-xs-12 control-label">Current Password</label>

                                                    <div class="col-sm-9 col-xs-12 form-grouping">
                                                        <input type="password" class="form-control" name="currentPassword">
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-xs-12 control-label">New Password</label>

                                                    <div class="col-sm-9 col-xs-12 form-grouping">
                                                        <input type="password" class="form-control" id="password" name="password">
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-xs-12 control-label">Comfirm Password</label>

                                                    <div class="col-sm-9 col-xs-12  form-grouping">
                                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="form-group row">
                                                    <div class="col-xs-12 col-md-12">
                                                        <button type="submit" class="btn btn-danger btn-flat pull-right">Submit</button>

                                                    </div>
                                                    <br/><br/>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="bank" aria-labelledby="bank-tab">
                                    <div class="row">
                                        <h4 class="text-danger text-center"><strong>Charges @naira($charges->where('service','addbank')->first()->amount) Apply </strong></h3>
                                        <div class="col-xs-12 col-sm-12 col-md-12" style="display:none;" id="newBankDiv">
                                            <form id="add-bank-details-form" class="form-horizontal" action="{{ route('user.bank.store') }}" method="POST">
                                                @csrf
                                                <br/>

                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-xs-12 control-label">Select Bank</label>
                                                    <div class="col-sm-9 col-xs-12 form-grouping text-bold">
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
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-xs-12 control-label">Account Number</label>

                                                    <div class="col-sm-9 col-xs-12 form-grouping">
                                                        <input type="text" class="form-control" name="accountNumber" id="accountNumber">
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="form-group row" id="accountNameField"  style="display: none;">
                                                    <label class="col-sm-3 col-xs-12 control-label">Account Name</label>

                                                    <div class="col-sm-9 col-xs-12 form-grouping">
                                                        <input  type="text" class="form-control name-input" name="accountName" id="accountName" disabled="true">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12 col-xs-12">
                                                        <button  id="resolveBankDetails" class="btn btn-danger btn-flat pull-right" disabled="true">Proceed</button>
                                                        <button  id="addBank" type="submit" class="btn btn-danger btn-flat pull-right" style="display: none;">Submit</button>
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
                                <div role="tabpanel" class="tab-pane fade" id="verify" aria-labelledby="verify-tab">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            @if(session('otp'))
                                                <form id="otp-verification-input-form" class="form-horizontal" action="{{ route('user.bvn.otp.verify') }}" method="post">
                                                    @csrf
                                                    <br/>
                                                    <div class="row text-center">
                                                        <div class="col-sm-offset-3 col-xs-offset-1 col-sm-5 col-xs-10">
                                                            <div class="countdown-body">
                                                                <div class="countdown-span" id="timer">
                                                                    <div class="countdown-div" id="days" style="display: none;"></div>
                                                                    <div class="countdown-div" id="hours" style="display: none;"></div>
                                                                    <div class="countdown-div" id="minutes"></div>
                                                                    <div class="countdown-div" id="seconds"></div>
                                                                </div>
                                                            </div>
                                                            <span class="help-block text-info instructions"> OTP expires in 10 minute</span>
                                                        </div>
                                                    </div>
                                                    <script>
                                                        let timeNow = new Date();
                                                        timeNow.setMinutes(timeNow.getMinutes() + 10);
                                                        setInterval(function() { makeTimer(timeNow); }, 1000);
                                                    </script>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-xs-12 control-label">OTP</label>
                                                        <div class="col-sm-7 col-xs-12 form-grouping">
                                                            <input type="text" class="form-control" name="otp" placeholder="Enter the OTP sent to your phone number">
                                                        </div>
                                                    </div>
                                                    <br/>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-xs-12 control-label">Date of Birth</label>
                                                        <div class="col-sm-7 col-xs-12 form-grouping">
                                                            <input type="date" class="form-control" name="dob">
                                                        </div>
                                                    </div>
                                                    <br/>
                                                    <div class="form-group row">
                                                        <div class="col-xs-12 col-sm-9">
                                                            <button type="submit" class="btn btn-danger btn-flat pull-right">Submit</button>
                                                        </div>
                                                        <br/><br/>
                                                    </div>
                                                </form>
                                            @else
                                                @if(Auth::user()->bvn_verified)
                                                    <h5 class="text-center text-success"> User Account has been verified</h5>
                                                @else

                                                    <form id="bvn-verification-input-form" class="form-horizontal form-prevent-multiple-submits" action="{{ route('user.bvn.details') }}" method="post">
                                                        @csrf
                                                        <br/><h4 class="text-danger text-center"><strong>Charges @naira($charges->where('service','bvn')->first()->amount) Applies </strong></h3>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-xs-12 control-label">BVN</label>
                                                            <div class="col-sm-7 col-xs-12 form-grouping">
                                                                <input type="text" class="form-control" name="bvn" placeholder="Enter your Bank Verification Number" {{ Auth::user()->bvn_verified ? 'disabled' : '' }}>
                                                            </div>
                                                        </div>
                                                        <br/>
                                                        <div class="form-group row">
                                                            <div class="col-xs-12 col-sm-9">
                                                                <button type="submit" class="btn btn-danger btn-flat pull-right {{ Auth::user()->bvn_verified ? 'disabled' : '' }}">Submit</button>
                                                            </div>
                                                            <br/>
                                                        </div>
                                                    </form>
                                                @endif
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-8 col-xs-8">
                                    @include('dashboard.layouts.errors')
                                </div>
                            </div>
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
                        <p class="text-center"><a href="{{ route('user.register',['referrer' => Auth::user()->wallet_id]) }}#signup"><span class="h3">{{ route('user.register',['referrer' => Auth::user()->wallet_id]) }}#signup</span></a></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
        <div class="clearfix">.</div>
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

                $('#otp-verification-input-form').validate({
                    rules: {
                        otp: { required: true, },
                        dob: { required: true, date: true}
                    },
                    messages: {
                        otp: { required: 'Enter the otp sent to your BVN mobile number' },
                        dob: { required: 'Enter your date of birth' }
                    }
                });

                $('#bvn-verification-input-form').validate({
                    rules: {
                        bvn: {
                            required: true,
                        },
                    },
                    messages: {
                        bvn: {
                            required: 'Enter your Bank verification number',
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
                            //console.log(data);
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

        <script>
            function makeTimer(endTime) {

                endTime = (Date.parse(endTime) / 1000);
                var now = new Date();
                now = (Date.parse(now) / 1000);

                var timeLeft = endTime - now;

                var days = Math.floor(timeLeft / 86400);
                var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
                var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600 )) / 60);
                var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));

                if (hours < "10") { hours = "0" + hours; }
                if (minutes < "10") { minutes = "0" + minutes; }
                if (seconds < "10") { seconds = "0" + seconds; }

                $("#days").html(days + "<span class='countdown-span'>Days</span>");
                $("#hours").html(hours + "<span class='countdown-span'>Hours</span>");
                $("#minutes").html(minutes + "<span class='countdown-span'>Minutes</span>");
                $("#seconds").html(seconds + "<span class='countdown-span'>Seconds</span>");

                if(endTime <= now){
                    $('.countdown-body').hide();
                    $('.instructions').html("<span class='text-danger'>OTP has expired</span>");
                    $('#otp-verification-input-form').find('input').attr('disabled',true);
                    $('#otp-verification-input-form').find('button').attr('disabled',true);
                }
            }
        </script>

        <script>
            $(function() {
                $('.previousPage').click( function(){
                    window.location.href='{{ $messages->previousPageUrl() }}';
                });

                $('.nextPage').click( function(){
                    window.location.href='{{ $messages->nextPageUrl() }}';
                });

                //$('a[href="' + window.location.hash + '"]').click();
                var hash = location.hash, hashPieces = hash.split('?') , activeTab = $('[href=' + hashPieces[0] + ']');
                activeTab && activeTab.tab('show');

            });
        </script>
    @endSection
