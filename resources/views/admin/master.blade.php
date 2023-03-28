<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>@yield('title')</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="{{asset('management_app/public/admin/css/styles.css')}}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

        @yield('head')
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-primary">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3 text-center" href="{{url('/')}}"><b>Management App</b></a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 text-white" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">    
            </div>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li class="dropdown-item">Hello Admin</li>
                        <li><a class="dropdown-item" href="{{url('logout')}}">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark bg-primary" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a {!! (Request::is('dashboard') ? 'class="nav-link active bg-white text-dark rounded mx-2"' : 'class="nav-link text-white"') !!} href="{{url('dashboard')}}">
                                <div {!! (Request::is('dashboard') ? 'class="sb-nav-link-icon text-dark"' : 'class="sb-nav-link-icon text-white"') !!}><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a {!! (Request::is('users') ? 'class="nav-link active bg-white text-dark rounded mx-2"' : 'class="nav-link text-white"') !!} href="{{url('users')}}">
                                <div {!! (Request::is('users') ? 'class="sb-nav-link-icon text-dark"' : 'class="sb-nav-link-icon text-white"') !!}><i class="fas fa-users"></i></div>
                                Users
                            </a>
                            <a {!! (Request::is('customers') ? 'class="nav-link active bg-white text-dark rounded mx-2"' : 'class="nav-link text-white"') !!} href="{{url('customers')}}">
                                <div {!! (Request::is('customers') ? 'class="sb-nav-link-icon text-dark"' : 'class="sb-nav-link-icon text-white"') !!}><i class="fas fa-user"></i></div>
                                Customers
                            </a>
                            <a {!! (Request::is('runners') ? 'class="nav-link active bg-white text-dark rounded mx-2"' : 'class="nav-link text-white"') !!} href="{{url('runners')}}">
                                <div {!! (Request::is('runners') ? 'class="sb-nav-link-icon text-dark"' : 'class="sb-nav-link-icon text-white"') !!}><i class="fas fa-person-running"></i></div>
                                Runners
                            </a>
                            <a {!! (Request::is('items') ? 'class="nav-link active bg-white text-dark rounded mx-2"' : 'class="nav-link text-white"') !!} href="{{url('items')}}">
                                <div {!! (Request::is('items') ? 'class="sb-nav-link-icon text-dark"' : 'class="sb-nav-link-icon text-white"') !!}><i class="fas fa-table"></i></div>
                                Items
                            </a>
                            <a {!! (Request::is('orders') ? 'class="nav-link active bg-white text-dark rounded mx-2"' : 'class="nav-link text-white"') !!} href="{{url('orders')}}">
                                <div {!! (Request::is('orders') ? 'class="sb-nav-link-icon text-dark"' : 'class="sb-nav-link-icon text-white"') !!}><i class="fab fa-jedi-order"></i></div>
                                Orders
                            </a>
                            <a {!! (Request::is('sales') ? 'class="nav-link active bg-white text-dark rounded mx-2"' : 'class="nav-link text-white"') !!} href="{{url('sales')}}">
                                <div {!! (Request::is('sales') ? 'class="sb-nav-link-icon text-dark"' : 'class="sb-nav-link-icon text-white"') !!}><i class="fas fa-chart-line"></i></div>
                                Sales
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                      @yield('page-content')
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Management App 2023</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('management_app/public/admin/js/scripts.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#datatablesSimple').DataTable();
            });
        </script>
    </body>
</html>
