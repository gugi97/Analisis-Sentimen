@extends('layouts.master')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Accuracy</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active">Accuracy</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header" style="background-color: #007BFF; color: #fff;">
                <h3 align="center">Table Confusion Matrix</h3>
            </div>

            <div class="card-body">
                <!-- Table 1 -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" rowspan="2" style="width: 200px; text-align: center; vertical-align: middle;">
                                Actual Values
                            </th>
                            <th scope="col" colspan="4" style="text-align: center;">Predicted Values</th>
                        </tr>
                        <tr>
                            <th scope="col" style="text-align: center;">Predict Positive (A)</th>
                            <th scope="col" style="text-align: center;">Predict Negative (B)</th>
                            <th scope="col" style="text-align: center;">Predict Netral (C)</th>
                            <th scope="col" style="text-align: center;">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="text-align: center;">
                            <th scope="row">Actual Positive (A)</th>
                            <td style="background-color: #007BFF; color: #fff;">{{ $result['TA'] }} (TA)</td>
                            <td>{{ $result['FA1'] }} (FA1)</td>
                            <td>{{ $result['FA2'] }} (FA2)</td>
                            <td>{{ $result['TAA'] }} (TAA)</td>
                        </tr>

                        <tr style="text-align: center;">
                            <th scope="row" style="text-align: center;">Actual Negative (B)</th>
                            <td>{{ $result['FB1'] }} (FB1)</td>
                            <td style="background-color: #007BFF; color: #fff;">{{ $result['TB'] }} (TB)</td>
                            <td>{{ $result['FB2'] }} (FB2)</td>
                            <td>{{ $result['TAB'] }} (TAB)</td>
                        </tr>

                        <tr style="text-align: center;">
                            <th scope="row" style="text-align: center;">Actual Netral (C)</th>
                            <td>{{ $result['FC1'] }} (FC1)</td>
                            <td>{{ $result['FC2'] }} (FC2)</td>
                            <td style="background-color: #007BFF; color: #fff;">{{ $result['TC'] }} (TC)</td>
                            <td>{{ $result['TAC'] }} (TAC)</td>
                        </tr>

                        <tr style="text-align: center;">
                            <th scope="row" style="text-align: center;">TOTAL</th>
                            <td>{{ $result['TPA'] }} (TPA)</td>
                            <td>{{ $result['TPB'] }} (TPB)</td>
                            <td>{{ $result['TPC'] }} (TPC)</td>
                            <td style="background-color: yellow;">{{ $result['TOTAL'] }}</td>
                        </tr>
                    </tbody>
                </table>
                <!-- Table 2 -->
                <br>
                <table class="table table-bordered table-hover">
                    <tbody>
                        <tr style="text-align: center;">
                            <th scope="row" style="width: 200px;">Accuracy</th>
                            <td>(TA+TB+TC) / Total Data</td>
                            <td>= (({{$result['TA']}} + {{$result['TB']}} + {{$result['TC']}}) / {{$result['TOTAL']}}) * 100</td>
                            <td>= {{ $result['accuracy'] }}%</td>
                        </tr>
                        <tr style="text-align: center;">
                            <th scope="row">Precision</th>
                            <td>(Positive Precison + Negative Precison + Netral Precison) / Total Class</td>
                            <td>= (({{$result['precPositif']}} + {{$result['precNegatif']}} + {{$result['precNetral']}}) / 3) * 100</td>
                            <td>= {{ $result['precision'] }}%</td>
                        </tr>
                        <tr style="text-align: center;">
                            <th scope="row">Recall</th>
                            <td>(Positive Recall + Negative Recall + Netral Recall) / Total Class</td>
                            <td>= (({{$result['recPositif']}} + {{$result['recNegatif']}} + {{$result['recNetral']}}) / 3) * 100</td>
                            <td>= {{ $result['recall'] }}%</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- <div class="card-footer">
            </div> -->
        </div>
        <div class="callout callout-success">
            <h6>Accuracy</h6>
            <p>Accuracy is defined as the level of closeness between the predicted value and the actual value (Number of documents classified correctly).</p>
        </div>
        <div class="callout callout-info">
            <h6>Precision</h6>
            <p>Precision is the level of accuracy between the information requested by the user and the answers given by the system.</p>
        </div>
        <div class="callout callout-warning">
            <h6>Recall</h6>
            <p>Recall is the success rate of the system in recovering information.</p>
        </div>
        
    </div>
</section>

@endsection
