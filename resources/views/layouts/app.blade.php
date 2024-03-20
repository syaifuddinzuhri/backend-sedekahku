@include('layouts.header')


@include('layouts.navbar')
@include('layouts.sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    @yield('content-header')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @yield('content')
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@include('layouts.footer')
