@extends('layouts.master')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Visualization</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active">Visualization</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- INFO BOX -->
        <div class="row">
            <div class="col-md-2 col-sm-6 col-12" style="padding: 0px 10px;">
                <div class="info-box">
                    <span class="info-box-icon" style="background-color: #ffffff;">
                        <img src="AdminLTE/dist/img/indihome.png" alt="Logo Indihome" class="brand-image">
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text" style="color: #DC3545; font-weight: 700; font-size: 13px;">
                            Tweet (Positive)
                        </span>
                        <span class="info-box-number" style="font-size: 20px; font-family: cursive;">
                            {{$label_indihome['label_positif']}}
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-sm-6 col-12" style="padding: 0px 10px;">
                <div class="info-box">
                    <span class="info-box-icon" style="background-color: #ffffff;">
                        <img src="AdminLTE/dist/img/indihome.png" alt="Logo Indihome" class="brand-image">
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text" style="color: #DC3545; font-weight: 700; font-size: 13px;">
                            Tweet (Netral)
                        </span>
                        <span class="info-box-number" style="font-size: 20px; font-family: cursive;">
                            {{$label_indihome['label_netral']}}
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-sm-6 col-12" style="padding: 0px 10px;">
                <div class="info-box">
                    <span class="info-box-icon" style="background-color: #ffffff;">
                        <img src="AdminLTE/dist/img/indihome.png" alt="Logo Indihome" class="brand-image">
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text" style="color: #DC3545; font-weight: 700; font-size: 13px;">
                            Tweet (Negative)
                        </span>
                        <span class="info-box-number" style="font-size: 20px; font-family: cursive;">
                            {{$label_indihome['label_negatif']}}
                        </span>
                    </div>
                </div>
            </div>
            <!-- firstmedia -->
            <div class="col-md-2 col-sm-6 col-12" style="padding: 0px 10px;">
                <div class="info-box">
                    <span class="info-box-icon" style="background-color: #ffffff;">
                        <img src="AdminLTE/dist/img/firstmedia.png" alt="Logo Firstmedia" class="brand-image">
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text" style="color: #3B60AD; font-weight: 700; font-size: 13px;">
                            Tweet (Positive)
                        </span>
                        <span class="info-box-number" style="font-size: 20px; font-family: cursive;">
                            {{$label_firstmedia['label_positif']}}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-sm-6 col-12" style="padding: 0px 10px;">
                <div class="info-box">
                    <span class="info-box-icon" style="background-color: #ffffff;">
                        <img src="AdminLTE/dist/img/firstmedia.png" alt="Logo Firstmedia" class="brand-image">
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text" style="color: #3B60AD; font-weight: 700; font-size: 13px;">
                            Tweet (Netral)
                        </span>
                        <span class="info-box-number" style="font-size: 20px; font-family: cursive;">
                            {{$label_firstmedia['label_netral']}}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-sm-6 col-12" style="padding: 0px 10px;">
                <div class="info-box">
                    <span class="info-box-icon" style="background-color: #ffffff;">
                        <img src="AdminLTE/dist/img/firstmedia.png" alt="Logo Firstmedia" class="brand-image">
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text" style="color: #3B60AD; font-weight: 700; font-size: 13px;">
                            Tweet (Negative)
                        </span>
                        <span class="info-box-number" style="font-size: 20px; font-family: cursive;">
                            {{$label_firstmedia['label_negatif']}}</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- END INFO BOX -->

        <div class="row">
            <div class="col-md-12">
                <!-- PIE CHART -->
                <div class="card">
                    <div class="card-header" style="background-color: #007BFF; color: #fff;">
                        <h3 class="card-title">Classification Result</h3>

                        <div class="card-tools">
                            <button style="color: #fff;" type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <!-- BAR CHART -->
                <div class="card">
                    <div class="card-header" style="background-color: #007BFF; color: #fff;">
                        <h3 class="card-title">Frequency Token Indihome</h3>

                        <div class="card-tools">
                            <button style="color: #fff;" type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="barChart1" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <!-- BAR CHART -->
                <div class="card">
                    <div class="card-header" style="background-color: #007BFF; color: #fff;">
                        <h3 class="card-title">Frequency Token FirstMedia</h3>

                        <div class="card-tools">
                            <button style="color: #fff;" type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="barChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection

<!-- ChartJS -->
<script src="AdminLTE/plugins/chart.js/Chart.min.js"></script>
<!-- jQuery -->
<script src="AdminLTE/plugins/jquery/jquery.min.js"></script>


<script>
    var indihome = <?php echo json_encode($label_indihome); ?>;
    var firstmedia = <?php echo json_encode($label_firstmedia); ?>;
    var hasil_indihome = <?php echo json_encode($hasil_indihome); ?>;
    var hasil_firstmedia = <?php echo json_encode($hasil_firstmedia); ?>;

    $(function() {
        //-------------
        //- DONUT CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var donutChartCanvas = $('#donutChart').get(0).getContext('2d')


        var donutData = {
            labels: [
                'Indihome Positive',
                'Indihome Negative',
                'Indihome Netral',
                'FirstMedia Positive',
                'FirstMedia Negative',
                'FirstMedia Netral',
            ],
            datasets: [{
                data: [
                    indihome.label_positif,
                    indihome.label_negatif,
                    indihome.label_netral,
                    firstmedia.label_positif,
                    firstmedia.label_negatif,
                    firstmedia.label_netral,
                ],
                backgroundColor: ['#FD6D48', '#F3D04E', '#ADC965', '#89D5C9','#0098D7', '#4B5EA6'],
            }]
        }
        var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
            title: {
                display: true,
                text: 'Twitter Sentiment Classification Results With Naive Bayes'
            }
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        var donutChart = new Chart(donutChartCanvas, {
            type: 'pie',
            data: donutData,
            options: donutOptions
        })

        //-------------
        //- BAR CHART 1-
        //-------------
        var barChartCanvas = $('#barChart1').get(0).getContext('2d')
        var data = {
            labels: Object.keys(hasil_indihome),
            datasets: [{
                label: "Frequency ",
                backgroundColor: [
                    'rgb(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1,
                data: Object.values(hasil_indihome)
            }]
        }
        var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false,
            legend: {
                display: false
            },
            title: {
                display: true,
                text: 'Words that often appear in Indihome Tweets'
            }
        }

        var barChart = new Chart(barChartCanvas, {
            type: 'horizontalBar',
            data: data,
            options: barChartOptions
        })

        //-------------
        //- BAR CHART 2 -
        //-------------
        var barChartCanvas = $('#barChart2').get(0).getContext('2d')
        var data = {
            labels: Object.keys(hasil_firstmedia),
            datasets: [{
                label: "Frequency ",
                backgroundColor: [
                    'rgb(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1,
                data: Object.values(hasil_firstmedia)
            }]
        }
        var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false,
            legend: {
                display: false
            },
            title: {
                display: true,
                text: 'Words that often appear in FirstMedia Tweets'
            }
        }

        var barChart = new Chart(barChartCanvas, {
            type: 'horizontalBar',
            data: data,
            options: barChartOptions
        })
    })
</script>
