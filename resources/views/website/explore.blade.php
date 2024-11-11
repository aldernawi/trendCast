<!DOCTYPE html>
<html lang="en">

<head>
    <title>TrendCast</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="asset/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="asset/img/mm.png">
    <!-- Load Require CSS -->
    <link href="asset/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font CSS -->
    <link href="asset/css/boxicon.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Load Tempalte CSS -->
    <link rel="stylesheet" href="asset/css/templatemo.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="asset/css/custom.css">
    <style>
          .tajawal-extralight {
      font-family: "Tajawal", sans-serif;
      font-weight: 200;
      font-style: normal;
    }

    .tajawal-light {
      font-family: "Tajawal", sans-serif;
      font-weight: 300;
      font-style: normal;
    }

    .tajawal-regular {
      font-family: "Tajawal", sans-serif;
      font-weight: 400;
      font-style: normal;
    }

    .tajawal-medium {
      font-family: "Tajawal", sans-serif;
      font-weight: 500;
      font-style: normal;
    }

    .tajawal-bold {
      font-family: "Tajawal", sans-serif;
      font-weight: 700;
      font-style: normal;
    }

    .tajawal-extrabold {
      font-family: "Tajawal", sans-serif;
      font-weight: 800;
      font-style: normal;
    }

    .tajawal-black {
      font-family: "Tajawal", sans-serif;
      font-weight: 900;
      font-style: normal;
    }
    </style>
<!--
    
TemplateMo 561 Purple Buzz

https://templatemo.com/tm-561-purple-buzz

-->
</head>

