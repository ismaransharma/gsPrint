@extends('admin.dashboard')
@section('adminTemplate')

<?php
// dd($Orders);
?>


<div class="container-fluid mt-5">
    <!-- Chart and  Cards-->
    <div class="upperMain">
        <div class="row jc-center">
            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 flex ta-center jc-center">
                <div id="chart-container" style="width: 900px; height: 500px;"></div>
            </div>
            <div class="col-lg-4 col-md-4 right-left jc-center d-grid">
                <!-- <div class="col-md-12 col-sm-12 my-xs-2 my-sm-3">
                    <div class="card w-80p bg-left white border border-dark">
                        <div class="card-header center border-dark">
                            <h2>Welcome Admin!</h2>
                        </div>
                        <div class="card-body h-auto center">
                            <h2>Mr. Smaran Sharma<h2>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-md-12 col-sm-12 my-xs-2 my-sm-3">
                        <div class="card w-80p bg-left white border border-dark">
                            <div class="card-header border-dark center">
                                <h2>Total Orders</h2>
                            </div>
                            <div class="card-body center">
                                <h4>{{ $ttOrders }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 my-xs-2 my-sm-3">
                        <div class="card w-80p bg-left white border border-dark">
                            <div class="card-header border-dark center">
                                <h2>Completed Orders</h2>
                            </div>
                            <div class="card-body center">
                                <h4>{{ $completed_order }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 my-xs-2 my-sm-3">
                <div class="card w-80p bg-left white border border-dark">
                    <div class="card-header border-dark center">
                        <h2>Pending Orders</h2>
                    </div>
                    <div class="card-body center">
                        <h4>{{ $pOrders }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 my-xs-2 my-sm-3">
                <div class="card w-80p bg-left white border border-dark">
                    <div class="card-header border-dark center">
                        <h2>Total Revenue</h2>
                    </div>
                    <div class="card-body center">
                        <h4>Rs. {{ $toas }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 my-xs-2 my-sm-3">
                <div class="card w-80p bg-left white border border-dark">
                    <div class="card-header border-dark center">
                        <h2>Total Revenue (Last Month)</h2>
                    </div>
                    <div class="card-body center">
                        <h4>Rs. {{ $lastMonthRevenue }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 my-xs-2 my-sm-3">
                <div class="card w-80p bg-left white border border-dark">
                    <div class="card-header border-dark center">
                        <h2>Total Revenue (This Month)</h2>
                    </div>
                    <div class="card-body center">
                        <h4>Rs. {{ $currentMonthRevenue }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Product Sold And Recent Orders (Sales) -->
    <div class="sales my-5">
        <div class="row">
            <div class="col-lg-5 col-md-5">
                <div class="card bg-main-left">
                    <div class="card-header white">
                        <h3>TOP PRODUCTS BY UNITS SOLD</h3>
                    </div>
                    <div class="card-body">
                        <div class="row mt-4">
                            <div class="col-lg-9 col-md-9 col-sm-10 col-9 white d-flex align-items-center">
                                <span class="me-3">
                                    <img src="imgs/iphone.webp" class="img-fluid h-auto w-25 rounded">
                                </span>
                                <span class="fs-3 bold text-uppercase">Iphone XS Pro</span>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-2 col-3 white text-end d-flex flex-column align-items-end justify-content-center">
                                <h4>195</h4>
                                <h4>sold</h4>
                            </div>
                        </div>
                        
                    </div>
                </div>

                
            </div>
            <div class="col-lg-7 col-md-7 mq-xs-m-2">
                <div class="card bg-main-left">
                    <div class="card-header white">
                        <h2>Recent Orders</h2>
                    </div>
                    <div class="card-body table-responsive white p-0 m-0">
                        {{-- <table class="table table-bg-left white">
                            <thead >
                                <tr class="fs-3">
                                    <th scope="col">Code</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Total</th>
                                    <th scope="col px-4">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="fs-5 border-bottom ">
                                    <th scope="row" >45e895</th>
                                    <td>ismaran sharma</td>
                                    <td>admin1234@gmail.com</td>
                                    <td>2024-05-19</td>
                                    <td>$125</td>
                                    <td >
                                    <span class="px-4 fs-5 border-yellow rounded" >Pending</span></td>
                                </tr>
                                <tr class="fs-5 border-bottom ">
                                    <td>45e895</td>
                                    <td>ismaran sharma</td>
                                    <td>admin1234@gmail.com</td>
                                    <td>2024-05-19</td>
                                    <td>$125</td>
                                    <td >
                                    <span class="px-4 fs-5 border-success rounded" >Delivered</span></td>
                                </tr>
                                <tr class="fs-5 border-bottom ">
                                    <td>45e895</td>
                                    <td>ismaran sharma</td>
                                    <td>admin1234@gmail.com</td>
                                    <td>2024-05-19</td>
                                    <td>$125</td>
                                    <td >
                                    <span class="px-4 fs-5 border-danger rounded" >Cancelled</span></td>
                                </tr>
                                <tr class="fs-5 border-bottom ">
                                    <td>45e895</td>
                                    <td>ismaran sharma</td>
                                    <td>admin1234@gmail.com</td>
                                    <td>2024-05-19</td>
                                    <td>$125</td>
                                    <td >
                                    <span class="px-4 fs-5 border-yellow rounded" >Pending</span></td>
                                </tr>
                                <tr class="fs-5 border-bottom ">
                                    <td>45e895</td>
                                    <td>ismaran sharma</td>
                                    <td>admin1234@gmail.com</td>
                                    <td>2024-05-19</td>
                                    <td>$125</td>
                                    <td >
                                    <span class="px-4 fs-5 border-yellow rounded" >Pending</span></td>
                                </tr>
                                <tr class="fs-5 border-bottom ">
                                    <td>45e895</td>
                                    <td>ismaran sharma</td>
                                    <td>admin1234@gmail.com</td>
                                    <td>2024-05-19</td>
                                    <td>$125</td>
                                    <td >
                                    <span class="px-4 fs-5 border-success rounded" >Delivered</span></td>
                                </tr>
                                <tr class="fs-5 border-bottom ">
                                    <td>45e895</td>
                                    <td>ismaran sharma</td>
                                    <td>admin1234@gmail.com</td>
                                    <td>2024-05-19</td>
                                    <td>$125</td>
                                    <td >
                                    <span class="px-4 fs-5 border-yellow rounded" >Pending</span></td>
                                </tr>
                                <tr class="fs-5 border-bottom ">
                                    <td>45e895</td>
                                    <td>ismaran sharma</td>
                                    <td>admin1234@gmail.com</td>
                                    <td>2024-05-19</td>
                                    <td>$125</td>
                                    <td >
                                    <span class="px-4 fs-5 border-yellow rounded" >Pending</span></td>
                                </tr>
                                <tr class="fs-5 border-bottom ">
                                    <td>45e895</td>
                                    <td>ismaran sharma</td>
                                    <td>admin1234@gmail.com</td>
                                    <td>2024-05-19</td>
                                    <td>$125</td>
                                    <td >
                                    <span class="px-4 fs-5 border-yellow rounded" >Pending</span></td>
                                </tr>
                                <tr class="fs-5 border-bottom ">
                                    <td>45e895</td>
                                    <td>ismaran sharma</td>
                                    <td>admin1234@gmail.com</td>
                                    <td>2024-05-19</td>
                                    <td>$125</td>
                                    <td >
                                    <span class="px-4 fs-5 border-yellow rounded" >Pending</span></td>
                                </tr>
                                <tr class="fs-5 border-bottom ">
                                    <td>45e895</td>
                                    <td>ismaran sharma</td>
                                    <td>admin1234@gmail.com</td>
                                    <td>2024-05-19</td>
                                    <td>$125</td>
                                    <td >
                                    <span class="px-4 fs-5 border-yellow rounded" >Pending</span></td>
                                </tr>
                                <tr class="fs-5 border-bottom ">
                                    <td>45e895</td>
                                    <td>ismaran sharma</td>
                                    <td>admin1234@gmail.com</td>
                                    <td>2024-05-19</td>
                                    <td>$125</td>
                                    <td >
                                    <span class="px-4 fs-5 border-yellow rounded" >Pending</span></td>
                                </tr>
                                <tr class="fs-5 border-bottom ">
                                    <td>45e895</td>
                                    <td>ismaran sharma</td>
                                    <td>admin1234@gmail.com</td>
                                    <td>2024-05-19</td>
                                    <td>$125</td>
                                    <td >
                                    <span class="px-4 fs-5 border-yellow rounded" >Pending</span></td>
                                </tr>
                                <tr class="fs-5 border-bottom ">
                                    <td>45e895</td>
                                    <td>ismaran sharma</td>
                                    <td>admin1234@gmail.com</td>
                                    <td>2024-05-19</td>
                                    <td>$125</td>
                                    <td >
                                    <span class="px-4 fs-5 border-danger rounded" >Cancelled</span></td>
                                </tr>
                                
                            </tbody>
                        </table> --}}

                        <table class="table table-bg-left white">
                            <thead >
                                <tr class="fs-3">
                                    <th scope="col">Code</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Total</th>
                                    <th scope="col px-4">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentOrders as $recentOrder)
                                <tr class="fs-5 border-bottom ">
                                    <th scope="row" >{{ $recentOrder->cart_code }}</th>
                                    <td>{{ $recentOrder->user_name }}</td>
                                    <td>{{ $recentOrder->email }}</td>
                                    <td>{{ $recentOrder->created_at }}</td>
                                    <td>Rs. {{ $recentOrder->total }}</td>
                                    <td >
                                    <span class="px-4 fs-5 border-yellow rounded" >Pending</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Buyer -->
    <div class="top-customer my-5">
        
    </div>
</div>   




<script
      type="text/javascript"
      src="https://www.gstatic.com/charts/loader.js"
    ></script>
    
    
    <script type="text/javascript">
        // Fetch PHP data from Blade
        var orderStatusData = @json($orderStatusData);

        google.charts.load('current', { packages: ['corechart'] });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            // Convert PHP data to JavaScript array format
            var data = google.visualization.arrayToDataTable(orderStatusData);

            var options = {
                title: 'Orders History',
                backgroundColor: '#1d267d',
                legendTextStyle: { color: 'white', fontSize: 14 },
                titleTextStyle: { color: 'white', fontSize: 18 },
                pieSliceTextStyle: { color: 'white', fontSize: 14 },
                // pieHole: 0.4
            };

            var chart = new google.visualization.PieChart(document.getElementById('chart-container'));

            chart.draw(data, options);
        }

        // Redraw chart on window resize
        window.addEventListener('resize', drawChart);
    </script>


@endsection