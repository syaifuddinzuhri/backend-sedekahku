@extends('layouts.app')

@section('title', 'Laporan Penerimaan')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Laporan Penerimaan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Laporan Penerimaan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
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

    <form action="{{ route('report.index') }}" method="GET">
        <div class="row">
            <input type="hidden" name="search" value="1">
            <div class="col-md-1">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="is_all" name="is_all">
                    <label class="custom-control-label" for="is_all">Semua</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="from_date">Dari tanggal</label>
                    <input type="text" class="datepicker form-control" id="date-filter" name="from_date"
                        placeholder="Pilih tanggal dari">
                    @error('from_date')
                        <small class="text-danger" role="alert">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="end_date">Sampai tanggal</label>
                    <input type="text" class="datepicker form-control" id="date-filter" name="end_date"
                        placeholder="Pilih tanggal sampai">
                    @error('end_date')
                        <small class="text-danger" role="alert">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-sm btn-primary">Cari</button>
    </form>

    <div class="mt-4">
        @if (count($data) > 0)
            <form action="{{ route('report.store') }}" method="POST">
                @csrf
                <input type="hidden" name="is_all" value="{{ Request::get('is_all') ?? '' }}">
                <input type="hidden" name="from_date" value="{{ Request::get('from_date') ?? '' }}">
                <input type="hidden" name="end_date" value="{{ Request::get('end_date') ?? '' }}">
                <button type="submit" class="btn btn-sm btn-success">Export Excel</button>
            </form>
        @endif
        <div class="mt-4">

            @foreach ($data as $item)
                <li class="list-group-item">
                    <div class="d-flex align-items-center justify-content-between">
                        <span>{{ $item->name }}</span>
                        <span>Rp. {{ number_format($item->total, 0, ',', '.') }}</span>
                    </div>
                </li>
            @endforeach
        </div>
    </div>
@endsection
