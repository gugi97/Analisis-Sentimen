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
                <table id="datatable" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr style="text-align: center;">
                            <th scope="col">No</th>
                            <th scope="col">User</th>
                            <th scope="col">Tweet</th>
                            <th scope="col">Date</th>
                            <th scope="col">Category</th>
                            <th scope="col">Label</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataset as $data)
                        <tr style="text-align: center;">
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $data->user }}</td>
                            <td style="text-align:justify;">{{ $data->tweet }}</td>
                            <td>{{ $data->date}}</td>
                            <td>{{ $data->category }}</td>
                            <td>
                            <form action="{{URL::to('/labelling/'.$data->id_tweet)}}" method="post">
                                    {{ csrf_field() }}
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{$data->id_tweet}}">
                                    <div class="form-group">
                                        <select @switch($data->label)
                                            @case("positif")
                                            class="form-control bg-success text-white"
                                            @break
                                            @case("netral")
                                            class="form-control bg-info text-white"
                                            @break
                                            @case("negatif")
                                            class="form-control bg-danger text-white"
                                            @break
                                            @default
                                            class="form-control"
                                            @endswitch
                                            name="label" onchange="submit()">
                                            <option value="" @if (!$data->label)
                                                selected
                                                @endif>----</option>
                                            <option value="positif" @if ($data->label == "positif")
                                                selected
                                                @endif
                                                ><strong>Positif</strong></option>
                                            <option value="netral" @if ($data->label == "netral")
                                                selected
                                                @endif
                                                ><strong>Netral</strong></option>
                                            <option value="negatif" @if ($data->label == "negatif")
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

                <!-- Start Edit Modal -->
                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Sentiment Label</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form role="Insertform" action="/labelling" method="post" id="editForm"
                                enctype="multipart/form-data">
                                <div class="modal-body">
                                    {{ csrf_field() }}
                                    @method('PUT')

                                    <div class="form-group">
                                        <label>Label</label>
                                        <select class="form-control" name="label" id="label" required>
                                            <option value="positif">Positif</option>
                                            <option value="netral">Netral</option>
                                            <option value="negatif">Negatif</option>
                                        </select>
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
                "targets": [0, 3],
                "width": "11%", "targets": [3, 5]
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
    });

</script>
@endsection
