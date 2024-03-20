@extends('layouts.app')

@section('title', 'Program')

@section('stylePage')
    <!-- Select2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css" />
    <link rel="stylesheet" href="{{ asset('templates') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('templates') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Program</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('program.index') }}">Program</a></li>
                        <li class="breadcrumb-item active">Edit Program</li>
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
                    <a href="{{ route('program.index') }}" class="btn btn-outline-dark">
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
                <h3 class="card-title">Form Edit Program</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('program.update', $data->id) }}" method="POST" id="form"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="name">Nama Program</label>
                                <input type="text" class="form-control" placeholder="Nama Program" name="name"
                                    value="{{ $data->name }}">
                                @error('name')
                                    <small class="text-danger" role="alert">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="end_date">Tanggal Berakhir (Opsional)</label>
                                <input type="text" class="datepicker form-control" id="date-filter" name="end_date"
                                    placeholder="Pilih tanggal berakhir" value="{{ $data->end_date }}">
                                @error('end_date')
                                    <small class="text-danger" role="alert">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Deskripsi Singkat</label>
                                <textarea class="ckeditor form-control" rows="10" placeholder="Deskripsi singkat program" name="description">{{ $data->description }}</textarea>
                                @error('description')
                                    <small class="text-danger" role="alert">{{ $message }}</small>
                                @enderror
                            </div>
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
                                    <img src="{{ $data->thumbnail ? $data->thumbnail : asset('images/no-image-icon.png') }}"
                                        class="w-100" alt="" id="preview">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col">
                                <div class="card card-outline card-success">
                                    <div class="card-header">
                                        <h3 class="card-title font-weight-bold">Upload Foto</h3>
                                    </div>
                                    <div class="card-body">
                                        <form id="dropzoneForm" class="dropzone" method="POST"
                                            action="{{ route('program-images.store') }}">
                                            @csrf
                                            <input type="hidden" value="{{ $data->id }}" name="program">
                                        </form>
                                        <small>Maksimal ukuran file 5MB</small>
                                        <div class="row mt-3">
                                            <div class="col text-right btn-group-dz">
                                                <button class="btn btn-primary btn-loading" type="button" disabled>
                                                    <span class="spinner-grow spinner-grow-sm" role="status"
                                                        aria-hidden="true"></span>
                                                    Loading...
                                                </button>
                                                <button type="button" class="btn btn-primary" id="submit-all">
                                                    <i class="fas fa-save"></i>
                                                    Upload
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card card-outline card-warning">
                                    <div class="card-header">
                                        <h3 class="card-title font-weight-bold">Galeri</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            @foreach ($images as $item)
                                                <div class="col-md-3 text-center mb-3">
                                                    <img src="{{ $item->image }}" alt="" class="w-100">
                                                    <form method="POST" class="mt-2"
                                                        action="{{ route('program-images.destroy', $item->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm btn-submit">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /.card-body -->
        </div>

    </section>
    <!-- /.content -->
@endsection

@section('scriptPage')
    <!-- Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>
    <script src="{{ asset('templates') }}/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        $(".btn-loading").hide();
        var myDropzone = new Dropzone(".dropzone", {
            parallelUploads: 10,
            autoProcessQueue: false,
            addRemoveLinks: true,
            uploadMultiple: true,
            maxFilesize: 5,
            acceptedFiles: "image/*",
        });

        $("#submit-all").on("click", function() {
            myDropzone.processQueue();
            $(".btn-loading").show();
            $("#submit-all").hide();
        });

        myDropzone.on("complete", function() {
            if (
                this.getQueuedFiles().length == 0 &&
                this.getUploadingFiles().length == 0
            ) {
                var _this = this;
                _this.removeAllFiles();

                $(".btn-loading").hide();
                $("#submit-all").show();
                window.location.reload();
            }
        });
    </script>
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
