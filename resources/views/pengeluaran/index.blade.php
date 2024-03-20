@extends('layouts.app')

@section('title', 'Pengeluaran')

@section('stylePage')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('templates') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('templates') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endsection

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pengeluaran</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Pengeluaran</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
    @php
        $programId = request()->query('program');
    @endphp

    <section class="content mb-4">
        <div class="container-fluid">
            <div class="mb-3">
                <a href="{{ route('program.index') }}" class="btn btn-outline-dark">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    Kembali
                </a>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{ route('pengeluaran.create', ['program' => $programId]) }}" class="btn btn-primary">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Tambah Pengeluaran
                    </a>
                </div>
                @if (Session::has('error'))
                    <div class="col-12 mt-3">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ Session::get('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endif
                @if (Session::has('success'))
                    <div class="col-12 mt-3">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ Session::get('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold">PROGRAM</h3>
                    </div>
                    <div class="card-body">
                        <h4>{{ $program->name }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Pengeluaran</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <table id="table-pengeluaran" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Pengeluaran</th>
                            <th>Nominal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>

    </section>
    <!-- /.content -->
@endsection


@section('modalPage')
    {{-- Delete Modal --}}
    <div class="modal fade" id="modal-delete-pengeluaran" tabindex="-1" role="dialog"
        aria-labelledby="modal-delete-pengeluaran-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-delete-pengeluaran-title">Konfirmasi hapus</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Apakah Anda yakin akan menghapus data?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form method="POST" id="form-delete-pengeluaran">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-submit">
                            <i class="fas fa-fw fa-trash"></i>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptPage')
    <!-- DataTables -->
    <script src="{{ asset('templates') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('templates') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('templates') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('templates') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

    <script>
        var urlParams = new URLSearchParams(window.location.search);
        var programId = urlParams.get('program');

        $("#table-pengeluaran").DataTable({
            responsive: true,
            autoWidth: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: APP_URL + "/pengeluaran",
                data: function(d) {
                    d.program = programId;
                }
            },
            columns: [{
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    className: "text-center",
                    width: "4%",
                },
                {
                    data: "name",
                    name: "name"
                },
                {
                    data: "nominal",
                    name: "nominal"
                },
                {
                    data: "action",
                    name: "action",
                    className: "text-center",
                    orderable: false,
                    searchable: false,
                },
            ],
        });

        $("#table-pengeluaran").on("click", ".delete-pengeluaran", function() {
            var id = $(this).attr("data-id");
            $("#form-delete-pengeluaran").attr(
                "action",
                `${APP_URL}/pengeluaran/${id}`
            );
        });
    </script>
@endsection
