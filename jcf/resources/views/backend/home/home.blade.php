@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
        <!-- Dashboard Analytics Start -->
        <section id="dashboard-analytics">
            <div class="row match-height">
                <!-- Greetings Card starts -->
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="card card-congratulations">
                        <div class="card-body text-center">
                            <img src="{{asset('backend/app-assets/images/elements/decore-left.png')}}" class="congratulations-img-left" alt="card-img-left" />
                            <img src="{{asset('backend/app-assets/images/elements/decore-right.png')}}" class="congratulations-img-right" alt="card-img-right" />
                            <div class="avatar avatar-xl bg-primary shadow">
                                <div class="avatar-content">
                                    <i data-feather="award" class="font-large-1"></i>
                                </div>
                            </div>
                            <div class="text-center">
                                <h1 class="mb-1 text-white">Welcome to {{$setting->title}}</h1>
                                <p class="card-text m-auto w-75">
                                    <strong>{{$setting->meta_keywords}}</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Greetings Card ends -->

                <!-- Subscribers Chart Card starts -->
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header flex-column align-items-start pb-0">
                            <div class="avatar bg-light-primary p-50 m-0">
                                <div class="avatar-content">
                                    <i data-feather="users" class="font-medium-5"></i>
                                </div>
                            </div>
                            <h2 class="font-weight-bolder mt-1">{{ number_format($totalMembers ?? 0) }}</h2>
                            <p class="card-text">Total Members</p>
                        </div>
                        <div id="gained-chart"></div>
                    </div>
                </div>
                <!-- Subscribers Chart Card ends -->

                <!-- Orders Chart Card starts -->
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header flex-column align-items-start pb-0">
                            <div class="avatar bg-light-warning p-50 m-0">
                                <div class="avatar-content">
                                    <i data-feather="package" class="font-medium-5"></i>
                                </div>
                            </div>
                            <h2 class="font-weight-bolder mt-1">{{ number_format($managementTeamCount ?? 0) }}</h2>
                            <p class="card-text">Management Team</p>
                        </div>
                        <div id="order-chart"></div>
                    </div>
                </div>
                <!-- Orders Chart Card ends -->
            </div>

            <div class="row match-height">
                <!-- Avg Sessions Chart Card starts -->
                <div class="col-lg-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row pb-50">
                                <div class="col-sm-6 col-12 d-flex justify-content-between flex-column order-sm-1 order-2 mt-1 mt-sm-0">
                                    <div class="mb-1 mb-sm-0">
                                        <h2 class="font-weight-bolder mb-25">2.7K</h2>
                                        <p class="card-text font-weight-bold mb-2">Totel Plans</p>
                                        <div class="font-medium-2">
                                            <span class="text-success mr-25">+5.2%</span>
                                            <span>vs last 7 days</span>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary">View Details</button>
                                </div>
                                <div class="col-sm-6 col-12 d-flex justify-content-between flex-column text-right order-sm-2 order-1">
                                    <div class="dropdown chart-dropdown">
                                        <button class="btn btn-sm border-0 dropdown-toggle p-50" type="button" id="dropdownItem5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Last 7 Days
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownItem5">
                                            <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                                        </div>
                                    </div>
                                    <div id="avg-sessions-chart"></div>
                                </div>
                            </div>
                            <hr />
                            <div class="row avg-sessions pt-50">
                                <div class="col-6 mb-2">
                                    <p class="mb-50">Goal: $100000</p>
                                    <div class="progress progress-bar-primary" style="height: 6px">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="50" aria-valuemax="100" style="width: 50%"></div>
                                    </div>
                                </div>
                                <div class="col-6 mb-2">
                                    <p class="mb-50">Users: 10K</p>
                                    <div class="progress progress-bar-warning" style="height: 6px">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="60" aria-valuemax="100" style="width: 60%"></div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <p class="mb-50">Retention: 90%</p>
                                    <div class="progress progress-bar-danger" style="height: 6px">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="70" aria-valuemax="100" style="width: 70%"></div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <p class="mb-50">Duration: 1yr</p>
                                    <div class="progress progress-bar-success" style="height: 6px">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="90" aria-valuemax="100" style="width: 90%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Avg Sessions Chart Card ends -->

                <!-- Support Tracker Chart Card starts -->
                <div class="col-lg-6 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between pb-0">
                            <h4 class="card-title">Support Tracker</h4>
                            <div class="dropdown chart-dropdown">
                                <button class="btn btn-sm border-0 dropdown-toggle p-50" type="button" id="dropdownItem4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Last 7 Days
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownItem4">
                                    <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-2 col-12 d-flex flex-column flex-wrap text-center">
                                    <h1 class="font-large-2 font-weight-bolder mt-2 mb-0">{{ $ticketsTotal7d ?? 0 }}</h1>
                                    <p class="card-text">Tickets</p>
                                </div>
                                <div class="col-sm-10 col-12 d-flex justify-content-center">
                                    <div id="support-trackers-chart"></div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-1">
                                <div class="text-center">
                                    <p class="card-text mb-50">New Tickets</p>
                                    <span class="font-large-1 font-weight-bold">{{ $ticketsTotal7d ?? 0 }}</span>
                                </div>
                                <div class="text-center">
                                    <p class="card-text mb-50">Open Tickets</p>
                                    <span class="font-large-1 font-weight-bold">{{ $ticketsOpen7d ?? 0 }}</span>
                                </div>
                                <div class="text-center">
                                    <p class="card-text mb-50">Response Time</p>
                                    <span class="font-large-1 font-weight-bold">{{ $supportResponseTime ?? '1d' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Support Tracker Chart Card ends -->
            </div>

            <div class="row match-height">
                <div class="col-lg-4 col-12">
                    <div class="row match-height">
                        <!-- Bar Chart - Orders -->
                        <div class="col-lg-6 col-md-3 col-6">
                            <div class="card">
                                <div class="card-body pb-50">
                                    <h6>Expenses</h6>
                                    <h2 class="font-weight-bolder mb-1">2,76k</h2>
                                    <div id="statistics-order-chart"></div>
                                </div>
                            </div>
                        </div>
                        <!--/ Bar Chart - Orders -->

                        <!-- Line Chart - Profit -->
                        <div class="col-lg-6 col-md-3 col-6">
                            <div class="card card-tiny-line-stats">
                                <div class="card-body pb-50">
                                    <h6>Profit</h6>
                                    <h2 class="font-weight-bolder mb-1">6,24k</h2>
                                    <div id="statistics-profit-chart"></div>
                                </div>
                            </div>
                        </div>
                        <!--/ Line Chart - Profit -->

                        <!-- Earnings Card -->
                        <div class="col-lg-12 col-md-6 col-12">
                            <div class="card earnings-card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <h4 class="card-title mb-1">Donations (Paid)</h4>
                                            <div class="font-small-2">This Month</div>
                                            <h5 class="mb-1">₹{{ number_format($monthlyDonationInr ?? 0, 2) }}</h5>
                                            <p class="card-text text-muted font-small-2">
                                                <span class="font-weight-bolder">68.2%</span><span> more earnings than last month.</span>
                                            </p>
                                        </div>
                                        <div class="col-6">
                                            <div id="earnings-chart"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Earnings Card -->
                    </div>
                </div>

                <!-- Revenue Report Card -->
                <div class="col-lg-8 col-12">
                    <div class="card card-revenue-budget">
                        <div class="row mx-0">
                            <div class="col-md-8 col-12 revenue-report-wrapper">
                                <div class="d-sm-flex justify-content-between align-items-center mb-3">
                                    <h4 class="card-title mb-50 mb-sm-0">Revenue Report</h4>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex align-items-center mr-2">
                                            <span class="bullet bullet-primary font-small-3 mr-50 cursor-pointer"></span>
                                            <span>Earning</span>
                                        </div>
                                        <div class="d-flex align-items-center ml-75">
                                            <span class="bullet bullet-warning font-small-3 mr-50 cursor-pointer"></span>
                                            <span>Expense</span>
                                        </div>
                                    </div>
                                </div>
                                 <div id="revenue-report-chart"></div>
                                 <script>
                                   (function(){
                                     var el = document.getElementById('revenue-report-chart');
                                     if (!el || typeof ApexCharts === 'undefined') return;
                                     var months = @json($months ?? []);
                                     var earnings = @json($revenueEarnings ?? []);
                                     var expenses = @json($revenueExpenses ?? []);
                                     var options = {
                                       chart: { type: 'bar', height: 260, toolbar: { show: false } },
                                       colors: ['#7367F0', '#FFA83F'],
                                       series: [
                                         { name: 'Earning', data: earnings },
                                         { name: 'Expense', data: expenses }
                                       ],
                                       xaxis: { categories: months },
                                       dataLabels: { enabled: false },
                                       grid: { borderColor: '#f0f0f0' }
                                     };
                                     try { new ApexCharts(el, options).render(); } catch(e) {}
                                   })();
                                 </script>
                            </div>
                            <div class="col-md-4 col-12 budget-wrapper">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle budget-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        2020
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);">2020</a>
                                        <a class="dropdown-item" href="javascript:void(0);">2019</a>
                                        <a class="dropdown-item" href="javascript:void(0);">2018</a>
                                    </div>
                                </div>
                                 <h2 class="mb-25">₹{{ number_format(array_sum($revenueEarnings ?? []), 2) }}</h2>
                                 <div class="d-flex justify-content-center">
                                    <span class="font-weight-bolder mr-25">Year:</span>
                                    <span>{{ $year ?? date('Y') }}</span>
                                 </div>
                                <div id="budget-chart"></div>
                                <button type="button" class="btn btn-primary">Increase Budget</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Revenue Report Card -->
            </div>


        </section>
        <!-- Dashboard Analytics end -->

    </div>
</div>



@endsection
