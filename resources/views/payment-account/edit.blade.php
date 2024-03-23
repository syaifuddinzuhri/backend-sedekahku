@extends('layouts.app')

@section('title', 'Akun Pembayaran')

@section('stylePage')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('templates') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('templates') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Akun Pembayaran</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('payment-account.index') }}">Akun
                                Pembayaran</a></li>
                        <li class="breadcrumb-item active">Tambah Akun Pembayaran</li>
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
                <div class="col-12">
                    <a href="{{ route('payment-account.index') }}" class="btn btn-outline-dark">
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
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Tambah Akun Pembayaran</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ route('payment-account.update', $data->id) }}" method="POST" id="form"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama Bank</label>
                                <input type="text" class="form-control" placeholder="Nama Akun Pembayaran" name="name"
                                    value="{{ $data->name }}">
                                @error('name')
                                    <small class="text-danger" role="alert">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="account_name">Nama Akun Pemilik Rekening</label>
                                <input type="text" class="form-control" placeholder="Nama Akun Pemilik Rekening"
                                    name="account_name" value="{{ $data->account_name }}">
                                @error('account_name')
                                    <small class="text-danger" role="alert">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="account_number">Nomor Rekening</label>
                                <input type="text" class="form-control" placeholder="Nomor Rekening"
                                    name="account_number" value="{{ $data->account_number }}">
                                @error('account_number')
                                    <small class="text-danger" role="alert">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="">Logo</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" accept="image/*" name="logo"
                                                id="image">
                                            <label class="custom-file-label" for="image">Pilih file...</label>
                                        </div>
                                        @error('image')
                                            <small class="text-danger" role="alert">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 offset-md-1">
                                    <img src="{{ $data->logo ? $data->logo : asset('images/no-image-icon.png') }}"
                                        class="w-100" alt="" id="preview">
                                </div>
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
    <!-- Select2 -->
    <script src="{{ asset('templates') }}/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            $().select2 && $('.select-search').select2({
                theme: 'bootstrap4'
            })
            $("#image").on("change", function(e) {
                e.preventDefault();
                if (this.files && this.files[0]) {
                    var name = this.files[0]["name"];
                    $("#form label[for='image']").text(name);
                    var reader = new FileReader();
                    reader.onload = (e) => {
                        $("#preview").attr("src", e.target.result);
                    };
                    reader.readAsDataURL(this.files[0]);
                }
            });

        });
    </script>
@endsection
