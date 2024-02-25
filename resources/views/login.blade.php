<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>كشافة الشمندورة - لوحة التحكم</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <style>
  @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;500&display=swap');
    </style>
    <link rel="icon" type="image/png" href="{{ asset('img/shamandora.png') }}">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="right:0">
                <div>
                    <img class ="" src="{{ asset('img/shamandora.png') }}" style="width: 100px; height: 100px;" alt="Shamandora Image">
                </div>
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href={{ url('/index') }}>
                <div class="sidebar-brand-text mx-3">Athanasius Scouts</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href={{ url('/index') }}>
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span style="font-family: 'Cairo', sans-serif; font-weight: lighter;">لوحة التحكم</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Administration</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Configurations</h6>
                        <a class="collapse-item">Granting Access</a>
                        <a class="collapse-item">Reports</a>
                        <a class="collapse-item">تعديل بيانات</a>
                        <a class="collapse-item">كلمات السر</a>
                        <a class="collapse-item">الترقيات</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Configurations</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Configurations</h6>
                        <a class="collapse-item" href="utilities-color.html">واجهات</a>
                        <a class="collapse-item" href="utilities-color.html">ألوان</a>
                        <a class="collapse-item" href="utilities-color.html">جداول</a>
                    </div>
                </div>
            </li>
            

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Person
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span style="font-family: 'Cairo', sans-serif;">الملتحقين</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">صفحات التسجيل والدخول</h6>
                        <a class="collapse-item" href={{ url('/login') }}>تسجيل الدخول</a>
                        <a class="collapse-item" href={{ url('/register') }}>اضافة حساب جديد</a>
                        <a class="collapse-item" href={{ url('/forgot-password') }}>نسيت كلمة السر؟</a>
                        <a class="collapse-item" href={{ url('/createperson') }}>اضافة ملتحق جديد</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href={{ url('/') }}>
                    <i class="fas fa-fw fa-table"></i>
                    <span style="font-family: 'Cairo', sans-serif;">جداول الملتحقين</span></a>
            </li>

            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Midea
            </div>

            <li class="nav-item">
                <a class="nav-link" href={{ url('/person') }}>
                    <i class="fas fa-fw fa-photo-video"></i>
                    <span style="font-family: 'Cairo', sans-serif;">منصة الميديا</span></a>
            </li>
            
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" style="font-family: 'Cairo', sans-serif; direction: rtl;" placeholder="ابحث عن ...."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header" style="font-family: 'Cairo', sans-serif;">
                                    الاشعارات
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">Novemer 12, 2023</div>
                                        <span class="font-weight-bold">كلمة أبونا في المجمع الكشفي 2023 متاحة الآن</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">November 7, 2023</div>
                                        رسالة عامة من قائد الكشافة
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">November 4, 2023</div>
                                        تم اضافة صور جديدة للمعسكر الأخير
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">اظهار جميع الاشعارات</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header" style="font-family: 'Cairo', sans-serif;">
                                    الرسائل
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src={{ asset('img/undraw_profile_1.svg') }}
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="">مساء الخير، حابب أسأل عليك ونطمن على أحوالك</div>
                                        <div class="small text-gray-500">مينا نادر . 58 دقيقة</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src={{ asset('img/undraw_profile_2.svg') }}
                                            alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">انا خلصت تحضير الكلمة الافتتاحية</div>
                                        <div class="small text-gray-500">ماريو عماد . 5 ساعات</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src={{ asset('img/undraw_profile_3.svg') }}
                                            alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="">ماتنساش تبعت الصور بتاعت يوم السبت</div>
                                        <div class="small text-gray-500">مارينا محب . يومين</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">تصفح باقي الرسايل</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small" style="font-family: 'Cairo', sans-serif;">مارك ابراهيم</span>
                                <img class="img-profile rounded-circle"
                                    src={{ asset("img/undraw_profile.svg")}}>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800" style="font-family: 'Cairo', sans-serif;">لوحة التحكم</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="font-family: 'Cairo', sans-serif;"><i
                                class="fas fa-download fa-sm text-white-50" ></i> تنزيل تقرير خدمتي</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row"  style="display: flex; flex-wrap: wrap">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="font-family: 'Cairo', sans-serif;">
                                                عدد الخدام الحالي</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">96</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1" style="font-family: 'Cairo', sans-serif;">
                                                دخل العام الحالي</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">$0</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1" style="font-family: 'Cairo', sans-serif;">اجمالي عدد الملتحقين
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">1635</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1" style="font-family: 'Cairo', sans-serif;">
                                               الرسائل غير المقروءة</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row"  style="display: flex; flex-wrap: wrap">

                        

                        <!-- Pie Chart -->
                        <div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary" style="font-family: 'Cairo', sans-serif;">رسم توضيحي لأعداد وأنواع الملتحقين</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <div class="mt-4 small" style="text-align: center;">
                                        <span class="">
                                            <a>براعم</a>
                                            <i class="fas fa-circle" style="color: #e74a3b;"></i>
                                        </span>
                                            <span class="">
                                            <a>أشبال</a>
                                            <i class="fas fa-circle" style="color: #f6c23e;"></i>
                                        </span>
                                            <span class="">
                                            <a>زهرات</a>
                                            <i class="fas fa-circle" style="color: #2e59d9;"></i>
                                        </span>
                                            <span class="">
                                            <a>كشافة</a>
                                            <i class="fas fa-circle" style="color: #36b9cc;"></i>
                                        </span>
                                        <br>
                                            <span>
                                            <a>مرشدات</a>
                                            <i class="fas fa-circle" style="color: #1cc88a;"></i>
                                        </span>
                                            <span class="">
                                            <a>متقدم</a>
                                            <i class="fas fa-circle" style="color: #C74EDF;"></i>
                                        </span>
                                            <span class="">
                                            <a>رائدات</a>
                                            <i class="fas fa-circle" style="color: #2e59d9;"></i>
                                        </span>
                                        <div class="">
                                            <a>جوالة</a>
                                            <i class="fas fa-circle" style="color: #634561;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Area Chart -->
                        <div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary" style="font-family: 'Cairo', sans-serif; text-align: center;" >أعداد الملتحقين الجدد</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body mt-2 mb-4">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                    </div>

                    <!-- Content Row -->
                    <div class="row mb-2" style="display: flex; flex-wrap: wrap;">

                        <!-- Content Column -->
                        <div class="col-lg-6 col-xl-6 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary" style="font-family: 'Cairo', sans-serif;">نسبة أعداد قطاعات الكشافة</h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="small font-weight-bold">قطاع براعم <span
                                            class="float-right">7% (112)</span></h4>
                                    <div class="progress mb-2">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 27%"
                                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">قطاع أشبال <span
                                            class="float-right">12% (192)</span></h4>
                                    <div class="progress mb-2">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 32%"
                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">قطاع زهرات <span
                                            class="float-right">5% (80)</span></h4>
                                    <div class="progress mb-2">
                                        <div class="progress-bar" role="progressbar" style="width: 25%"
                                            aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">قطاع كشافة <span
                                            class="float-right">20% (320)</span></h4>
                                    <div class="progress mb-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 40%"
                                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">قطاع متقدم <span
                                            class="float-right">18% (288)</span></h4>
                                    <div class="progress mb-2">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 38%; background-color: brown"
                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">قطاع رائدات <span
                                            class="float-right">15% (240)</span></h4>
                                    <div class="progress mb-2">
                                        <div class="progress-bar" role="progressbar" style="width: 35%; background-color: #C74EDF"
                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">قطاع جوالة <span
                                            class="float-right">17% (272)</span></h4>
                                    <div class="progress mb-2">
                                        <div class="progress-bar" role="progressbar" style="width: 37%; background-color: aqua;"
                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">قطاع القادة <span
                                            class="float-right">6% (96)</span></h4>
                                    <div class="progress mb-2">
                                        <div class="progress-bar" role="progressbar" style="width: 26%; background-color: tomato;"
                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                            <!-- Color System -->
                            <!--
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-primary text-white shadow">
                                        <div class="card-body">
                                            Primary
                                            <div class="text-white-50 small">#4e73df</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-success text-white shadow">
                                        <div class="card-body">
                                            Success
                                            <div class="text-white-50 small">#1cc88a</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-info text-white shadow">
                                        <div class="card-body">
                                            Info
                                            <div class="text-white-50 small">#36b9cc</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-warning text-white shadow">
                                        <div class="card-body">
                                            Warning
                                            <div class="text-white-50 small">#f6c23e</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-danger text-white shadow">
                                        <div class="card-body">
                                            Danger
                                            <div class="text-white-50 small">#e74a3b</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-secondary text-white shadow">
                                        <div class="card-body">
                                            Secondary
                                            <div class="text-white-50 small">#858796</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-light text-black shadow">
                                        <div class="card-body">
                                            Light
                                            <div class="text-black-50 small">#f8f9fc</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-dark text-white shadow">
                                        <div class="card-body">
                                            Dark
                                            <div class="text-white-50 small">#5a5c69</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
