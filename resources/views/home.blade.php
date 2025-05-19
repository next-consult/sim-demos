@extends('layouts.app')

@section('content')
    <!-- Right Side Content Start -->


    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-6  col-sm-6">
                        <div class="seipkon-breadcromb-left">
                            <h3>Dashboard</h3>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="seipkon-breadcromb-right">
                            <ul>
                                <li><a href="index.html">home</a></li>
                                <li>dashboard</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcromb Row -->

    <!-- Widget Row Start -->
    <div class="row">
        <div class="col-md-3">
            <div id="clock" class="widget_card alert">
                <div class="widget_card_header">
                    <span class="widget_close" data-toggle="tooltip" title="Remove" data-dismiss="alert" aria-label="close">
                        <i class="fa fa-times"></i>
                    </span>
                </div>
                <div class="widget_card_body">
                    <p class="date"> date </p>
                    <h3 class="time"> time </h3>
                </div>
            </div>
        </div>
        <!-- End Col -->
        <div class="col-md-3">
            <div id="widget_visitor" class="widget_card alert">
                <div class="widget_card_header">
                    <span class="widget_close" data-toggle="tooltip" title="Remove" data-dismiss="alert" aria-label="close">
                        <i class="fa fa-times"></i>
                    </span>
                </div>
                <div class="widget_card_body">
                    <div class="widget_icon">
                        <i class="fa fa-eye"></i>
                    </div>
                    <div class="widget_text">
                        <h3 class="count">12023</h3>
                        <p>Total visitor</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Col -->
        <div class="col-md-3">
            <div id="widget_user" class="widget_card alert">
                <div class="widget_card_header">
                    <span class="widget_close" data-toggle="tooltip" title="Remove" data-dismiss="alert" aria-label="close">
                        <i class="fa fa-times"></i>
                    </span>
                </div>
                <div class="widget_card_body">
                    <div class="widget_icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="widget_text">
                        <h3 class="count">739</h3>
                        <p>Registred users</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Col -->
        <div class="col-md-3">
            <div id="widget_profits" class="widget_card alert">
                <div class="widget_card_header">
                    <span class="widget_close" data-toggle="tooltip" title="Remove" data-dismiss="alert" aria-label="close">
                        <i class="fa fa-times"></i>
                    </span>
                </div>
                <div class="widget_card_body">
                    <div class="widget_icon">
                        <i class="fa fa-flask"></i>
                    </div>
                    <div class="widget_text">
                        <h3>$<span class="count">2537</span></h3>
                        <p>Monthly Profits</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Col -->
    </div>
    <!-- End Widget Row -->

    <!-- Widget Row Start -->
    <div class="row">
        
        <!-- End Col -->
        <div class="col-md-7">
            <div class="widget_card_two alert">
                <div class="widget_card_header">
                    <h3>Sales Statistics</h3>
                    <ul>
                        <li>
                            <a class="widget_card_accordion" data-toggle="collapse" href="#chart_1" role="button"
                                aria-expanded="false" aria-controls="chart_1"></a>
                        </li>
                        <li>
                            <a href="#" class="widget_close_two" data-toggle="tooltip" title="Remove"
                                data-dismiss="alert" aria-label="close">
                                <i class="fa fa-times"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="widget_card_body collapse in" id="chart_1">
                    <div class="chart">
                        <div id="sales_chart"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="widget_card_two alert">
                <div class="widget_card_header">
                    <h3>Earnings reports</h3>
                    <ul>
                        <li>
                            <a class="widget_card_accordion" data-toggle="collapse" href="#Earnings" role="button"
                                aria-expanded="false" aria-controls="Earnings"></a>
                        </li>
                        <li>
                            <a href="#" class="widget_close_two" data-toggle="tooltip" title="Remove"
                                data-dismiss="alert" aria-label="close">
                                <i class="fa fa-times"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="widget_card_body collapse in" id="Earnings">
                    <div class="chart">
                        <ul class="earning_chart">
                            <li>
                                <h4>today</h4>
                                <p>155</p>
                            </li>
                            <li>
                                <h4>Last week</h4>
                                <p>783</p>
                            </li>
                            <li>
                                <h4>Last Month</h4>
                                <p>2632</p>
                            </li>
                        </ul>
                        <div id="donut-example" style="height:250px"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Col -->
    </div>


    <!-- End Right Side Content -->
@endsection
