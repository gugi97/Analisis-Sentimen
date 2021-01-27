@extends('layouts.master')
<!-- Header END -->

<!-- PAGE CONTENT BEGIN -->
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dictionary</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active">Dictionary</li>
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
                        <a class="nav-link active" id="custom-tabs-one-training-tab" data-toggle="pill" href="#custom-tabs-one-training" role="tab" aria-controls="custom-tabs-one-training" aria-selected="true">Positive Words</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-testing-tab" data-toggle="pill" href="#custom-tabs-one-testing" role="tab" aria-controls="custom-tabs-one-testing" aria-selected="false">Negative Words</a>
                    </li>
                </ul>
            </div>
            <!-- End Card Header -->

            <!-- form start -->
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">

                    <!-- Tab Positive Word -->
                    <div class="tab-pane fade show active" id="custom-tabs-one-training" role="tabpanel" aria-labelledby="custom-tabs-one-training-tab">
                        <!-- Button trigger Add modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#positifModal">
                            <i class="fas fa-plus-circle"></i> Add Data
                        </button>
                        <!-- End Trigger Button -->

                        <br><br>
                        <table id="datatable1" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr style="text-align: center;">
                                    <th scope="col">No</th>
                                    <th scope="col">Word</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($positif as $pos)
                                <tr style="text-align: center;">
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $pos->word }}</td>
                                    <td>
                                        <a href="#" data-toggle="modal" class="btn btn-success edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" data-toggle="modal" class="btn btn-danger delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <!-- Start Add Modal -->
                        <div class="modal fade" id="positifModal" tabindex="-1" role="dialog" aria-labelledby="positifModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="positifModalLabel">Add Positive Word List</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form role="Insertform" action="{{ action('KamusController@store') }}" method="post" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label>Positive Word</label>
                                                <input type="text" class="form-control" placeholder="word with positive sentiment"
                                                    name="positif" value="{{ old('positif') }}">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                <i class="fas fa-undo"></i> Cancel
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="far fa-save"></i> Save
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End Add Modal -->

                        <!-- Start Edit Modal -->
                        <div class="modal fade" id="editModalPositif" tabindex="-1" role="dialog" aria-labelledby="positifModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="positifModalLabel">Edit Positive Word Data</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form role="Insertform" action="/kamus" method="post" id="editFormPositif"
                                        enctype="multipart/form-data">
                                        <div class="modal-body">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}

                                            <div class="form-group">
                                                <label>Positive Word</label>
                                                <input type="text" class="form-control" placeholder="word with positive sentiment"
                                                    name="positif" id="positif" value="{{ old('positif') }}">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                <i class="fas fa-undo"></i> Cancel
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="far fa-save"></i> Save
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End Edit Modal -->

                        <!-- Start Delete Modal -->
                        <div class="modal fade" id="deleteModalPositif" tabindex="-1" role="dialog" aria-labelledby="positifModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="positifModalLabel">Delete Positive Word Data</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form role="Insertform" action="/kamus" method="post" id="deleteFormPositif" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <input type="hidden" name="_method" value="DELETE">
                                            <p>This data will be deleted, are you sure?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End Delete Modal -->
                    </div>
                    <!-- End Tab Positive Word -->

                    <!-- Tab Negative Word -->
                    <div class="tab-pane fade" id="custom-tabs-one-testing" role="tabpanel" aria-labelledby="custom-tabs-one-testing-tab">
                        <!-- Button trigger Add modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#negatifModal">
                            <i class="fas fa-plus-circle"></i> Add Data
                        </button>
                        <!-- End Trigger Button -->

                        <br><br>

                        <table id="datatable2" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr style="text-align: center;">
                                    <th scope="col">No</th>
                                    <th scope="col">Word</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($negatif as $neg)
                                <tr style="text-align: center;">
                                    <th style="width: 132px;">{{ $loop->iteration }}</th>
                                    <td>{{ $neg->word }}</td>
                                    <td style="width: 256px;">
                                        <a href="#" data-toggle="modal" class="btn btn-success edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" data-toggle="modal" class="btn btn-danger delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <!-- Start Add Modal -->
                        <div class="modal fade" id="negatifModal" tabindex="-1" role="dialog" aria-labelledby="negatifModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="negatifModalLabel">Add Negative Word List</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form role="Insertform" action="{{ action('KamusController@store') }}" method="post" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label>Negative Word</label>
                                                <input type="text" class="form-control" placeholder="word with negative sentiment"
                                                    name="negatif" value="{{ old('negatif') }}">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                <i class="fas fa-undo"></i> Cancel
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="far fa-save"></i> Save
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End Add Modal -->

                        <!-- Start Edit Modal -->
                        <div class="modal fade" id="editModalNegatif" tabindex="-1" role="dialog" aria-labelledby="negatifModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="negatifModalLabel">Edit Negative Word Data</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form role="Insertform" action="/kamus" method="post" id="editFormNegatif"
                                        enctype="multipart/form-data">
                                        <div class="modal-body">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}

                                            <div class="form-group">
                                                <label>Negative Word</label>
                                                <input type="text" class="form-control" placeholder="word with negative sentiment"
                                                    name="negatif" id="negatif" value="{{ old('negatif') }}">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                <i class="fas fa-undo"></i> Cancel
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="far fa-save"></i> Save
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End Edit Modal -->

                        <!-- Start Delete Modal -->
                        <div class="modal fade" id="deleteModalNegatif" tabindex="-1" role="dialog" aria-labelledby="negatifModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="negatifModalLabel">Delete Negative Word Data</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form role="Insertform" action="/kamus" method="post" id="deleteFormNegatif" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <input type="hidden" name="_method" value="DELETE">
                                            <p>This data will be deleted, are you sure?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End Delete Modal -->
                    </div>
                    <!-- End Tab Negative Word -->
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
    $(document).ready(function () {

        var table1 = $('#datatable1').DataTable({
            "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": 0,
            }],
            "order": [
                [1, 'asc']
            ]
        });

        var table2 = $('#datatable2').DataTable({
            "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": 0,
            }],
            "order": [
                [1, 'asc']
            ]
        });

        table1.on('order.dt search.dt', function () {
            table1.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
                table1.cell(cell).invalidate('dom');
            });
        }).draw();

        table2.on('order.dt search.dt', function () {
            table2.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
                table2.cell(cell).invalidate('dom');
            });
        }).draw();

        // **********************************************************************

        //Start Edit Record Positif
        table1.on('click', '.edit', function () {

        $tr = $(this).closest('tr');
        if ($($tr).hasClass('child')) {
            $tr = $tr.prev('.parent');
        }

        var positifEdit = table1.row($tr).data();
        console.log(positifEdit);

        $('#positif').val(positifEdit[1]);

        $('#editFormPositif').attr('action', '/kamus/' + positifEdit[1]);
        $('#editModalPositif').modal('show');
        });
        //End Edit Record Positif

        //Start Delete Record Positif
        table1.on('click', '.delete', function () {

        $tr = $(this).closest('tr');
        if ($($tr).hasClass('child')) {
            $tr = $tr.prev('.parent');
        }

        var positifDelete = table1.row($tr).data();
        console.log(positifDelete);

        $('#deleteFormPositif').attr('action', '/kamus/' + positifDelete[1]);
        $('#deleteModalPositif').modal('show');
        });
        //End Delete Record Positif

        // **********************************************************************

        //Start Edit Record Negatif
        table2.on('click', '.edit', function () {

        $tr = $(this).closest('tr');
        if ($($tr).hasClass('child')) {
            $tr = $tr.prev('.parent');
        }

        var negatifEdit = table2.row($tr).data();
        console.log(negatifEdit);

        $('#negatif').val(negatifEdit[1]);

        $('#editFormNegatif').attr('action', '/kamus/' + negatifEdit[1]);
        $('#editModalNegatif').modal('show');
        });
        //End Edit Record Negatif

        //Start Delete Record Negatif
        table2.on('click', '.delete', function () {

        $tr = $(this).closest('tr');
        if ($($tr).hasClass('child')) {
            $tr = $tr.prev('.parent');
        }

        var negatifDelete = table2.row($tr).data();
        var neg = 'negatif';

        $('#deleteFormNegatif').attr('action', '/kamus/hapus/' + negatifDelete[1]);
        $('#deleteModalNegatif').modal('show');
        });
        //End Delete Record Negatif
    });
</script>
@endsection