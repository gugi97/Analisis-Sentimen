@extends('layouts.master')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Preprocessing</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active">Preprocessing</li>
                </ol>
            </div>
        </div>
        <form role="Insertform" action="{{ action('PreprocessingController@store') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
            <!-- Button Preprocessing -->
            <button type="submit" class="btn btn-primary d-block mr- ml-auto">
                <i class="fas fa-play-circle"></i> Start Preprocessing
            </button>
            <!-- End Button Preprocessing -->
        </form>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <!-- notifikasi sukses -->
        @if ( session('success'))
            <div class="alert alert-success" >
                <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{{ session('success') }}</strong>
            </div>
        @endif
    <!-- end notifikasi -->

    <!-- Default box -->
    <div class="card card-primary card-tabs">
        <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Case Folding</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Cleansing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Normalization</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-settings" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">Stopword Removal & Stemming</a>
                </li>
            </ul>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
            <div class="tab-content" id="custom-tabs-one-tabContent">
                <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                    <!-- Tabel Tweet -->
                    <table id="datatable" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr style="text-align: center;">
                                <th scope="col">No</th>
                                <th scope="col">Tweet Before</th>
                                <th scope="col">Tweet After</th>
                                <th scope="col">Category</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($filtering as $casefolding)
                            <tr>
                                <th style="text-align:center;">{{ $loop->iteration }}</th>
                                <td>{{ $casefolding['tweet_before'] }}</td>

                                <td>{{ $casefolding['tweet_lower'] }}</td>

                                <td>{{ $casefolding['category'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- End Tabel Tweet -->
                </div>
                <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                    <!-- Tabel Tweet -->
                    <table id="datatable2" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr style="text-align: center;">
                                <th scope="col">No</th>
                                <th scope="col">Tweet Before</th>
                                <th scope="col">Tweet After</th>
                                <th scope="col">Category</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($filtering as $cleansing)
                            <tr>
                                <th style="text-align:center;">{{ $loop->iteration }}</th>
                                <td>{{ $cleansing['tweet_before'] }}</td>

                                <td>{{ $cleansing['tweet_cleansing'] }}</td>

                                <td>{{ $cleansing['category'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- End Tabel Tweet -->
                </div>
                <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages">
                    <!-- Tabel Tweet -->
                    <table id="datatable3" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr style="text-align: center;">
                                <th scope="col">No</th>
                                <th scope="col">Tweet Before</th>
                                <th scope="col">Tweet After</th>
                                <th scope="col">Category</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($filtering as $normalization)
                            <tr>
                                <th style="text-align:center;">{{ $loop->iteration }}</th>
                                <td>{{ $normalization['tweet_before'] }}</td>

                                <td>{{ $normalization['tweet_normalization'] }}</td>

                                <td>{{ $normalization['category'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- End Tabel Tweet -->
                </div>
                <div class="tab-pane fade" id="custom-tabs-one-settings" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
                    <!-- Tabel Tweet -->
                    <table id="datatable4" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr style="text-align: center;">
                                <th scope="col">No</th>
                                <th scope="col">Tweet Before</th>
                                <th scope="col">Tweet After</th>
                                <th scope="col">Category</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stemming as $stem)
                            <tr>
                                <th style="text-align:center;">{{ $loop->iteration }}</th>
                                <td>{{ $stem['tweet_before'] }}</td>

                                <td>{{ $stem['tweet_stemming'] }}</td>

                                <td>{{ $stem['category'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- End Tabel Tweet -->
                </div>
            </div>

        </div>
        <!-- /.card-body -->

        <!-- <div class="card-footer">

        </div> -->
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->

</section>

<script src="/AdminLTE/plugins/jquery/jquery.slim.min.js"></script>
<script src="/AdminLTE/plugins/popper/umd/popper.min.js"></script>

<script src="/AdminLTE/plugins/datatables/jquery.dataTables.min.js" defer></script>
<script src="/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js" defer></script>

<script type="text/javascript">
    $(document).ready(function() {
        var table1 = $('#datatable').DataTable({
            "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": 0
            }],
            "order": [
                [1, 'asc']
            ]
        });

        var table2 = $('#datatable2').DataTable({
            "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": 0
            }],
            "order": [
                [1, 'asc']
            ]
        });

        var table3 = $('#datatable3').DataTable({
            "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": 0
            }],
            "order": [
                [1, 'asc']
            ]
        });

        var table4 = $('#datatable4').DataTable({
            "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": 0
            }],
            "order": [
                [1, 'asc']
            ]
        });

        table1.on('order.dt search.dt', function() {
            table1.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
                table1.cell(cell).invalidate('dom');
            });
        }).draw();

        table2.on('order.dt search.dt', function() {
            table2.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
                table2.cell(cell).invalidate('dom');
            });
        }).draw();

        table3.on('order.dt search.dt', function() {
            table3.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
                table3.cell(cell).invalidate('dom');
            });
        }).draw();

        table4.on('order.dt search.dt', function() {
            table4.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
                table4.cell(cell).invalidate('dom');
            });
        }).draw();
    });
</script>

@endsection
