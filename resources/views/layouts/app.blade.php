<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Font Style-->
    <link rel="stylesheet" href="{{ url('assets/fonts/khmers/kantumruy_pro.css') }}">
    <link rel="stylesheet" href="{{ url('assets/fonts/poppins/poppins.css') }}">

    <!-- Css Style -->
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap/bootstrap.min.css') }}">

    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="{{ url('assets/icons/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css') }}">

    <!-- SweetAlert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- DataTable -->
    <link rel="stylesheet" href="{{ url('assets/css/datatable/dataTables.dataTables.min.css') }}">

</head>

<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand"><i class="bi bi-emoji-smile-fill"></i> AdminSite</a>
        <ul class="side-menu">
            <li>
                <a href="{{ route('home') }}" class="{{ Route::is('home') || Request::is('/') ? 'active' : '' }}">
                    <i class="bi bi-house"></i> Dashboard
                </a>
            </li>
            <li class="divider" data-text="main">Main</li>
            <li>
                <a
                    class="{{ Route::is('categories.*') || Route::is('brands.*') || Route::is('products.*') ? 'active' : '' }} kh">
                    <i class="bi bi-box2"></i> ទំនិញ
                    <div class="icon-right"><i class="bi bi-caret-right-fill"></i></div>
                </a>
                <ul
                    class="side-dropdown {{ Route::is('categories.*') || Route::is('brands.*') || Route::is('products.*') ? 'show' : '' }}">
                    <li>
                        <a href="{{ route('categories.index') }}"
                            class="{{ Route::is('categories.*') ? 'active' : '' }} kh">ប្រភេទទំនិញ</a>
                    </li>
                    <li>
                        <a href="{{ route('brands.index') }}"
                            class="{{ Route::is('brands.*') ? 'active' : '' }} kh">ម៉ាកទំនិញ</a>
                    </li>
                    <li>
                        <a href="{{ route('products.index') }}"
                            class="{{ Route::is('products.*') ? 'active' : '' }} kh">ទំនិញក្នុងស្ទុក</a>
                    </li>
                </ul>
            </li>
            <li><a href="#"><i class="bi bi-person-vcard"></i> Users</a></li>
            <li><a href="#"><i class="bi bi-clipboard2-data"></i> Report</a></li>
            <li class="divider" data-text="table and form">Table and Form</li>
            <li>
                <a
                    class="{{ Route::is('suppliers.*') || Route::is('purchases.*') ? 'active' : '' }} kh">
                    <i class="bi bi-box2"></i> ការផ្គត់ផ្គង់
                    <div class="icon-right"><i class="bi bi-caret-right-fill"></i></div>
                </a>
                <ul class="side-dropdown {{ Route::is('suppliers.*') || Route::is('purchases.*') ? 'show' : '' }}">
                    <li>
                        <a href="{{ route('suppliers.index') }}"
                        class="{{ Route::is('suppliers.*') ? 'active' : '' }} kh">អ្នកផ្គត់ផ្គង់</a>
                    </li>
                    <li>
                        <a href="{{ route('purchases.index') }}"
                        class="{{ Route::is('purchases.*') ? 'active' : '' }} kh">ការទិញចូល</a>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- END SIDEBAR -->

    <!--HEADER NAVBAR -->
    <section id="content">
        <!-- Nav -->
        <nav>
            <div class="toggle-sidebar">
                <i class="bi bi-list"></i>
            </div>
            <div class="nav-right">
                <a href="#" class="nav-link">
                    <i class="bi bi-bell"></i>
                    <span class="badge">5</span>
                </a>
                <a href="#" class="nav-link">
                    <i class="bi bi-envelope"></i>
                    <span class="badge">8</span>
                </a>
                <span class="divider"></span>
                <div class="profile">
                    <img src="img/user.png" alt="">
                    <ul class="profile-link">
                        <li><a href="#"><i class="bi bi-person-circle"></i> Profile</a></li>
                        <li><a href="#"><i class="bi bi-gear"></i> Settings</a></li>
                        <li><a href="#"><i class="bi bi-door-open"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Nav -->

        <!-- MAIN -->
        <main>
            <h1 class="title kh">@yield('page-title', 'Default Title')</h1>
            @yield('content')
            @yield('scripts')
        </main>
        <!-- END MAIN -->
    </section>
    <!-- END HEADER NAVBAR -->

    <!-- Chart -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- Bootstrap Script -->
    <script src="{{ url('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>

    <!-- Jquery Script -->
    <script src="{{ url('assets/js/jquery.min.js') }}"></script>

    <!-- Main Script -->
    <script src="{{ url('assets/js/main.js') }}"></script>

    <!-- DataTable -->
    <script src="{{ url('assets/js/datatable/dataTables.min.js') }}"></script>
</body>

</html>
