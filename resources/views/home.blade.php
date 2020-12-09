@extends('layouts.master')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header" style="background-color: unset;">
            <center>
                <h4>Jumlah Dataset</h4>
            </center>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
            <!-- INFO BOX -->
            <div class="row">
                <div class="col-md-6 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon" style="background-color: #ffffff;">
                            <img src="AdminLTE/dist/img/indihome.png" alt="Logo Indihome" class="brand-image">
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text" style="color: #DC3545; font-weight: 700; font-size: 13px;">
                                Data Indihome
                            </span>
                            <span class="info-box-number" style="font-size: 20px; font-family: cursive;">{{$indihome}}
                                Tweet</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon" style="background-color: #ffffff;">
                            <img src="AdminLTE/dist/img/firstmedia.png" alt="Logo Firstmedia" class="brand-image">
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text" style="color: #3B60AD; font-weight: 700; font-size: 13px;">
                                Data Firstmedia
                            </span>
                            <span class="info-box-number" style="font-size: 20px; font-family: cursive;">{{$firstmedia}}
                                Tweet</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END INFO BOX -->

            <!-- CARD BOX -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$training}}</h3>
                            <p>Data Training</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-database"></i>
                        </div>
                        <a href="trainingkotor" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$testing}}</h3>
                            <p>Data Test</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-database"></i>
                        </div>
                        <a href="testingkotor" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

            </div>
            <!-- END CARD BOX -->

        </div>
        <!-- /.card-body -->

        <!-- <div class="card-footer">

        </div> -->
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->

</section>

@endsection
