@extends('dashboard.layouts.master')

    @section('content-header')

    @endSection

    @section('content')
        <!-- top tiles -->
        <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
                <div class="count">2500</div>
                <span class="count_bottom"><i class="green">4% </i> From last Week</span>
              </div>
              <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-clock-o"></i> Average Time</span>
                <div class="count">123.50</div>
                <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
              </div>
              <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Total Males</span>
                <div class="count green">2,500</div>
                <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
              </div>
              <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Total Females</span>
                <div class="count">4,567</div>
                <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
              </div>
              <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Total Collections</span>
                <div class="count">2,315</div>
                <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
              </div>
              <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Total Connections</span>
                <div class="count">7,325</div>
                <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
              </div>
            </div>
            <!-- /top tiles -->

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Recent Transactions<small>Recently performed transactions</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Settings 1</a></li>
                                        <li><a href="#">Settings 2</a></li>
                                    </ul>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                            </ul>
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
                                        function getStatus($status){
                                            $array = ['Declined','Pending','Success','Canceled'];
                                            return $status ? $array[$status] : 'Decline';
                                        }
                                    @endphp

                                    @foreach ($transactions as $transaction)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
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
                            </table>
                        </div>
                    </div>
                </div>
            <div>

            <div class="row x_title">
                <div class="col-md-6">
                      <h3>Network Activities <small>Graph title sub-title</small></h3>
                </div>
                <div class="col-md-6">
                    <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                        <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                    </div>
                </div>
            </div>



            <div class="row">
              <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Recent News<small>Sessions</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
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
                                <span>13 hours ago</span> by <a>Jane Smith</a>
                              </div>
                              <p class="excerpt">Our internet/mobile data plan works with all devices e.g Andriod, Iphone, Blackberry(OS 10), computers, modems e.t.c. Data rollover if you re-subscribe before expiry of current plan.</a>
                              </p>
                              <p>To check your data balance</p>
                              <p>MTN >> *461*2*3*1#</p>
                              <p>Etisalat >> *228#</p>
                              <p>GLO >> *127*0#</p>
                              <p>AirTel >> *140#</p>
                            </div>
                          </div>
                        </li>


                        <li>
                          <div class="block">
                            <div class="block_content">
                              <h2 class="title">
                                                <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                            </h2>
                              <div class="byline">
                                <span>13 hours ago</span> by <a>Jane Smith</a>
                              </div>
                              <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                              </p>
                            </div>
                          </div>
                        </li>
                        <li>
                          <div class="block">
                            <div class="block_content">
                              <h2 class="title">
                                                <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                            </h2>
                              <div class="byline">
                                <span>13 hours ago</span> by <a>Jane Smith</a>
                              </div>
                              <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                              </p>
                            </div>
                          </div>
                        </li>
                        <li>
                          <div class="block">
                            <div class="block_content">
                              <h2 class="title">
                                                <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                            </h2>
                              <div class="byline">
                                <span>13 hours ago</span> by <a>Jane Smith</a>
                              </div>
                              <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                              </p>
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
                        <ul class="nav navbar-right panel_toolbox">
                          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                          </li>
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                              <li><a href="#">Settings 1</a>
                              </li>
                              <li><a href="#">Settings 2</a>
                              </li>
                            </ul>
                          </li>
                          <li><a class="close-link"><i class="fa fa-close"></i></a>
                          </li>
                        </ul>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                        <div class="dashboard-widget-content">
                          <div class="col-md-12 hidden-small">
                            <h2 class="line_30">To check your data balance</h2>

                            <table class="countries_list">
                              <tbody>
                                <tr>
                                  <td><img src="\images/networks/mtn.png" style="height: 60px; width:50px;" id="network-image" class="img-responsive"></td>
                                  <td class="h4 text-right text-info">*461*2*3*1#</td>
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
                          <div id="world-map-gdp" class="col-md-8 col-sm-12 col-xs-12" style="height:230px;"></div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
                <div class="row">
                  <!-- start of weather widget -->
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Daily active users <small>Sessions</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                          </li>
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                              <li><a href="#">Settings 1</a>
                              </li>
                              <li><a href="#">Settings 2</a>
                              </li>
                            </ul>
                          </li>
                          <li><a class="close-link"><i class="fa fa-close"></i></a>
                          </li>
                        </ul>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="temperature"><b>Monday</b>, 07:30 AM
                              <span>F</span>
                              <span><b>C</b></span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-4">
                            <div class="weather-icon">
                              <canvas height="84" width="84" id="partly-cloudy-day"></canvas>
                            </div>
                          </div>
                          <div class="col-sm-8">
                            <div class="weather-text">
                              <h2>Texas <br><i>Partly Cloudy Day</i></h2>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="weather-text pull-right">
                            <h3 class="degrees">23</h3>
                          </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="row weather-days">
                          <div class="col-sm-2">
                            <div class="daily-weather">
                              <h2 class="day">Mon</h2>
                              <h3 class="degrees">25</h3>
                              <canvas id="clear-day" width="32" height="32"></canvas>
                              <h5>15 <i>km/h</i></h5>
                            </div>
                          </div>
                          <div class="col-sm-2">
                            <div class="daily-weather">
                              <h2 class="day">Tue</h2>
                              <h3 class="degrees">25</h3>
                              <canvas height="32" width="32" id="rain"></canvas>
                              <h5>12 <i>km/h</i></h5>
                            </div>
                          </div>
                          <div class="col-sm-2">
                            <div class="daily-weather">
                              <h2 class="day">Wed</h2>
                              <h3 class="degrees">27</h3>
                              <canvas height="32" width="32" id="snow"></canvas>
                              <h5>14 <i>km/h</i></h5>
                            </div>
                          </div>
                          <div class="col-sm-2">
                            <div class="daily-weather">
                              <h2 class="day">Thu</h2>
                              <h3 class="degrees">28</h3>
                              <canvas height="32" width="32" id="sleet"></canvas>
                              <h5>15 <i>km/h</i></h5>
                            </div>
                          </div>
                          <div class="col-sm-2">
                            <div class="daily-weather">
                              <h2 class="day">Fri</h2>
                              <h3 class="degrees">28</h3>
                              <canvas height="32" width="32" id="wind"></canvas>
                              <h5>11 <i>km/h</i></h5>
                            </div>
                          </div>
                          <div class="col-sm-2">
                            <div class="daily-weather">
                              <h2 class="day">Sat</h2>
                              <h3 class="degrees">26</h3>
                              <canvas height="32" width="32" id="cloudy"></canvas>
                              <h5>10 <i>km/h</i></h5>
                            </div>
                          </div>
                          <div class="clearfix"></div>
                        </div>
                      </div>
                    </div>

                  </div>
                  <!-- end of weather widget -->
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
                                <small>Transaction Reference :</small>
                                <p class=""><b> {{ '7e38yrb8383hnfj8f8' }} </b></p>
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
