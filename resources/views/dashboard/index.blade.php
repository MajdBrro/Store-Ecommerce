@extends('layouts.admin')
@section('title')
{{ __('admin.dashboard') }}
@endsection
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div id="crypto-stats-3" class="row">
                <div class="col-xl-3 col-12">
                    <div class="card crypto-card-3 pull-up">
                        <div class="card-content">
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col-2">
                                        <h1><i class="cc BTC warning font-large-2" title="BTC"></i></h1>
                                    </div>
                                    <div class="col-5 pl-2">
                                        <h4>{{ __('admin.Total-Sales') }}</h4>
                                    </div>
                                    <div class="col-5 text-right">
                                        <h4>$9,980</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <canvas id="btc-chartjs" class="height-75"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-12">
                    <div class="card crypto-card-3 pull-up">
                        <div class="card-content">
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col-2">
                                        <h1><i class="cc ETH blue-grey lighten-1 font-large-2" title="ETH"></i></h1>
                                    </div>
                                    <div class="col-5 pl-2">
                                        <h4>{{ __('admin.Total-Orders') }}</h4>
                                    </div>
                                    <div class="col-5 text-right">
                                        <h4>$944</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <canvas id="eth-chartjs" class="height-75"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-12">
                    <div class="card crypto-card-3 pull-up">
                        <div class="card-content">
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col-2">
                                        <h1><i class="cc XRP info font-large-2" title="XRP"></i></h1>
                                    </div>
                                    <div class="col-5 pl-2">
                                        <h4>{{ __('admin.Total-Products') }}</h4>
                                    </div>
                                    <div class="col-5 text-right">
                                        <h4>$1.2</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <canvas id="xrp-chartjs" class="height-75"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-12">
                    <div class="card crypto-card-3 pull-up">
                        <div class="card-content">
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col-2">
                                        <h1><i class="cc XRP info font-large-2" title="XRP"></i></h1>
                                    </div>
                                    <div class="col-5 pl-2">
                                        <h4>{{ __('admin.Total-Customers') }}</h4>
                                    </div>
                                    <div class="col-5 text-right">
                                        <h4>$1.2</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <canvas id="cus-chartjs" class="height-75"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Candlestick Multi Level Control Chart -->

            <!-- Sell Orders & Buy Order -->
            <div class="row match-height">
                <div class="col-7">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('admin.Latest-Orders') }}</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        </div>
                        <div class="card-content">
                            <div class="table-responsive">
                                <table class="table table-de mb-0">
                                    <thead>
                                    <tr>
                                        <th>{{ __('admin.Order-Number') }}</th>
                                        <th>{{ __('admin.Customer-name') }}</th>
                                        <th>{{ __('admin.Price') }}</th>
                                        <th>{{ __('admin.Status') }}</th>
                                        <th>{{ __('admin.Status') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="bg-success bg-lighten-5">
                                        <td>10583</td>
                                        <td><i class="cc BTC-alt"></i> Majd Brro</td>
                                        <td>15000 S.P</td>
                                        <td>Completed</td>
                                        <td>5000</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-5">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('admin.Latest-Evaluation') }}</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        </div>
                        <div class="card-content">
                            <div class="table-responsive">
                                <table class="table table-de mb-0">
                                    <thead>
                                    <tr>
                                        <th>{{ __('admin.Customer') }}</th>
                                        <th>{{ __('admin.Product') }}</th>
                                        <th>{{ __('admin.Evaluation') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="bg-danger bg-lighten-5">
                                        <td>Majd Brro</td>
                                        <td><i class="cc BTC-alt"></i>wristwatch</td>
                                        <td>5</td>
                                    </tr>
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Sell Orders & Buy Order -->
            <!-- Active Orders -->
            <!-- Active Orders -->
        </div>
    </div>
</div>
@endsection