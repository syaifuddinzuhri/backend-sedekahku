<footer class="main-footer">
    <strong>Copyright &copy; 2024 <a href="">Sedekahyuk</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0.0
    </div>
</footer>

@yield('modalPage')

<div class="modal fade" id="modal-logout">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Konfirmasi Logout?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin keluar?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                <form action="{{ route('auth.logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-danger">Logout</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('templates') }}/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('templates') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('templates') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- JQVMap -->
<script src="{{ asset('templates') }}/plugins/jqvmap/jquery.vmap.min.js"></script>
<!-- daterangepicker -->
<script src="{{ asset('templates') }}/plugins/moment/moment.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('templates') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('templates') }}/dist/js/adminlte.js"></script>
<!--Main -->
<script type="text/javascript">
    var APP_URL = "{!! url('/') !!}";
</script>
@yield('scriptPage')

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    myFunction()
    var csrf = $('meta[name="csrf-token"]').attr('content');

    function myFunction() {
        myVar = setTimeout(showPage, 500);
    }

    function showPage() {
        document.getElementById("loader").style.display = "none";
    }


    function formatDate(date) {
        // Get year, month, and day part from the date
        var year = date.toLocaleString("default", {
            year: "numeric"
        });
        var month = date.toLocaleString("default", {
            month: "2-digit"
        });
        var day = date.toLocaleString("default", {
            day: "2-digit"
        });

        // Generate yyyy-mm-dd date string
        var formattedDate = `${year}-${month}-${day}`;
        return formattedDate;
    }

    var date = new Date(),
        y = date.getFullYear(),
        m = date.getMonth();
    var firstDayOfMonth = new Date(y, m, 1);
    var now = new Date();

    $(".datepicker").flatpickr({
        dateFormat: "Y-m-d",
    });

    $(".daterangepicker").flatpickr({
        dateFormat: "Y-m-d",
        mode: "range",
        defaultDate: [formatDate(firstDayOfMonth), formatDate(now)]
    });

    $(".timepicker").flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true
    });
</script>
</body>

</html>
