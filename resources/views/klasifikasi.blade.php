@extends('layouts.master')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Classification</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active">Classification</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        {{-- ALERT MESSAGE --}}
        @if(count($errors) > 0)
        <div class="alert alert-danger" style="padding: 10px 0 0 0;">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
        {{-- END ALERT MESSAGE --}}

        <div class="card">
            <!-- <div class="card-header">
                <center>
                    <h4>Jumlah Dataset</h4>
                </center>
            </div> -->
            <!-- /.card-header -->

            <div class="card-body">
                <!-- Tabel Tweet -->
                <table id="datatable" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr style="text-align: center;">
                            <th scope="col">No</th>
                            <th scope="col">User</th>
                            <th scope="col">Tweet</th>
                            <th scope="col">Date</th>
                            <th scope="col">Category</th>
                            <th scope="col">Manual Label</th>
                            <th scope="col">Predict Label</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_bersih as $bersih)
                        <tr>
                            <th style="text-align:center;">{{ $loop->iteration }}</th>
                            <td style="text-align:center;">{{ $bersih->user }}</td>
                            <td>{{ $bersih->tweet }}</td>
                            <td style="text-align:center; width: 100px;">{{ $bersih->date }}</td>
                            <td>
                                {{ $bersih->category }}
                            </td>
                            @foreach($data_kotor as $kotor)
                            @if($bersih->id_tweet == $kotor->id_tweet)
                            <td style="text-align:center;">
                                <div @switch($kotor->manual_label)
                                    @case("positif")
                                    class="form-control bg-success text-white"
                                    @break
                                    @case("negatif")
                                    class="form-control bg-danger text-white"
                                    @break
                                    @endswitch>
                                    {{$kotor->manual_label}}
                                </div>
                            </td>
                            @endif
                            @endforeach
                            <td style="text-align:center;">
                                <div @switch($bersih->predict_label)
                                    @case("positif")
                                    class="form-control bg-success text-white"
                                    @break
                                    @case("negatif")
                                    class="form-control bg-danger text-white"
                                    @break
                                    @endswitch>
                                    {{$bersih->predict_label}}
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- End Tabel Tweet -->

            </div>
            <!-- /.card-body -->

            <!-- <div class="card-footer">

            </div> -->
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="/AdminLTE/plugins/jquery/jquery.slim.min.js"></script>
<script src="/AdminLTE/plugins/popper/umd/popper.min.js"></script>

<script src="/AdminLTE/plugins/datatables/jquery.dataTables.min.js" defer></script>
<script src="/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js" defer></script>

<script type="text/javascript">
    $(document).ready(function() {
        var t = $('#datatable').DataTable({
            "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": 0,
            }],
            "order": [
                [1, 'asc']
            ]
        });

        t.on('order.dt search.dt', function() {
            t.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
                t.cell(cell).invalidate('dom');
            });
        }).draw();
    });
</script>
@if($x == 'label')
<script>
    Swal.fire({
        icon: 'error',
        title: 'Incomplete Manual Labels',
        html: 'Complete <b>Manual Labels</b> on all dataset that is still blank',
        confirmButtonText: '<a href="{{url('labelling ')}}" style="text-decoration: none; color: white;">Labeling</a>',
    })
</script>
@endif
@if($x == 'dataset')
<script>
    Swal.fire({
        icon: 'error',
        title: 'Incomplete Dataset',
        width: 600,
        html: 'Complete the dataset with <b>Testing</b> and <b>Training</b> data',
        confirmButtonText: '<a href="{{url('trainingkotor ')}}" style="text-decoration: none; color: white;">Add Training Data</a>',
        showCancelButton: true,
        cancelButtonText: '<a href="{{url('testingkotor ')}}" style="text-decoration: none; color: white;">Add Testing Data</a>',
    })
</script>
@endif

@endsection
