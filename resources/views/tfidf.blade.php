@extends('layouts.master')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>TF-IDF</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active">TF-IDF</li>
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
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ session('success') }}</strong>
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
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th style="text-align:center;"></th>
                            <td style="text-align:center;"></td>
                            <td></td>
                            <td style="text-align:center;"></td>
                            <td></td>
                        </tr>
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
                "targets": 0,
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