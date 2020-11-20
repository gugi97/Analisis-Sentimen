@extends('layouts.master')
<!-- Header END -->

<!-- PAGE CONTENT BEGIN -->
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Slangword List</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active">Slangword List</li>
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

        @if(Session::has('success'))
        <div class="alert alert-success">
            <p style="margin-bottom: 0px;">{{ Session::get('success') }}</p>
        </div>
        @endif
        {{-- END ALERT MESSAGE --}}

        <div class="card">
            <!-- Card Header -->
            <!-- <div class="card-header">
                <h3 align="center">Slangword List</h3>
            </div> -->
            <!-- End Card Header -->

            <!-- form start -->
            <div class="card-body">
                <!-- Button trigger Add modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    <i class="fas fa-plus-circle"></i> Add Data
                </button>
                <!-- End Trigger Button -->

                <br><br>
                <table id="datatable" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr style="text-align: center;">
                            <th scope="col">No</th>
                            <th scope="col">Slangword</th>
                            <th scope="col">Mean</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($slang as $slangword)
                        <tr style="text-align: center;">
                            <th></th>
                            <td>{{ $slangword->slang }}</td>
                            <td>{{ $slangword->mean }}</td>
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
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Slang Word List</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form role="Insertform" action="{{ action('SlangWordController@store') }}" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <label>Slangword</label>
                                        <input type="text" class="form-control" placeholder="Slangword"
                                            name="slang" value="{{ old('slang') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Mean</label>
                                        <input type="text" class="form-control" placeholder="Mean"
                                            name="mean" value="{{ old('mean') }}">
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
                {{-- End Add Modal --}}

                <!-- Start Edit Modal -->
                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Slangword Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form role="Insertform" action="/slangword" method="post" id="editForm"
                                enctype="multipart/form-data">
                                <div class="modal-body">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}

                                    <div class="form-group">
                                        <label>Slangword</label>
                                        <input type="text" class="form-control" placeholder="Slangword"
                                            name="slang" id="slang" value="{{ old('slang') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Mean</label>
                                        <input type="text" class="form-control" placeholder="Mean"
                                            name="mean" id="mean" value="{{ old('mean') }}">
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
                {{-- End Edit Modal --}}

                <!-- Start Delete Modal -->
                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete Slangword Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form role="Insertform" action="/slangword" method="post" id="deleteForm" enctype="multipart/form-data">
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
                {{-- End Delete Modal --}}
            </div>

            <!-- Footer -->
            <div class="card-footer">

            </div>
            <!-- End Footer -->
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

        var t = $('#datatable').DataTable({
            "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": 0
            }],
            "order": [
                [1, 'asc']
            ]
        });

        t.on('order.dt search.dt', function () {
            t.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
                t.cell(cell).invalidate('dom');
            });
        }).draw();

        var table = $('#datatable').DataTable();

        //Start Edit Record
        table.on('click', '.edit', function () {

            $tr = $(this).closest('tr');
            if ($($tr).hasClass('child')) {
                $tr = $tr.prev('.parent');
            }

            var data = table.row($tr).data();
            console.log(data);

            $('#slang').val(data[1]);
            $('#mean').val(data[2]);

            $('#editForm').attr('action', '/slangword/' + data[1]);
            $('#editModal').modal('show');
        });
        //End Edit Record

        //Start Delete Record
        table.on('click', '.delete', function () {

            $tr = $(this).closest('tr');
            if ($($tr).hasClass('child')) {
                $tr = $tr.prev('.parent');
            }

            var data = table.row($tr).data();
            console.log(data);

            $('#deleteForm').attr('action', '/slangword/' + data[1]);
            $('#deleteModal').modal('show');
        });
        //End Delete Record
    });

</script>
@endsection
