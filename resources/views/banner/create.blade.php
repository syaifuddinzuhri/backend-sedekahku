@extends('layouts.app')

@section('title', 'Banner')

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
                    <h1 class="m-0">Data Banner</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('banner.index') }}">Banner</a></li>
                        <li class="breadcrumb-item active">Tambah Banner</li>
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
                    <a href="{{ route('banner.index') }}" class="btn btn-outline-dark">
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
                <h3 class="card-title">Form Tambah Banner</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ route('banner.store') }}" method="POST" id="form" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="">Thumbnail</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" accept="image/*" name="image"
                                                id="image">
                                            <label class="custom-file-label" for="image">Pilih file...</label>
                                        </div>
                                        @error('image')
                                            <small class="text-danger" role="alert">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 offset-md-1">
                                    <img src="{{ asset('images/no-image-icon.png') }}" class="w-100" alt=""
                                        id="preview">
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
