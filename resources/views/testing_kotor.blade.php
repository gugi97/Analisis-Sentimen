@extends('layouts.master')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Daset Testing</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active">Daset Testing</li>
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

        {{-- notifikasi sukses --}}
        @if ( session('success'))
            <div class="alert alert-success" >
                <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{{ session('success') }}</strong>
            </div>
        @endif
        {{-- END ALERT MESSAGE --}}

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
                        <span class="info-box-number" style="font-size: 20px; font-family: cursive;">{{$firstmedia}} Tweet</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- END INFO BOX -->

        <div class="card">
            <!-- <div class="card-header">
                <center>
                    <h4>Jumlah Dataset</h4>
                </center>
            </div> -->
            <!-- /.card-header -->

            <div class="card-body">
                <!-- Button trigger Import Excel modal -->
                <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#importExcel">
                    <i class="fas fa-plus-circle"></i> Import Excel
                </button>
                <!-- End Trigger Button -->

                <!-- Import Excel Modal -->
                <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form method="post" role="Insertform" action="{{ action('DatasetTestingKotorController@store') }}" enctype="multipart/form-data">
                                <div class="modal-body">
                                    {{ csrf_field() }}
                                    <label>File Input</label>
                                    <div class="form-group">
                                        <input type="file" name="file" required="required">
                                        <p>*Only (.xls, .xlsx) file allowed to upload here</p>
                                    </div>
                                    
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">
                                        Import
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->

                <!-- Tabel Tweet -->
                <table id="datatable" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr style="text-align: center;">
                            <th scope="col">No</th>
                            <th scope="col">User</th>
                            <th scope="col">Tweet</th>
                            <th scope="col">Date</th>
                            <th scope="col">Category</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $dataset)
                        <tr>
                            <th style="text-align:center;">{{ $loop->iteration }}</th>
                            <td>{{ $dataset->user }}</td>
                            <td>{{ $dataset->tweet }}</td>
                            <td>{{ $dataset->date}}</td>
                            <td>{{ $dataset->category }}</td>
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

<script src="/AdminLTE/plugins/jquery/jquery.slim.min.js"></script>
<script src="/AdminLTE/plugins/popper/umd/popper.min.js"></script>

<script src="/AdminLTE/plugins/datatables/jquery.dataTables.min.js" defer></script>
<script src="/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js" defer></script>

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
    });
</script>

@endsection