@extends('layouts.master')
<!-- Header END -->

<!-- PAGE CONTENT BEGIN -->
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Labelling</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active">Labelling</li>
                </ol>
            </div>
        </div>
        <form role="Insertform" action="{{ action('LabelingController@store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <!-- Button Preprocessing -->
            <button type="submit" class="btn btn-primary d-block mr- ml-auto">
                <i class="fas fa-play-circle"></i> Auto Labeling
            </button>
            <!-- End Button Preprocessing -->
        </form>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        {{-- ALERT MESSAGE --}}
        @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
        {{-- END ALERT MESSAGE --}}

        <div class="card card-primary card-tabs">
            <!-- Card Header -->
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-one-training-tab" data-toggle="pill" href="#custom-tabs-one-training" role="tab" aria-controls="custom-tabs-one-training" aria-selected="true">Dataset Training</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-testing-tab" data-toggle="pill" href="#custom-tabs-one-testing" role="tab" aria-controls="custom-tabs-one-testing" aria-selected="false">Dataset Testing</a>
                    </li>
                </ul>
            </div>
            <!-- End Card Header -->

            <!-- form start -->
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-one-training" role="tabpanel" aria-labelledby="custom-tabs-one-training-tab">
                        <table id="datatable1" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr style="text-align: center;">
                                    <th scope="col">No</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Tweet</th>
                                    <th scope="col">Data Type</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Label</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($training as $train)
                                <tr style="text-align: center;">
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $train->user }}</td>
                                    <td style="text-align:justify;">{{ $train->tweet }}</td>
                                    <td>{{ $train->datatype}}</td>
                                    <td>{{ $train->category }}</td>
                                    <td style="text-align:center; width: 100px;">
                                        <form action="{{URL::to('/labelling/'.$train->id_tweet)}}" method="post">
                                            {{ csrf_field() }}
                                            @method('PUT')
                                            <input type="hidden" name="id" value="{{$train->id_tweet}}">
                                            <div class="form-group">
                                                <select @switch($train->manual_label)
                                                    @case("positif")
                                                    class="form-control bg-success text-white"
                                                    @break
                                                    @case("negatif")
                                                    class="form-control bg-danger text-white"
                                                    @break
                                                    @default
                                                    class="form-control"
                                                    @endswitch
                                                    name="label" onchange="submit()">
                                                    <option value="" @if (!$train->manual_label)
                                                        selected
                                                        @endif>----</option>
                                                    <option value="positif" @if ($train->manual_label == "positif")
                                                        selected
                                                        @endif
                                                        ><strong>Positif</strong></option>
                                                    <option value="negatif" @if ($train->manual_label == "negatif")
                                                        selected
                                                        @endif
                                                        ><strong>Negatif</strong></option>
                                                </select>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-testing" role="tabpanel" aria-labelledby="custom-tabs-one-testing-tab">
                        <table id="datatable2" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr style="text-align: center;">
                                    <th scope="col">No</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Tweet</th>
                                    <th scope="col">Data Type</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Label</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($testing as $test)
                                <tr style="text-align: center;">
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $test->user }}</td>
                                    <td style="text-align:justify;">{{ $test->tweet }}</td>
                                    <td>{{ $test->datatype}}</td>
                                    <td>{{ $test->category }}</td>
                                    <td style="text-align:center; width: 100px;">
                                        <form action="{{URL::to('/labelling/'.$test->id_tweet)}}" method="post">
                                            {{ csrf_field() }}
                                            @method('PUT')
                                            <input type="hidden" name="id" value="{{$test->id_tweet}}">
                                            <div class="form-group">
                                                <select @switch($test->manual_label)
                                                    @case("positif")
                                                    class="form-control bg-success text-white"
                                                    @break
                                                    @case("negatif")
                                                    class="form-control bg-danger text-white"
                                                    @break
                                                    @default
                                                    class="form-control"
                                                    @endswitch
                                                    name="label" onchange="submit()">
                                                    <option value="" @if (!$test->manual_label)
                                                        selected
                                                        @endif>----</option>
                                                    <option value="positif" @if ($test->manual_label == "positif")
                                                        selected
                                                        @endif
                                                        ><strong>Positif</strong></option>
                                                    <option value="negatif" @if ($test->manual_label == "negatif")
                                                        selected
                                                        @endif
                                                        ><strong>Negatif</strong></option>
                                                </select>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>


                <!-- Footer -->
                <!-- <div class="card-footer">

                </div> -->
                <!-- End Footer -->
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

<script src="/adminlte/plugins/jquery/jquery.slim.min.js"></script>
<script src="/adminlte/plugins/popper/umd/popper.min.js"></script>

<script src="/adminlte/plugins/datatables/jquery.dataTables.min.js" defer></script>
<script src="/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js" defer></script>

<script type="text/javascript">
    $(document).ready(function() {

        var table1 = $('#datatable1').DataTable({
            "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": [0, 3],
            }],
            "order": [
                [1, 'asc']
            ]
        });

        var table2 = $('#datatable2').DataTable({
            "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": [0, 3],
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

        // var table = $('#datatable').DataTable();
    });
</script>
@endsection
