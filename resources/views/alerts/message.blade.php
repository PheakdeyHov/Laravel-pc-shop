
    @if(session('success'))
    <script>
        Swal.fire({
            toast: true,
            icon: 'success',
            title: '{{ session('success') }}',
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            customClass: {
                toast: 'custom-toast-success'
            }
        });
    </script>
    @endif

    @if(session('warning'))
    <script>
        Swal.fire({
            toast: true,
            icon: 'warning',
            title: '{{ session('warning') }}',
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            customClass: {
                toast: 'custom-toast-warning'
            }
        });
    </script>
    @endif

    @if(session('info'))
    <script>
        Swal.fire({
            toast: true,
            icon: 'info',
            title: '{{ session('info') }}',
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            customClass: {
                toast: 'custom-toast-info'
            }
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        Swal.fire({
            toast: true,
            icon: 'error',
            title: '{{ session('error') }}',
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            customClass: {
                toast: 'custom-toast-error'
            }
        });
    </script>
    @endif
