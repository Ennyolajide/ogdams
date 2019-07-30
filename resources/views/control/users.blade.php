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
                        <h2>Bank Setings</h2>
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
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Search</label>
                                <div class="col-sm-7 col-xs-12">
                                    <input type="text" id="name" name="name" class="form-control pull-right" placeholder="Enter name or email ......."/>
                                    <br/>
                                    <div id="loader">checking ... <img src="\images/loaders/ajax-horizontal-loader.gif"> ......</div>
                                </div>
                                <br/>
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

    @section('scripts')
        <!-- DataTables -->
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.16.0/jquery.validate.min.js"></script>
        <script>
            $(document).ready( () =>{
                $('#loader').hide();
                $("#name").keyup(() => {
                    let user = $('#name').val();

                    if(user.length > 3){
                        $('#loader').show();
                        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') } });

                        $.ajax({
                            type : 'POST',
                            url  : '{{ route("admin.users.search") }}',
                            data : { user : user },
                            success : (response) => {
                                $('#loader').hide();
                                response.forEach((data,index) => {
                                    $('#result').append(`<tr><th scope="row" class="pull-right col-sm-2">${index+1}</th><td><a href="/control/user/${data.id}">${data.email}</a></td><td>--</td><td><a href="/control/user/${data.id}">${data.name}</a></td> </tr>`);
                                });
                            }
                        });

                        return false;
                    }else{
                        $('#loader').hide();
                        $("#result").html('');
                    }
                });
            });
        </script>
    @endSection
