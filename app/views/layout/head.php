<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Voler Admin Dashboard</title>

    <link rel="stylesheet" href="<?= BASEURL ?>dist/assets/css/bootstrap.css">

    <link rel="stylesheet" href="<?= BASEURL ?>dist/assets/vendors/chartjs/Chart.min.css">
    <link rel="stylesheet" href="<?= BASEURL ?>dist/assets/vendors/apexcharts/apexcharts.css">

    <link rel="stylesheet" href="<?= BASEURL ?>dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="<?= BASEURL ?>dist/assets/css/app.css">
    <link rel="stylesheet" href="<?= BASEURL ?>vendor/datatables/datatables.min.css">
    <link rel="stylesheet" href="<?= BASEURL ?>dist/assets/css/custom.css">
    <link rel="shortcut icon" href="<?= BASEURL ?>dist/assets/images/favicon.svg" type="image/x-icon">
</head>

<body>
    <div id="app">
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <img src="<?= BASEURL ?>dist/assets/images/logo.svg" alt="" srcset="">
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class='sidebar-title'>Main Menu</li>
                        <?php
                        echo $data['menu'];
                        ?>
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <!-- End Sidebar -->

        <!-- Start Top Navbar -->
        <div id="main">
            <nav class="navbar navbar-header navbar-expand navbar-light border-bottom">
                <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
                <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
                        <li class="dropdown nav-icon">
                            <a href="#" data-bs-toggle="dropdown" class="nav-link  dropdown-toggle nav-link-lg nav-link-user">
                                <div class="d-lg-inline-block">
                                    <i data-feather="search"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-large px-2">
                                <input type="text" id="siswa_name" class="form-control" name="siswa_name" placeholder="Cari Siswa">
                                <div class="siswa_list position-absolute">
                                </div>
                            </div>
                        </li>

                        <li class="dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <div class="avatar me-1">
                                    <img src="<?= BASEURL ?>dist/assets/images/avatar/avatar-s-1.png" alt="" srcset="">
                                </div>
                                <div class="d-none d-md-block d-lg-inline-block">Hi, Saugi</div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#"><i data-feather="user"></i> Account</a>
                                <a class="dropdown-item" href="#"><i data-feather="settings"></i> Settings</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= BASEURL ?>home/logout"><i data-feather="log-out"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="main-content container-fluid">
                <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-between mb-3">
                    <h2 class="title-page"><?= $data['title'] ?></h2>

                    <div class="d-flex justify-content-end waktu text-white">
                        <div class="px-3 pt-2 bg-info" id="hari"></div>
                        <div class="px-3 pt-2 bg-primary" id="jam"></div>
                    </div>
                </div>