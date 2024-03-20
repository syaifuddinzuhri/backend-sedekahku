@extends('layouts.app')

@section('title', 'Pengeluaran')

@section('stylePage')
    <!-- Select2 -->
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
                        <li class="breadcrumb-item active"><a href="{{ route('pengeluaran.index') }}">Pengeluaran</a></li>
                        <li class="breadcrumb-item active">Edit Pengeluaran</li>
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
            <div class="row">
                <div class="col-12">
                    <a href="{{ route('pengeluaran.index', ['program' => $programId]) }}" class="btn btn-outline-dark">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Kembali
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
                <h3 class="card-title">Form Edit Pengeluaran</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ route('pengeluaran.update', $data->id) }}" method="POST" id="form">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" value="{{ $programId }}" name="program_id">
                            <div class="form-group">
                                <label for="name">Nama Pengeluaran</label>
                                <input type="text" class="form-control" placeholder="Nama Pengeluaran" name="name"
                                    value="{{ $data->name }}">
                                @error('name')
                                    <small class="text-danger" role="alert">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nominal">Nominal</label>
                                <input type="number" class="form-control" placeholder="Nominal" name="nominal"
                                    value="{{ $data->nominal }}">
                                @error('nominal')
                                    <small class="text-danger" role="alert">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
            <!-- /.card-body -->
        </div>

    </section>
    <!-- /.content -->
@endsection

@section('scriptPage')
@endsection
