@extends('dashboard.layouts.master')

    @section('content-header')
        <div class="page-title">
            <div class="title_left">
                <h4>Testimonial</h4>
            </div>
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-dashboard"></i> Home</a>
                    </li>
                    <li class="active">Write Testimonial</li>
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
                        <h2>Write Testimonial</h2>
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
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <br/>
                                <form id="testimony-form" method="POST" action="{{ route('testimonial.store') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-xs-12  control-label">Testimony</label>
                                        <div class="col-sm-8 col-xs-12  form-grouping">
                                            <textarea placeholder="Enter message" id="testimony" name="testimony" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 2px solid #dddddd; padding: 10px;" {{ Auth::user()->testimonials->count() ? 'disabled' : '' }}></textarea>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-xs-12 control-label"></label>
                                        <div class="col-sm-8 col-xs-12 form-grouping">
                                            <button id="continue" class="btn btn-flat btn-success pull-right" type="submit">Send
                                                <i class="fa fa-arrow-circle-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <br/>
                                </form>
                                <!--/div-->
                            </div>
                        </div>
                        @include('dashboard.layouts.errors')
                        <br/>
                    </div>

                    <!-- /.box-body -->

                    <!-- .box-footer -->
                    @include('dashboard.layouts.box-footer')
                    <!-- /.box-footer -->
                    <!-- /.box -->
                </div>
            </div>
        </div>
    </div>
    @endSection

    @section('scripts')
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.16.0/jquery.validate.min.js"></script>
        <script>
            $(document).ready(function() {

                $.validator.setDefaults({
                    errorClass: 'help-block',
                    highlight: function(element) {
                        $(element)
                            .closest('.form-grouping')
                            .addClass('has-error');
                    },
                    unhighlight: function(element) {
                        $(element)
                            .closest('.form-grouping')
                            .removeClass('has-error');
                    }
                });

                $('#testimony-form').validate({
                    rules: {
                        testimony: { required: true, minlength: 30, maxlength: 150 }
                    },
                    messages: {
                        testimony: {
                            minlength: $.validator.format("Minimum of {0} characters required."),
                            maxlength: $.validator.format("Maximum {0} characters.")
                        }
                    }
                });
            });
        </script>
    @endSection
