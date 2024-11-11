<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="/assets/img/mm.png">
  <title>
TrendCast
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link href="/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="/assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
  <!-- CSS Bootstrap -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

<!-- JavaScript Bootstrap (مع Popper.js) -->


</head>
                <body class="g-sidenav-show rtl  bg-gray-100">
                  <div class="min-height-300 bg-primary position-absolute w-100" ></div>
                  <aside class="sidenav bg-white  navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-end me-4 rotate-caret" id="sidenav-main">
                    <div class="sidenav-header">
                        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute start-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
                        <a class="navbar-brand m-0" href="" target="_blank">
                            <img src="/assets/img/mm.png" class="navbar-brand-img h-100" alt="main_logo">
                            <span class="me-1 font-weight-bold">TrendCast</span>
                        </a>
                    </div>
                    <hr class="horizontal dark mt-0">
                    <div class="collapse navbar-collapse px-0 w-auto" id="sidenav-collapse-main">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#" id="userManagementToggle">
                                    <div class="icon icon-shape icon-sm border-radius-md text-center ms-2 d-flex align-items-center justify-content-center">
                                        <i class="fa fa-users grid-58 text-warning text-sm opacity-10"></i>
                                    </div>
                                    <span class="nav-link-text me-1">إدارة المستخدمين</span>
                                </a>
                                <ul class="dropdown-menu text-right" id="userManagementMenu">
                                    <li>
                                        <a class="dropdown-item nav-link " href="{{ route('users.companies') }}">
                                            <i class="fa fa-building  text-warning me-2"></i> إدارة الشركات
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item nav-link" href="{{ route('users.freelancers') }}">
                                            <i class="fa fa-user-tie  text-warning me-2"></i> إدارة المستقلين
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item nav-link " href="{{ route('users.clients') }}">
                                            <i class="fa fa-user text-warning me-2"></i> إدارة العملاء
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('services.index') }}">
                                    <div class="icon icon-shape icon-sm border-radius-md text-center ms-2 d-flex align-items-center justify-content-center">
                                        <i class="fa fa-cogs text-warning text-sm opacity-10"></i>
                                    </div>
                                    <span class="nav-link-text me-1">إدارة الخدمات</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('reports') }}">
                                    <div class="icon icon-shape icon-sm border-radius-md text-center ms-2 d-flex align-items-center justify-content-center">
                                        <i class="fa fa-exclamation-triangle text-warning text-sm opacity-10"></i>
                                    </div>
                                    <span class="nav-link-text me-1">البلاغات</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('general-report') }}">
                                    <div class="icon icon-shape icon-sm border-radius-md text-center ms-2 d-flex align-items-center justify-content-center">
                                        <i class="fa fa-chart-line text-warning text-sm opacity-10"></i>
                                    </div>
                                    <span class="nav-link-text me-1">التقارير</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                
                <style>
                    .dropdown-menu {
                        display: none; /* إخفاء القائمة المنسدلة بشكل افتراضي */
                        padding: 0; /* إزالة الهوامش الداخلية */
                        margin: 0; /* إزالة الهوامش الخارجية */
                        border: none; /* إزالة الحدود */
                        background-color: transparent; /* خلفية شفافة */
                    }
                
                    .dropdown-menu.show {
                        display: block; /* عرض القائمة المنسدلة عند تفعيلها */
                         /* تحديد موضع عنصر المنسدلة على الشاشة */
                    }
                    
                    /* إزالة الهوامش بين العناصر */
                    .dropdown-item {
                        padding: 0.5rem 1rem;
                        margin: 0;
                    }
                </style>
                
                <script>
                    document.getElementById('userManagementToggle').addEventListener('click', function(event) {
                        event.preventDefault(); // منع الرابط من العمل بشكل افتراضي
                        var menu = document.getElementById('userManagementMenu');
                        menu.classList.toggle('show'); // تبديل عرض القائمة المنسدلة
                    });
                                
                </script>
                                </aside>

                
                
                
                  <main class="main-content position-relative border-radius-lg overflow-hidden">
                    <!-- Navbar -->
                    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="false">
                      <div class="container-fluid py-1 px-3">
                        <nav aria-label="breadcrumb">
                          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0">
                            <li class="breadcrumb-item text-sm ps-2"><a class="opacity-5 text-white" href="javascript:;">لوحات القيادة</a></li>
                            <li class="breadcrumb-item text-sm text-white active" aria-current="page">{{auth()->user()->user_type}}</li>
                          </ol>
                          <h6 class="font-weight-bolder text-white mb-0">{{auth()->user()->name}}</h6>
                        </nav>
                        <div class="collapse navbar-collapse mt-sm-0 mt-2 px-0" id="navbar">
                          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                            <div class="input-group">
                              <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                              <input type="text" class="form-control" placeholder="أكتب هنا...">
                            </div>
                          </div>
                          <style>
                      .dropdown-toggle:focus + .dropdown-menu {
            display: block;
        }
        .dropdown-menu {
            display: none;
            position: absolute;
            top: 70%; /* يضع القائمة المنسدلة مباشرة تحت الزر */
            left: 0; /* لضمان محاذاة القائمة مع الزر */
            margin-top: 0; /* جعل القائمة قريبة من الزر */
            z-index: 1050; /* التأكد من أن القائمة تظهر فوق العناصر الأخرى */
        }
                        </style>
                        <div class="align-items-center justify-content-end d-flex">
                          <button class="btn btn-outline-white dropdown-toggle" type="button" id="userDropdown" style="background-color:#d88d5b">
                              {{ auth()->user()->name }}
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                              <li><a class="dropdown-item bg-white" href="{{ route('profile.show') }}">الملف الشخصي</a></li>
                              <li>
                                <form method="POST" action="{{ route('logout') }}" class="dropdown-item bg-white">
                                  @csrf
                                  @method('POST')
                                  <button type="submit" class="btn">تسجيل الخروج</button>
                                </form>
                          </li>
                          </ul>
                      </div>
                      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
                      <script>
                          document.addEventListener('DOMContentLoaded', function () {
                              var dropdownToggle = document.getElementById('userDropdown');
                              var dropdownMenu = dropdownToggle.nextElementSibling;
                              
                              dropdownToggle.addEventListener('click', function () {
                                  dropdownMenu.style.display = (dropdownMenu.style.display === 'block') ? 'none' : 'block';
                              });
                  
                              document.addEventListener('click', function (event) {
                                  if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
                                      dropdownMenu.style.display = 'none';
                                  }
                              });
                  
                              dropdownMenu.addEventListener('click', function () {
                                  dropdownMenu.style.display = 'none';
                              });
                          });
                      </script>
                        </div>
                      </div>
                    </nav>
                  
                    
                    <!-- End Navbar -->
                    <div class="container-fluid py-4">
                      
                     @yield('content')
                    
                    </div>
                   
                  </main>
              

                 
                  <!--   Core JS Files   -->

                  <script src="/assets/js/core/popper.min.js"></script>
                  <script src="/assets/js/core/bootstrap.min.js"></script>
                  <script src="/assets/js/plugins/perfect-scrollbar.min.js"></script>
                  <script src="/assets/js/plugins/smooth-scrollbar.min.js"></script>
                  <script src="/assets/js/plugins/chartjs.min.js"></script>
                  <script>
                    var ctx1 = document.getElementById("chart-line").getContext("2d");
                
                    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);
                
                    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
                    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
                    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
                    new Chart(ctx1, {
                      type: "line",
                      data: {
                        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                        datasets: [{
                          label: "Mobile apps",
                          tension: 0.4,
                          borderWidth: 0,
                          pointRadius: 0,
                          borderColor: "#5e72e4",
                          backgroundColor: gradientStroke1,
                          borderWidth: 3,
                          fill: true,
                          data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                          maxBarThickness: 6
                
                        }],
                      },
                      options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                          legend: {
                            display: false,
                          }
                        },
                        interaction: {
                          intersect: false,
                          mode: 'index',
                        },
                        scales: {
                          y: {
                            grid: {
                              drawBorder: false,
                              display: true,
                              drawOnChartArea: true,
                              drawTicks: false,
                              borderDash: [5, 5]
                            },
                            ticks: {
                              display: true,
                              padding: 10,
                              color: '#fbfbfb',
                              font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                              },
                            }
                          },
                          x: {
                            grid: {
                              drawBorder: false,
                              display: false,
                              drawOnChartArea: false,
                              drawTicks: false,
                              borderDash: [5, 5]
                            },
                            ticks: {
                              display: true,
                              color: '#ccc',
                              padding: 20,
                              font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                              },
                            }
                          },
                        },
                      },
                    });
                  </script>
                  <script>
                    var win = navigator.platform.indexOf('Win') > -1;
                    if (win && document.querySelector('#sidenav-scrollbar')) {
                      var options = {
                        damping: '0.5'
                      }
                      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
                    }
                  </script>
                  <!-- Github buttons -->
                  <script async defer src="https://buttons.github.io/buttons.js"></script>
                  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
                  <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>
                </body>
                
                </html>
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
                  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
        </div>
    </body>
</html>
