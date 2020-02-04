@extends('dashboard.layouts.master')

    @section('content-header')
        <div class="page-title">
            <div class="title_left">
                <h3>Transaction</h3>
            </div>
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li class="active">Search</li>
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
                        <h3>Transactions</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Search</label>
                                <div class="col-sm-7 col-xs-12">
                                    <input type="text" id="reference" name="reference" class="form-control pull-right" placeholder="Enter transaction reference ......."/>
                                    <div id="loader">checking ... <img src="\images/loaders/ajax-horizontal-loader.gif"> ......</div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                                <br/>
                                <table id="result" class="table table-hover">

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endSection

    <div id="result_modal"></div>

    @section('scripts')
        <!-- DataTables -->
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.16.0/jquery.validate.min.js"></script>
        <script>
            $(document).ready( () =>{
                $('#loader').hide();
                $("#reference").keyup(() => {
                    $('.result_row').remove();
                    let reference = $('#reference').val();

                    if(reference.length > 3){
                        $('#loader').show();
                        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') } });

                        $.ajax({
                            type : 'POST',
                            url  : '{{ route("admin.transaction.search") }}',
                            data : { reference: reference },
                            success : (response) => {
                                $('#loader').hide();
                                response.forEach((data,index) => {
                                    let record = data.record;
                                    $('#result').append(`<tr class="result_row"><th scope="row" class="pull-right col-sm-2">${index+1}</th><td><a href="#" data-toggle="modal" data-target="#${data.id}">${data.reference}</a></td><td>--</td><td>
                                        <a href="#" data-toggle="modal" data-target="#${data.id}"> <i class="fa fa-eye"></i></a>
                                        <a href="#" data-toggle="modal" data-target="#${data.id}">&#8358;${data.amount}</a>

                                        </td><td>${data.created_at}</td> </tr>`);

                                    $('#result_modal').append(`
                                        <!-- Modal -->
                                            <div id="${data.id}" class="modal fade" role="dialog">
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
                                                                <small>Transaction Type :</small>
                                                                <p class="text-justify" style="font-size: 15px;"><b>${data.type}</b></p>
                                                            </div>
                                                            <div class="col-md-5 col-xs-11 col-xs-offset-1 col-sm-offset-1 col-md-offset-1">
                                                                <small>Transaction method : </small>
                                                                <p class=""><b>${data.method}</b></p>

                                                            </div>
                                                            <div class="col-md-5 col-xs-11  col-xs-offset-1 col-sm-offset-1 col-md-offset-1">
                                                                <small>User :</small>
                                                                <p class="text-justify" style="font-size: 15px;">
                                                                    <b><a href="/control/user/${data.user.id}">${data.user.email}</a> </b>
                                                                </p>
                                                            </div>
                                                            <div class="col-md-5 col-xs-11 col-xs-offset-1 col-sm-offset-1 col-md-offset-1">
                                                                <small>Transaction Date : </small>
                                                                <p class=""><b>${data.created_at}</b></p>

                                                            </div>
                                                            <div class="col-md-5 col-xs-11 col-xs-offset-1 col-sm-offset-1 col-md-offset-1">
                                                            <small>Transaction Amount : </small>
                                                                <p class=""><b>&#8358;${data.amount} </b></p>
                                                            </div>
                                                            <div class="col-md-5 col-xs-11 col-xs-offset-1 col-sm-offset-1 col-md-offset-1">
                                                                <small> Before : </small>
                                                                <p class=""><b>&#8358;${data.balance_before} </b></p>
                                                            </div>
                                                            <div class="col-md-5 col-xs-11 col-xs-offset-1 col-sm-offset-1 col-md-offset-1">
                                                                <small>Balance After : </small>
                                                                <p class=""><b>&#8358;${data.balance_after}</b></p>
                                                            </div>
                                                            <div class="col-md-5 col-xs-11 col-xs-offset-1 col-sm-offset-1 col-md-offset-1">
                                                                <small>Transaction Status </small>
                                                                <p class=""><b> ${getStatus(data.status)} </b></p>
                                                            </div>
                                                            <div class="col-md-11 col-xs-11 text-center">
                                                                <small class="text-bold">Transaction Reference :</small>
                                                                <p class="h4"><b>${data.reference} </b></p>
                                                            </div>
                                                            <div class="col-md-11 col-xs-11 text-center" id="details">
                                                                <small class="text-bold">Transaction Details :</small>
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
                                    `);
                                    /*
                                    $(var index in record){
                                        console.log(record['index']);
                                    } */

                                    $.each( data.record, function( key, value ) {

                                        filterTransactionObject(key) ? $('#details').append(`<p class="h4 text-bold">${key} : ${value}</p>`) : '';
                                    });
                                });


                            }
                        });

                        return false;
                    }else{
                        $('#loader').hide();
                        $("#result").html('');
                    }
                });

                function getStatus(status){
                    array = ['Declined','Pending','Success','Canceled'];
                    return status === null ? 'Pending' : array[status];
                }

                function filterTransactionObject(key){
                    array = ['id', 'user_id', 'amount','class','created_at', 'updated_at','responseObject', 'status', ];
                    return $.inArray(key, array) > -1 ? false : true;
                }
            });
        </script>
        <script>

        </script>
    @endSection




