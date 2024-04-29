{!! Theme::partial('header') !!}
<style>
    .pagination {
        display: none;
    }
</style>
<div id="app">
    {!! Theme::content() !!}

     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
         const Toast = Swal.mixin({
            toast: true,
            position: "bottom-left",
            showConfirmButton: false,
            width: 400,
            customClass: {
                popup: ''
            },
            timer: 10000,
            timerProgressBar: false,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            // icon: "success",
            title: " <div class = 'd-flex justify-content-between h4'><span class='mt-2'>Donate us to support the project.</span><a class = 'btn btn-primary btn-lg m-auto' href='{{ URL::to("donation") }}'>Donate</a></div>",
        });
    </script>
</div>

{!! Theme::partial('footer') !!}
