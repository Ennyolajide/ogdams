@extends('dashboard.layouts.master')

    @section('content-header')
        <div class="page-title">
            <div class="title_left">
                <h3>Data Topup</h3>
            </div>
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-dashboard"></i> Home</a>
                    </li>
                    <li class="active">Data</li>
                </ol>
            </div>
        </div>
        <div class="clearfix"></div>
    @endsection

    @section('content')
        <!-- Main content -->
        <div class="row" id="content">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Buy Data</h2>
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
                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                <div class="row">
                                    <div class="col-xs-12 col-md-12">
                                        <br/>
                                        <img v-if="networkImage" v-bind:src="networkImage" style="height: 60px; width:50px; margin-right:5px;" class="img-responsive pull-right">
                                    </div>
                                </div>
                                <form id="data-purchase-form" class="form-horizontal form-prevent-multiple-submits" action="{{ route('data.buy') }}" method="post">
                                    @csrf
                                    <br/>
                                    <div class="form-group" id="choose-wallet-type">
                                        <label class="col-sm-2 col-xs-12 control-label">Network</label>

                                        <div class="col-sm-10 col-xs-12 form-grouping">
                                            <select class="form-control"  v-model="dataPlans"  v-on:change="showPlans">
                                                <option value="" disabled>Select Network Type</option>
                                                <option v-for="network in networks" v-bind:value="network">
                                                    ${ network[0].network.toUpperCase() }
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <br/>
                                    <div id="other-fields">
                                        <div class="form-group" id="data-plan">
                                            <label class="col-sm-2 col-xs-12 control-label" >Choose Data Plan</label>
                                            <div class="col-sm-10 col-xs-12  form-grouping">
                                                <select class="form-control" name="plan" v-model="dataPlan">
                                                    <option value="" disabled>Choose a Data Plan</option>
                                                    <option v-for="dataPlan in dataPlans" v-bind:value="dataPlan.id">
                                                        ${ dataPlan.volume } = ₦ ${ dataPlan.amount }
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="form-group">
                                            <label class="col-sm-2 col-xs-12 control-label">Phone Number</label>
                                            <div class="col-sm-10 col-xs-12 form-grouping">
                                                <input type="text" class="form-control" name="phone" placeholder="Please Enter Phone Number">
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="form-group">
                                            <div class="col-x-12">
                                                <button id="submit" class="btn btn-flat btn-success pull-right button-prevent-multiple-submits">&nbsp;&nbsp;&nbsp;&nbsp;Submit&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                            </div>
                                            <br/>
                                        </div>
                                    </div>
                                </form>
                                <br/><br/>
                                <div class="form-grouping">
                                    <div class="row">
                                        @foreach ($networks as $network)
                                            @if ($network[0]->addon)
                                                @continue
                                            @endif
                                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                <img src="\images/networks/{{ strtolower($network[0]->network) }}.png" class="img-responsive">
                                            </div>
                                        @endforeach
                                    </div>
                                    <br/><br/><br/>
                                </div>
                            </div>
                        </div>
                        @include('dashboard.layouts.errors')
                    </div>
                     <!-- /.box-body -->
                     <!-- .box-footer -->
                     @include('dashboard.layouts.box-footer')
                     <!-- /.box-footer -->
                 </div>
                 <!-- /.box -->
             </div>
        </div>
     @endSection

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

                $('#data-purchase-form').validate({
                    rules: {
                        phone: {
                            required: true,
                            number: true
                        },
                        plan: {
                            required: true,
                        }
                    },
                    messages: {
                        phone: {
                            required: "Please enter phone number.",
                            number:  "Phone numbers only "
                        },
                        plan: {
                            required: "Please select a dataplan",
                        }

                    }
                });

               /*  $('#network').change(function() {
                    console.log($('#network').val());
                    $('#network-images,#data-plan,.plans').hide();
                    $('#other-fields,#network-image').show();
                    let networks = @json($networks);
                    let networkId = $('#network').val();
                    console.log(networks);
                    let network = networks.splice((networkId-1),1)[0].network.toLowerCase().replace(/ /g,'');
                    $('#data-plan,.'+network).show();
                    $('#network-image').attr('src','\images/networks/'+network+'.png');
                }); */

            });


            new Vue({
                delimiters: ['${', '}'],
                el : '#content',
                data : {
                    dataPlan : '',
                    dataPlans : '',
                    networkImage : false,
                    networks: @json($networks),
                },
                methods : {
                    showPlans : function () {
                        if(this.dataPlans.length > 0){
                            if(this.dataPlans[0].network == '9mobile Gifting') {
                                this.networkImage = '/images/networks/9mobile.png';
                            }else{
                                this.networkImage = `/images/networks/${this.dataPlans[0].network.toLowerCase()}.png`;
                                console.log(this.networkImage);
                            }
                        }
                    },


                }

            });
        </script>
    @endSection
