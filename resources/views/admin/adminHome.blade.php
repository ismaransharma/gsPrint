@extends('admin.dashboard')
@section('adminTemplate')

<?php
// dd($Orders);
?>

<section id="dashboard">
    <div class="container">
        <div class="top">
            <div id="piechart" style="width: 900px; height: 500px;"></div>

        </div>
    </div>
</section>

<script src="{{ asset('site/js/adminChats/loader.js') }}"></script>

<script type="text/javascript">
    if (typeof google === 'undefined') {
        document.write('<script src="path/to/local/copy/of/loader.js"><\/script>');
    }
</script>


<script type="text/javascript">
    google.charts.load('current', {packages: ['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ["Task", "Count", { role: "style" }],
            <?php echo $arr; ?>
        ]);

        var options = {
            title: "Orders",
            backgroundColor: 'transparent', 
            titleTextStyle: {
                color: 'white' 
            },
            legendTextStyle: {
                color: 'white' 
            },
            pieSliceTextStyle: {
                color: 'white' 
            }
        };

        var chart = new google.visualization.PieChart(document.getElementById("piechart"));
        chart.draw(data, options);
    }
</script>


@endsection