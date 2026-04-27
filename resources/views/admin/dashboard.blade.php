@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="dashboard-area">
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="dashboard-header-title">
                            <h5 class="mb-0">Dashboard</h5>
                            <p class="mb-0">
                                Overview of purchasing, sales, labor cost and daily expenses.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Summary Widgets -->
                <div class="col-sm-6 col-lg-6 col-xxl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="single-widget d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="widget-icon">
                                        <i class="bx bx-cart-alt"></i>
                                    </div>
                                    <div class="widget-desc">
                                        <h5>Total Purchasing</h5>
                                        <p class="mb-0">{{ number_format($totalPurchasing, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-6 col-xxl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="single-widget d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="widget-icon">
                                        <i class="bx bx-receipt"></i>
                                    </div>
                                    <div class="widget-desc">
                                        <h5>Total Sales</h5>
                                        <p class="mb-0">{{ number_format($totalSales, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-6 col-xxl-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="single-widget d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="widget-icon">
                                        <i class="bx bx-user"></i>
                                    </div>
                                    <div class="widget-desc">
                                        <h5>Total Labor Cost</h5>
                                        <p class="mb-0">{{ number_format($totalLaborCost, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-6 col-xxl-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="single-widget d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="widget-icon">
                                        <i class="bx bx-notepad"></i>
                                    </div>
                                    <div class="widget-desc">
                                        <h5>Total Daily Expenses</h5>
                                        <p class="mb-0">{{ number_format($totalDailyExpenses, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-6 col-xxl-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="single-widget d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="widget-icon">
                                        <i class="bx bx-line-chart"></i>
                                    </div>
                                    <div class="widget-desc">
                                        <h5>Total Profit</h5>
                                        <p class="mb-0 {{ $totalProfit >= 0 ? 'text-success' : 'text-danger' }}">
                                            {{ number_format($totalProfit, 2) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Monthly Sales Bar Chart -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div
                                class="card-title mb-30 d-flex align-items-center justify-content-between">
                                <h6 class="mb-0">Monthly Sales</h6>
                            </div>
                            <div class="chart-area">
                                <div id="monthly-sales-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/apexcharts.min.js') }}"></script>
    <script>
        (function () {
            var options = {
                chart: {
                    type: 'bar',
                    height: 320,
                    toolbar: { show: false }
                },
                series: [{
                    name: 'Sales',
                    data: @json($salesData)
                }],
                xaxis: {
                    categories: @json($months)
                },
                colors: ['#4e73df'],
                dataLabels: { enabled: false },
                plotOptions: {
                    bar: {
                        columnWidth: '45%',
                        borderRadius: 4
                    }
                },
                grid: { borderColor: '#f1f1f1' },
                yaxis: {
                    labels: {
                        formatter: function (val) { return val.toFixed(0); }
                    }
                }
            };

            var el = document.querySelector("#monthly-sales-chart");
            if (el) {
                var chart = new ApexCharts(el, options);
                chart.render();
            }
        })();
    </script>
@endpush