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
    <div class="callout callout-info">
        <h5>Sentiment Analysis</h5>
        <p>This application is used to classify data on complaints or opinions of Twitter users regarding Indihome and First Media services to find out the quality of their services.</p>
    </div>

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
        <div class="row">
            <div class="col-md-6 col-sm-6 col-12">
                <a href="trainingkotor" id="hoverlink" style="text-decoration: none; color: inherit;">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-database"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Data Training</span>
                            <span class="info-box-number" style="font-size: 20px; font-family: cursive;">{{$training}}</span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-sm-6 col-12">
                <a href="testingkotor" style="text-decoration: none; color: inherit;">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="fas fa-database"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Data Testing</span>
                            <span class="info-box-number" style="font-size: 20px; font-family: cursive;">{{$testing}}</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <!-- END INFO BOX -->

</section>

@endsection
