@extends('dashboard.layouts.master')

    @section('content-header')
        <div class="page-title">
            <div class="title_left">
                <h4>Pay Bills</h4>
            </div>
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li class="active">Bills</li>
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
                        <h2>Pay Bills</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <section class="container">
                            <br />
                            @foreach ($products->chunk(5) as $chunk)
                                <div class="row visible-md visible-lg">
                                    @foreach ($chunk as $product)
                                        <div class="col-md-2 col-lg-2" style="margin-left: 10px; margin-right: 10px;">
                                            <div class="biller img-rounded">
                                                <a href="{{ route('bills').'/'.strtolower($product->service) }}/{{ $product->id }}" class="bill-link-lg-md center-block">
                                                    <img class="img-responsive" src="/images/bills/{{ $product->logo }}">
                                                </a>
                                                <p class="text-center">{{ $product->name }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <hr class="visible-md visible-lg">
                            @endforeach
                        </section>

                        @foreach ($products->chunk(3) as $chunk)
                            <div class="row visible-xs visible-sm">
                                @foreach ($chunk as $product)
                                    <div class="col-xs-4 col-sm-4">
                                        <div class="biller img-rounded">
                                            <a href="{{ route('bills').'/'.strtolower($product->service)}}/{{ $product->id }}" class="bill-link-sm-xs center-block">
                                                <img class="img-responsive" src="/images/bills/{{ $product->logo }}">
                                            </a>
                                            <p class="text-center">{{ $product->name }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <hr class="visible-xs visible-sm">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endSection

