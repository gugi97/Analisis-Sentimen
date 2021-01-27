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
                            <th scope="col" colspan="2" style="text-align: center;">Predicted Values</th>
                        </tr>
                        <tr>
                            <th scope="col" style="text-align: center;">Predict Positive</th>
                            <th scope="col" style="text-align: center;">Predict Negative</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="text-align: center;">
                            <th scope="row">Actual Positive</th>
                            <td>{{ $result['tp'] }} (TP)</td>
                            <td>{{ $result['fn'] }} (FN)</td>
                        </tr>

                        <tr style="text-align: center;">
                            <th scope="row" style="text-align: center;">Actual Negative</th>
                            <td>{{ $result['fp'] }} (FP)</td>
                            <td>{{ $result['tn'] }} (TN)</td>
                        </tr>
                    </tbody>
                </table>
                <!-- Table 2 -->
                <br>
                <table class="table table-bordered table-hover">
                    <tbody>
                        <tr style="text-align: center;">
                            <th scope="row" style="width: 200px;">Accuracy</th>
                            <td style="width: 300px;">(TP+TN)/(TP+FP+TN+FN)</td>
                            <td style="width: 300px;">=
                                ({{$result['tp']}} + {{$result['tn']}}) /
                                ({{$result['tp']}} + {{$result['fp']}} + {{$result['tn']}} + {{$result['fn']}})
                            </td>
                            <td>= {{ $result['accuracy'] }}%</td>
                        </tr>
                        <tr style="text-align: center;">
                            <th scope="row">Precision</th>
                            <td>TP/(TP+FP)</td>
                            <td>= {{$result['tp']}} / ({{$result['tp']}} + {{$result['fp']}})</td>
                            <td>= {{ $result['precision'] }}%</td>
                        </tr>
                        <tr style="text-align: center;">
                            <th scope="row">Recall</th>
                            <td>TP/(TP+FN)</td>
                            <td>= {{$result['tp']}} / ({{$result['tp']}} + {{$result['fn']}})</td>
                            <td>= {{ $result['recall'] }}%</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- <div class="card-footer">
            </div> -->
        </div>
    </div>
</section>

@endsection
