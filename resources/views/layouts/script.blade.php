<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<!-- Sweet Alert 2 -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/backend/js/adminlte.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery-ui.min.js') }}"></script> 
<script src="{{ asset('assets/frontend/js/toastr.min.js') }}"></script>
<!-- Parsley -->
<script src="{{ asset('assets/frontend/js/parsley.js') }}"></script>
<script src="{{ asset('assets/frontend/js/bootstrap-toggle.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/select2.min.js') }}"></script>

<script>
    $(document).ready(function() {
        var Toaster = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            didOpen: function(toast) {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
                toast.addEventListener('click', Swal.close);
            }
        });

        @if (Session::has('success'))
        Toaster.fire({
            icon: 'success',
            title: "{{ Session::pull('success') }}"
        });
        @elseif( Session::has('error') )
        Toaster.fire({
            icon: 'error',
            title: "{{ Session::pull('error') }}"
        });
        @elseif( Session::has('info') )
        Toaster.fire({
            icon: 'info',
            title: "{{ Session::pull('info') }}"
        });
        @endif

    });
</script>
<script type="text/javascript">
    $(document).on('click','.backBTN',function(){
        window.location="{{route('admin.users.index')}}";
    })
</script>