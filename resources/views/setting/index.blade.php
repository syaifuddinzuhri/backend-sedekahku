@extends('layouts.app')

@section('title', 'Pengaturan')

@section('stylePage')
@endsection

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pengaturan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Pengaturan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
    <section class="content mb-4">
        <div class="container-fluid">
            <div class="row">
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
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Pengaturan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ route('setting.store') }}" method="POST" id="form">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="about">Tentang</label>
                                <textarea class="ckeditor form-control" rows="10" placeholder="Deskripsi singkat program" name="about">{{ isset($setting) && $setting->about ? $setting->about : '' }}</textarea>
                                @error('about')
                                    <span class="text-danger" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" placeholder="Email" name="email"
                                    value="{{ isset($setting) && $setting->email ? $setting->email : '' }}">
                                @error('email')
                                    <span class="text-danger" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone">Nomor HP</label>
                                <input type="number" class="form-control" placeholder="Nomor HP" name="phone"
                                    value="{{ isset($setting) && $setting->phone ? $setting->phone : '' }}">
                                @error('phone')
                                    <span class="text-danger" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="address">Alamat</label>
                                <input type="text" class="form-control" placeholder="Alamat" name="address"
                                    value="{{ isset($setting) && $setting->address ? $setting->address : '' }}">
                                @error('address')
                                    <span class="text-danger" role="alert">{{ $message }}</span>
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
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
@endsection
