<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME', 'CTF-Платформа') }} | @yield('title')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/theme/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="/theme/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/theme/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="/theme/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/theme/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/theme/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/theme/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="/theme/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="/theme/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    @yield('custom-styles')

    <link rel="stylesheet" href="/theme/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/theme/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="/css/custom-css/my-styles.css">
    <link href="/theme/plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="/theme/plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/theme/plugins/dropzone/min/dropzone.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @include('partials.preloader')
    @include('partials.navbar')
    @include('partials.sidebar')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    @yield('header')
                    @yield('breadcrumbs')
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
    </div>

    <footer class="main-footer">
        <strong>Создано для <a href="https://gumrf.ru">ГУМРФ</a>.</strong>
    </footer>
</div>

<!-- jQuery -->
<script src="/theme/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/theme/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/theme/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jQuery Knob Chart -->
<script src="/theme/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/theme/plugins/moment/moment.min.js"></script>
<script src="/theme/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/theme/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/theme/plugins/summernote/summernote-bs4.min.js"></script>
<!-- AdminLTE App -->
<script src="/theme/dist/js/adminlte.js"></script>
<script src="/theme/plugins/select2/js/select2.full.min.js"></script>
<script src="/theme/plugins/sweetalerts/sweetalert2.min.js"></script>
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

<script src="/js/custom-scripts/layout.js"></script>
@if (Session::has('message-success'))
    <script type="text/javascript">
        const swAlertError = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
            padding: '2em'
        });
        swAlertError({
            type: 'success',
            title: '{{Session::get("message-success")}}',
            padding: '2em',
        })
    </script>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script type="text/javascript">
            const swAlertError = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            swAlertError({
                type: 'error',
                title: '{{$error}}',
                padding: '2em',
            })
        </script>
    @endforeach
@endif

@if (Session::has('message-danger') )
    <script type="text/javascript">
        const swAlertError = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            padding: '2em'
        });
        swAlertError({
            type: 'error',
            title: '{{Session::get("message-danger")}}',
            padding: '2em',
        })
    </script>
@endif
@if (Session::has('message-warning'))
    <script type="text/javascript">
        const swAlertError = swal.mixin({
            toast: true,
            position: 'top-end',

            showConfirmButton: false,
            timer: 4000,
            padding: '2em'
        });
        swAlertError({
            type: 'warning',
            title: '{{Session::get("message-warning")}}',
            padding: '2em'

        })
    </script>
@endif
@yield('custom-scripts')
</body>
</html>