-->
                        <div class="col-lg-6 col-xl-6 mb-4">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="mb-3 card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary" style="font-family: 'Cairo', sans-serif;">رسم توضيحي لأعداد وأنواع القادة</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart2"></canvas>
                                    </div>
                                    <div class="mt-4 small" style="text-align: center;">
                                        <span class="">
                                            <a>سواعد</a>
                                            <i class="fas fa-circle" style="color: #e74a3b;"></i>
                                        </span>
                                        <span class="">
                                            <a>مساعد قائد</a>
                                            <i class="fas fa-circle" style="color: #f6c23e;"></i>
                                        </span>
                                        <span class="">
                                            <a>قائد فريق</a>
                                            <i class="fas fa-circle" style="color: #2e59d9;"></i>
                                        </span>
                                            <span class="">
                                            <a>قائد قطاع</a>
                                            <i class="fas fa-circle" style="color: #F30E66;"></i>
                                        </span>
                                        <br>
                                        <span>
                                            <a>قائد عام</a>
                                            <i class="fas fa-circle" style="color: #36b9cc;"></i>
                                        </span>
                                        <span class="">
                                            <a>نائب قائد عام</a>
                                            <i class="fas fa-circle" style="color: #1cc88a;"></i>
                                        </span>
                                        <br>
                                        <span class="">
                                            <a>مجلس الصخرة</a>
                                            <i class="fas fa-circle" style="color: #C74EDF;"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    <div>
                        <div class="row">
                        <div class="card shadow mb-4 ml-4" >
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary" style="font-family: 'Cairo', sans-serif;">المعسكرات والأيام الكشفية</h6>
                                </div>
                                <div class="card-body">
                                    <div class="rtl" style="text-align: right;">
                                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 34rem;"
                                            src={{ asset("img/camping.jpeg" )}} alt="...">
                                    </div>
                                    <a  target="_blank" rel="nofollow" href={{ url('/person') }}>الدخول إلى تقارير المعسكرات الكشفية &rarr;</a>
                                </div>
                            </div>
                            <!-- Illustrations -->
                            <div class="card shadow mb-4 ml-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary" style="font-family: 'Cairo', sans-serif;">تقارير الملتحقين</h6>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <img class="img-fluid mt-3 mb-4 pt-5" style="width: 34rem;"
                                            src={{ asset("img/undraw_posting_photo.svg" )}} alt="...">
                                    </div>
                                    <a  target="_blank" rel="nofollow" href={{ url('/person') }}>الدخول إلى قوائم تقارير الملتحقين &rarr;</a>
                                </div>
                            </div>
                            
                        </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Athanasius Scouts 2023</span>
                        <br />
                        <span style="font-size: larger;font-weight: bold; color: #4e73df;">Robeir S. George</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href={{ url('/login') }}>Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script src="js/demo/chart-pie-demo2.js"></script>

</body>

</html>