<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description"
        content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Dashboard ecommerce - Vuexy - Bootstrap HTML admin template</title>
    <link rel="apple-touch-icon" href="{{ asset('/') }}app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/') }}app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/vendors/css/extensions/toastr.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/css/themes/semi-dark-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/vendors/css/extensions/swiper.min.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/') }}app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/css/pages/dashboard-ecommerce.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/css/plugins/charts/chart-apex.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/') }}app-assets/css/plugins/extensions/ext-component-toastr.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/css/pages/app-ecommerce-details.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/') }}app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/') }}app-assets/css/plugins/forms/form-number-input.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/') }}app-assets/css/plugins/extensions/ext-component-toastr.css">
    <!-- END: Custom CSS-->

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @yield('page-styles')
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click"
    data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
    @include('layouts.header')
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    @include('layouts.sidebar')
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <x-alert />
                @yield('content')
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy;
                2021<a class="ms-25" href="https://1.envato.market/pixinvent_portfolio"
                    target="_blank">Pixinvent</a><span class="d-none d-sm-inline-block">, All rights
                    Reserved</span></span><span class="float-md-end d-none d-md-block">Hand-crafted & Made with<i
                    data-feather="heart"></i></span></p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-sm-5 mx-50 pb-5">
                    <h1 class="text-center mb-1" id="addNewCardTitle">Delete</h1>
                    <p class="text-center">Do you really want to delete?</p>

                    <!-- form -->
                    <form id="deleteModalForm" class="row gy-1 gx-2 mt-75" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="delete_id">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-danger me-1 mt-1">Yes,DELETE IT</button>
                            <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal"
                                aria-label="Close">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-sm-5 mx-50 pb-5">
                    <h1 class="text-center mb-1" id="addNewCardTitle">Status</h1>
                    <p class="text-center">Do you really want to status?</p>

                    <!-- form -->
                    <form id="statusModalForm" class="row gy-1 gx-2 mt-75" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="status_id">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-success me-1 mt-1">Yes</button>
                            <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal"
                                aria-label="Close">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('/') }}app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('/') }}app-assets/vendors/js/charts/apexcharts.min.js"></script>
    <script src="{{ asset('/') }}app-assets/vendors/js/extensions/toastr.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('/') }}app-assets/js/core/app-menu.js"></script>
    <script src="{{ asset('/') }}app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('/') }}app-assets/js/scripts/pages/dashboard-ecommerce.js"></script>
    <!-- END: Page JS-->
    <script src="http://cdn.datatables.net/2.1.4/js/dataTables.min.js"></script>
    <script src="{{ asset('/') }}app-assets/vendors/js/extensions/swiper.min.js"></script>
    <script src="{{ asset('/') }}app-assets/js/scripts/pages/app-ecommerce-details.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
            $(document).ready(function() {
                $('.select2').select2();
            });
            let table = new DataTable('#myTable');
            $(".delete_model").on('click', function() {
                $("#deleteModal").modal('show');
                var url = $(this).data('url');
                var id = $(this).data('id');
                $("#deleteModalForm").attr('action', url);
                $("#delete_id").val(id);
            });

            $(".status_model").on('click', function() {
                $("#statusModal").modal('show');
                var url = $(this).data('url');
                var id = $(this).data('id');
                $("#statusModalForm").attr('action', url);
                $("#status_id").val(id);
            });
        })
    </script>
    @stack('page-scripts')
</body>
<!-- END: Body-->

</html>
