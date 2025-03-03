<!-- jQuery -->
<script src="{{ asset('AdminLTE-3.2.0/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('AdminLTE-3.2.0/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('AdminLTE-3.2.0/dist/js/adminlte.js') }}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ asset('AdminLTE-3.2.0/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('AdminLTE-3.2.0/plugins/chart.js') }}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{ asset('AdminLTE-3.2.0/dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('AdminLTE-3.2.0/dist/js/pages/dashboard2.js') }}"></script>
<!-- Page specific script -->
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["excel", "pdf", "print"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
<!--Select2-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#bukuharian_id').select2()

    })
</script>
<script>
    $(document).ready(function() {
        $('#peminjamantahunan_id').select2()

    })
</script>
<script>
    $(document).ready(function() {
        $('#siswa_id').select2()

    })
</script>
<script>
    $(document).ready(function() {
        $('#peminjaman_name').select2()

    })
</script>
<script>
    $(document).ready(function() {
        $('#peminjamantahunan_name').select2()

    })
</script>
<script>
    $(document).ready(function() {
        $('#bukucrud').select2()

    })
</script>
<script>
    $(document).ready(function() {
        $('#bukucrud_id').select2()

    })
</script>
<script>
    $(document).ready(function() {
        $('#bukuharian').select2()

    })
</script>
<script>
    $(document).ready(function() {
        $('#kodebuku').select2()

    })
</script>
