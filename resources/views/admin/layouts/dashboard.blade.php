<!DOCTYPE html>
<html lang="{{mb_strtolower(app()->getLocale())}}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Exchanger Admin</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="/admin/assets/vendors/core/core.css">
        <!-- <link rel="stylesheet" href="/admin/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css"> -->
        <link rel="stylesheet" href="/admin/assets/fonts/feather-font/css/iconfont.css">
        <link rel="stylesheet" href="/admin/assets/vendors/flag-icon-css/css/flag-icon.min.css">
        
        <link rel="shortcut icon" href="/admin/assets/images/favicon.png" />
        @yield("css")

        <link rel="stylesheet" href="/admin/assets/css/demo_2/style.css">
        <link rel="stylesheet" href="/admin/assets/css/custom.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
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

        <script>
            window.__str = JSON.parse(`{!!addslashes(json_encode([
                "statusExchange0" => __("common.statusExchange0"),
                "statusExchange1" => __("common.statusExchange1"),
                "statusExchange2" => __("common.statusExchange2"),
                "statusExchange3" => __("common.statusExchange3"),
                "statusExchange4" => __("common.statusExchange4"),
                "statusExchange5" => __("common.statusExchange5"),
                "statusExchange11" => __("common.statusExchange11"),
                "statusExchange12" => __("common.statusExchange12"),
                "statusExchange13" => __("common.statusExchange13"),
                "statusExchange14" => __("common.statusExchange14"),
                "statusExchange15" => __("common.statusExchange15"),
                "affstatus0" => __("common.affstatus0"),
                "affstatus1" => __("common.affstatus1"),
                "affstatus2" => __("common.affstatus2"),
            ]));!!}`);
        </script>
        <script src="/admin/assets/vendors/core/core.js"></script>
        <!-- <script src="/admin/assets/vendors/chartjs/Chart.min.js"></script> -->
        <!-- <script src="/admin/assets/vendors/jquery.flot/jquery.flot.js"></script>
        <script src="/admin/assets/vendors/jquery.flot/jquery.flot.resize.js"></script> -->
        <!-- <script src="/admin/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
        <script src="/admin/assets/vendors/apexcharts/apexcharts.min.js"></script>
        <script src="/admin/assets/vendors/progressbar.js/progressbar.min.js"></script> -->
        <script src="/admin/assets/vendors/feather-icons/feather.min.js"></script>
        <script src="/admin/assets/js/template.js"></script>
        <!-- <script src="/admin/assets/js/dashboard.js"></script>
        <script src="/admin/assets/js/datepicker.js"></script> -->
        @vite("resources/js/app.js")
        @yield("js")

       
    </body>
</html>    