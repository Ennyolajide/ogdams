@extends('dashboard.layouts.master')

    @section('content-header')

    @endSection

    @section('content')
        <!-- top tiles -->
            <div class="row tile_count">
                <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-envelope"></i> Inbox</span>
                    <div class="count orange" id="unread_messages"></div>
                    <span class="count_bottom">
                        <i class="green">
                            <i class="fa fa-sort-asc"></i>0%
                        </i> All time
                    </span>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-calculator"></i> Transactions</span>
                    <div class="count info">{{ Auth::user()->transactions->count() }} <span class="index_description">Transactions<span></div>
                    <span class="count_bottom">
                        <i class="green">
                            <i class="fa fa-sort-asc"></i>0%
                        </i> All time
                    </span>
                </div>
                <span class="visible-xs"><br/></span>
                <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-users"></i> Referrals</span>
                    <div class="count green">{{ Auth::user()->referrals->count() }} <span class="index_description">User(s)</span></div>
                    <span class="count_bottom">
                        <i class="green">
                            <i class="fa fa-sort-asc"></i>0%
                        </i> All time
                    </span>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-money"></i> Balance</span>
                    <div class="count blue">@naira(Auth::user()->balance)</div>
                    <span class="count_bottom">
                        <i class="green">
                            <i class="fa fa-sort-asc"></i>0%
                        </i> All time
                    </span>
                </div>
            </div>
        <!-- /top tiles -->

   {{--          <div class="count green">2,500</div>
                <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> All time</span>
              </div> --}}

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <!--1. <a href="https://www.ogdams.com/dataresellingbusinessguide.pdf">Download Our Website Guide On Data Reselling Business</a></p>
                             <p>2. <a href="https://www.ogdams.com/airtimetocashguide.pdf">Download Our Website Guide On How To Convert Airtime To Cash</a></p>-->
                            <h2>Recent Transactions<small>Recently performed transactions</small></h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="hidden-xs">Reference</th>
                                        <th>Amount</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th class="hidden-xs">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        function getStatus($transaction){
                                            $array = ['Declined','Pending','Success','Canceled'];
                                            $status = $transaction->status === NULL ? 'Pending' : $array[$transaction->status];
                                            if($transaction->class->type == 'Data Topup'){
                                                $status = $transaction->class->network == '9mobile Gifting' ? $status : str_replace('Pending', 'Success', $status);
                                            }
                                            return $status;

                                        }
                                    @endphp

                                    @foreach ($transactions as $transaction)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td class="hidden-xs">{{ str_limit($transaction->reference, 10, '...') }}</td>
                                            <td class="text-right">@naira($transaction->amount)</td>
                                            <td>{{ $transaction->class->type }}</td>

                                            <td>{{ getStatus($transaction) }}</td>
                                            <td class="hidden-xs">{{ $transaction->created_at }}</td>
                                            <td>
                                            <a href="#" data-toggle="modal" data-target="#{{ $transaction->id }}">
                                                    <i class="fa fa-eye"></i>view
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <div>


            <div class="row">
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <div class="x_panel">
                  <div class="x_title">
                    <h2>Recent News<small>Sessions</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="dashboard-widget-content">

                      <ul class="list-unstyled timeline widget">
                        <li>
                          <div class="block">
                            <div class="block_content">
                              <h2 class="title">
                                <a>About Our Data</a>
                              </h2>
                              <div class="byline">
                                <span>13 hours ago</span> <a>Admin</a>
                              </div>
                              <p class="excerpt">Our Internet/Mobile data plan works on all devices e.g Andriod, Iphone, Blackberry(OS 10), Computers, Modems e.t.c. Data rollover is available if you re-subscribe before the expiry date of current plan.</a>
                              </p>
                              <div class="col-xs-3 col-sm-3 col-md-3">MTN</div>
                              <div class="col-xs-3 col-sm-3 col-md-3">GLO</div>
                              <div class="col-xs-3 col-sm-3 col-md-3">AIRTEL</div>
                              <div class="col-xs-3 col-sm-3 col-md-3">9MOBILE</div>
                              <br/>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>


              <div class="col-md-4 col-sm-4 col-xs-12">



                <div class="row">

                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Info <small>Data-presentation</small></h2>

                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                        <div class="dashboard-widget-content">
                          <div class="col-md-12 hidden-small">
                            <h2 class="line_30">Data Balance Codes:</h2>

                            <table class="countries_list">
                              <tbody>
                                <tr>
                                  <td><img src="\images/networks/mtn.png" style="height: 60px; width:50px;" id="network-image" class="img-responsive"></td>
                                  <td class="h4 text-right text-info">*461*4#</td>
                                </tr>
                                <tr>
                                  <td><img src="\images/networks/9mobile.png" style="height: 60px; width:50px;" id="network-image" class="img-responsive"></td>
                                  <td class="h4 text-right text-info">*228#</td>
                                </tr>
                                <tr>
                                  <td><img src="\images/networks/glo.png" style="height: 60px; width:50px;" id="network-image" class="img-responsive"></td>
                                  <td class="h4 text-right text-info">*127*0#</td>
                                </tr>
                                <tr>
                                  <td><img src="\images/networks/airtel.png" style="height: 60px; width:50px;" id="network-image" class="img-responsive"></td>
                                  <td class="h4 text-right text-info">*140#</td>
                                </tr>

                              </tbody>
                            </table>
                          </div>
                          {{-- <div id="world-map-gdp" class="col-md-8 col-sm-12 col-xs-12" style="height:230px;"></div> --}}
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
          <!-- /page content -->

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
                                <small>Transaction Type : </small>
                                <p class=""><b> {{ $transaction->class->type }}  </b></p>
                            </div>
                            <div class="col-md-5 col-xs-11 col-xs-offset-1 col-sm-offset-1 col-md-offset-1">
                                <small>Transaction {{ $transaction->class->type == 'Data Topup' ? 'Object' : 'MEthod' }} </small>
                                <p class="">
                                    <b>{{ $transaction->class->type == 'Data Topup'
                                            ? $transaction->class->phone : $transaction->method }}
                                    </b>
                                </p>
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
                                <p class=""><b> {{ getStatus($transaction) }} </b></p>
                            </div>
                            <div class="col-md-12 col-xs-12 text-center">
                                <small>Transaction Reference </small>
                                <p class="" style="font-size: 15px;"><b> {{ $transaction->reference }} </b></p>
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

    @section('scripts')
        <script>
            $('#unread_messages').html($('#unread').val()+'<span class="index_description"> Messages</span>');
        </script>
    @endSection
