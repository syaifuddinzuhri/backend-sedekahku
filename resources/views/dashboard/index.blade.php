@extends('layouts.app')

@section('title', 'Dashboard')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
    <ul class="list-group">
        <li class="list-group-item text-center font-weight-bold">PENERIMAAN SEDEKAHYUK</li>
        <li class="list-group-item">
            <div class="d-flex align-items-center justify-content-between">
                <span class="font-weight-bold">TOTAL PENERIMAAN</span>
                <span>Rp. {{ number_format($total, 0, ',', '.') }}</span>
            </div>
        </li>
        <li class="list-group-item">
            <div class="d-flex align-items-center justify-content-between">
                <span class="font-weight-bold">PENERIMAAN PER PROGRAM</span>
            </div>
        </li>
        @foreach ($data as $item)
            <li class="list-group-item">
                <div class="d-flex align-items-center justify-content-between">
                    <span>{{ $item->name }}</span>
                    <span>Rp. {{ number_format($item->total, 0, ',', '.') }}</span>
                </div>
            </li>
        @endforeach
    </ul>
@endsection