<body class="tajawal-bold">
    <!-- Header -->
    <nav id="main_nav" class="navbar navbar-expand-lg navbar-light bg-white shadow">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="align-items-center  ">
            <a class="navbar-brand h1" href="">
                <img src="{{asset('./asset/img/logo.png')}}" alt="Logo" class="img-fluid" style="width: 150px; max-height: 150px;">
            </a>
        </div>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-toggler-success" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="navbar-toggler-success">
                <div class="flex-fill mx-xl-5 mb-2">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-xl-5 text-center text-dark">
                        <li class="nav-item">
                            <a class="nav-link btn-outline-primary rounded-pill " href="{{ route('home') }}">الرئيسية</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-outline-primary rounded-pill" href="#footer">تواصل معنا</a>
                        </li>
                        @if(Auth::user())
                        <li class="nav-item">
                            <a class="nav-link btn-outline-primary rounded-pill" href="{{ route('allUsers') }}">شركائنا</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-outline-primary rounded-pill" href="{{ route('messages.index') }}">المراسلات</a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link btn-outline-primary rounded-pill" href="{{ route('allUsers') }}">شركائنا</a>
                        </li>
                     @endif
                    </ul>
                </div>
                @if(Auth::user())
                <div class="navbar align-self-center d-flex">
                  <!-- أيقونة الإشعارات -->
                    <!-- أيقونة الإشعارات -->
                    <a class="nav-link" href="#" id="notificationTrigger">
                        <i class='bx bx-bell bx-sm bx-tada-hover text-primary'></i>
                        @if(Auth::user()->notifications->where('is_read', false)->count() > 0)
                        <span class="badge badge-danger text-secondary" id="notificationCount">
                            {{ Auth::user()->notifications->where('is_read', false)->count() }}
                        </span>
                        @endif
                    </a>
                    
                    <div class="dropdown-menu" id="notificationMenu">
                        <div class="dropdown-header">
                            إشعاراتي
                        </div>
                        @foreach(Auth::user()->notifications as $notification)
                        <a href="{{route('client.bookings')}}" id="notification-{{ $notification->id }}" class="dropdown-item {{ $notification->is_read ? 'bg-secondary' : 'bg-info' }}">
                            {{ $notification->message }}
                        </a>
                        @endforeach
                        @if(Auth::user()->notifications->isEmpty())
                        <div class="dropdown-item">
                            لا توجد إشعارات جديدة
                        </div>
                        @endif
                    </div>
                    <script>
                        $(document).ready(function() {
                            $('#notificationTrigger').click(function() {
                                $.ajax({
                                    url: '{{ route("notifications.markAllAsRead") }}',
                                    method: 'POST',
                                    data: {
                                        _token: '{{ csrf_token() }}'
                                    },
                                    return :1;
                                    success: function(response) {
                                        if (response.status === 'success') {
                                            // تقليل عدد الإشعارات غير المقروءة
                                            $('#notificationCount').text('0');
                                            
                                            $('#notificationMenu .dropdown-item').each(function() {
                                                $(this).removeClass('bg-info').addClass('bg-secondary');
                                            });
                                        }
                                    }
                                });
                            });
                        });
                    </script>
                  <!-- أيقونة المستخدم -->
                  <a class="nav-link" href="#" id="dropdownTrigger">
                      <i class='bx bx-user-circle bx-sm text-primary'></i>
                  </a>
              </div>
              
             
              <div class="dropdown-menu" id="dropdownMenu">
                  <div class="dropdown-header">
                      {{ __('مرحبا  ') }}
                  </div>
                  <a href="{{ route('profile.show') }}" class="dropdown-item">{{ __('الملف الشخصي') }}</a>
                  <a href="{{ route('favorites.index') }}" class="dropdown-item">{{ __('مفضلاتي') }}</a>
                  <a href="{{ route('client.bookings') }}" class="dropdown-item">{{ __('حجوزاتي') }}</a>
                  @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                  <a href="{{ route('api-tokens.index') }}" class="dropdown-item">{{ __('API Tokens') }}</a>
                  @endif
                  <div class="divider"></div>
                  <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                      @csrf
                      <a href="#" class="dropdown-item" id="logoutButton">{{ __('تسجيل الخروج') }}</a>
                  </form>
              </div>
              
              <script>
                  document.addEventListener('DOMContentLoaded', function() {
                      const notificationTrigger = document.getElementById('notificationTrigger');
                      const notificationMenu = document.getElementById('notificationMenu');
                      const notificationCount = document.getElementById('notificationCount');
                      const dropdownTrigger = document.getElementById('dropdownTrigger');
                      const dropdownMenu = document.getElementById('dropdownMenu');
                      const logoutButton = document.getElementById('logoutButton');
                      const logoutForm = document.getElementById('logoutForm');
              
                      // تشغيل القائمة المنسدلة للإشعارات
                      notificationTrigger.addEventListener('click', function(event) {
                          event.preventDefault();
                          notificationMenu.classList.toggle('show');
                          dropdownMenu.classList.remove('show'); // إغلاق قائمة المستخدم إذا كانت مفتوحة
              
                          // تصفير العداد عند فتح قائمة الإشعارات
                          
                      });
              
                      // تشغيل القائمة المنسدلة للمستخدم
                      dropdownTrigger.addEventListener('click', function(event) {
                          event.preventDefault();
                          dropdownMenu.classList.toggle('show');
                          notificationMenu.classList.remove('show'); // إغلاق قائمة الإشعارات إذا كانت مفتوحة
                      });
              
                      // تشغيل تسجيل الخروج عند النقر على الرابط
                      logoutButton.addEventListener('click', function(event) {
                          event.preventDefault();
                          logoutForm.submit();
                      });
              
                      // إغلاق القوائم عند النقر خارجها
                      document.addEventListener('click', function(event) {
                          if (!notificationTrigger.contains(event.target) && !notificationMenu.contains(event.target)) {
                              notificationMenu.classList.remove('show');
                          }
                          if (!dropdownTrigger.contains(event.target) && !dropdownMenu.contains(event.target)) {
                              dropdownMenu.classList.remove('show');
                          }
                      });
                  });                     
              </script>
              
              
              @else
              <div class="align-items-center justify-content-end d-flex">
                <a href="{{ route('login') }}" class="btn btn-outline-white" id="loginButton">تسجيل الدخول</a>
              </div>
              @endif
              
              
            </div>
        </div>
    </nav>
    <!-- Close Header -->


    <!-- Start Banner Hero -->
   

    <!-- End Banner Hero -->
    <style>
        .fixed-img-size {
          width: 100%;
          height: 350px; /* تحديد ارتفاع الصورة */
          object-fit: cover; /* لضبط الصورة داخل الحجم المحدد */
        }
      
        .row {
          row-gap: 30px; /* إضافة فراغ بين الصفوف */
        }
      </style>
      
      <section class="section bg-light" dir="rtl" id="companies-freelancers">
        <div class="section section-5 bg-light">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-6 mb-5">
                        <h2 class="font-weight-bold heading text-primary ">
                            ابرز الشركات والمستقلين لدينا
                        </h2>
                        <p class="text-black-50">
                            اكتشف مجموعة متنوعة من الشركات والمستقلين الذين يقدمون خدمات مميزة ويضمنون لك أفضل تجربة.
                        </p>
                    </div>
                </div>
                <div class="row">
                    @foreach($users as $user)
                        <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0">
                            <a href="#" class="text-decoration-none text-dark">
                                <div class="h-100 person">
                                    <img src="{{asset('profile-images/'. $user->image)}}" alt="Image for {{ $user->name }}" class="img-fluid mb-0 fixed-img-size" />
                                    <div class="person-contents">
                                        <h2 class="mb-4 tajawal-bold">{{ $user->name }}</h2>
                                        <p>{{ $user->description }}</p>
                                        <div class="text-center">
                                            <a href="{{route('profile.index', $user->id)}}" class="btn btn-primary text-white py-3 px-4 mt-3 w-100">التفاصيل</a>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    
 
    <!-- Start Footer -->
    <footer class="bg-secondary pt-4" id="footer">
        <div class="container">
            <div class="row py-4">
                <!-- القسم الأول: معلومات الشركة (يمين) -->
                <div class="col-lg-3 col-md-4 mb-4">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <i class='bx bx-buildings bx-sm text-light'></i>
                        <span class="text-light h5">TrendCast</span>
                    </a>
                    <p class="text-light my-lg-4 my-2">
                        جسر التواصل مع الشركات  والمستقلين
                    </p>
                    
                </div>
                
                <!-- القسم الثاني: اختصارات رئيسية (وسط) -->
                <div class="col-lg-3 col-md-4 mb-4 mx-auto">
                    <h3 class="h4 pb-lg-3 text-light light-300">اختصارات رئيسية</h3>
                    <ul class="list-unstyled text-light light-300">
                        <li class="pb-2">
                            <i class='bx-fw bx bxs-chevron-right bx-xs'></i><a class="text-decoration-none text-light" href="{{ route('home') }}">الرئيسية</a>
                        </li>
                        <li class="pb-2">
                            <i class='bx-fw bx bxs-chevron-right bx-xs'></i><a class="text-decoration-none text-light py-1" href="{{ route('allUsers') }}">شركائنا</a>
                        </li>
                        <li class="pb-2">
                            <i class='bx-fw bx bxs-chevron-right bx-xs'></i><a class="text-decoration-none text-light py-1" href="">اتصل بنا</a>
                        </li>
                    </ul>
                </div>
                
                <!-- القسم الثالث: معلومات الاتصال (يسار) -->
                <div class="col-lg-3 col-md-4 mb-4">
                    <h3 class="h4 pb-lg-3 text-light light-300">معلومات الاتصال</h3>
                    <ul class="list-unstyled text-light light-300">
                        <li class="pb-2">
                            <i class='bx-fw bx bx-phone bx-xs'></i><a class="text-decoration-none text-light py-1" href="tel:09123456789">09123456789</a>
                        </li>
                        <li class="pb-2">
                            <i class='bx-fw bx bx-mail-send bx-xs'></i><a class="text-decoration-none text-light py-1" href="mailto:TrendCast@company.com">TrendCast@company.com</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    
        <div class="w-100 bg-primary py-3 text-center">
            <div class="container">
                <p class="text-center text-light light-300">
                    كل الحقوق محفوظة لـ <a class="text-white" rel="sponsored" href="{{ route('home') }}" target="_blank">TrendCast</a>
                </p>
            </div>
        </div>
    </footer>
    <!-- End Footer -->


    <!-- Bootstrap -->
    <script src="asset/js/bootstrap.bundle.min.js"></script>
    <!-- Lightbox -->
    <script src="asset/js/fslightbox.js"></script>
    <script>
        fsLightboxInstances['gallery'].props.loadOnlyCurrentSource = true;
    </script>
    <!-- Load jQuery require for isotope -->
    <script src="asset/js/jquery.min.js"></script>
    <!-- Isotope -->
    <script src="asset/js/isotope.pkgd.js"></script>
    <!-- Page Script -->
    <script>
        $(window).load(function() {
            // init Isotope
            var $projects = $('.projects').isotope({
                itemSelector: '.project',
                layoutMode: 'fitRows'
            });
            $(".filter-btn").click(function() {
                var data_filter = $(this).attr("data-filter");
                $projects.isotope({
                    filter: data_filter
                });
                $(".filter-btn").removeClass("active");
                $(".filter-btn").removeClass("shadow");
                $(this).addClass("active");
                $(this).addClass("shadow");
                return false;
            });
        });
    </script>
    <!-- Templatemo -->
    <script src="asset/js/templatemo.js"></script>
    <!-- Custom -->
    <script src="asset/js/custom.js"></script>

</body>

</html>