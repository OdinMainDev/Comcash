<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Exchanger Admin</title>
        <link rel="stylesheet" href="/admin/assets/vendors/core/core.css">
        <link rel="stylesheet" href="/admin/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
        <link rel="stylesheet" href="/admin/assets/fonts/feather-font/css/iconfont.css">
        <link rel="stylesheet" href="/admin/assets/vendors/flag-icon-css/css/flag-icon.min.css">
        <link rel="stylesheet" href="/admin/assets/css/demo_1/style.css">
        <link rel="shortcut icon" href="/admin/assets/images/favicon.png" />
    </head>
    <body>
        <div class="main-wrapper">
            @include("admin.components.menu")
            <div class="page-wrapper">
                @include("admin.components.navigation")
                <div class="page-content">
                    @yield("content")
                </div>
                @include("admin.components.footer")
            </div>
        </div>

        <script src="/admin/assets/vendors/core/core.js"></script>
        <script src="/admin/assets/vendors/chartjs/Chart.min.js"></script>
        <script src="/admin/assets/vendors/jquery.flot/jquery.flot.js"></script>
        <script src="/admin/assets/vendors/jquery.flot/jquery.flot.resize.js"></script>
        <script src="/admin/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
        <script src="/admin/assets/vendors/apexcharts/apexcharts.min.js"></script>
        <script src="/admin/assets/vendors/progressbar.js/progressbar.min.js"></script>
        <script src="/admin/assets/vendors/feather-icons/feather.min.js"></script>
        <script src="/admin/assets/js/template.js"></script>
        <script src="/admin/assets/js/dashboard.js"></script>
        <script src="/admin/assets/js/datepicker.js"></script>
    </body>
</html>    