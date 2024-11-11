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
            <a class="navbar-brand h1" href="index.html">
                <img src="asset/img/logo.png" alt="Logo" class="img-fluid" style="width: 150px; max-height: 150px;">
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
              
              <!-- قائمة الإشعارات -->
              
              
              <!-- قائمة حساب المستخدم -->
              <div class="dropdown-menu" id="dropdownMenu">
                  <div class="dropdown-header">
                      {{ __('مرحبا  ') }} {{ Auth::user()->name }} {{ __('!') }}
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
              
                      // دالة لتصفير العداد عند قراءة الإشعارات
                     
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

    <div class="container mt-4 bg-light">
        <h1 class="mb-4 text-center">مفضلاتي</h1>
    
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
    
        @if($favorites->isEmpty())
            <p>لا يوجد مفضلات لديك.</p>
        @else
            <div class="row">
                @foreach($favorites as $favorite)
                    @php
                        $favoritable = $favorite->favoritable;
                    @endphp
        
                    @if($favoritable)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title text-primary">{{ $favoritable->subService->name }}</h5>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">{{ $favoritable->description }}</p>
                                    <p class="card-text text-primary">السعر: {{ number_format($favoritable->price, 2) }}</p>
                                    
                                    <!-- إذا كنت تريد إضافة زر لحذف من المفضلات -->
                                    <form action="{{ route('favorites.destroy', $favorite->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">إزالة من المفضلات</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
    
    <!-- إضافة مكتبة jQuery و Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('.cancel-btn').click(function() {
                const bookingId = $(this).data('id');
                const $row = $(`#booking-${bookingId}`);
    
                $.ajax({
                    url: `/booking/${bookingId}/cancel`,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        console.log('Server Response:', data);
                        if (data.message === 'تم إلغاء من بنجاح') {
                            $row.find('.status').text('ملغي');
                            $row.find('.cancel-btn').remove();
                        } else {
                            alert('حدث خطأ أثناء إلغاء الحجز: ' + data.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', xhr, status, error);
                        alert('حدث خطأ أثناء إلغاء الحجز: ' + xhr.responseText);
                    }
                });
            });
        });
    </script>
    
    
    
    <!-- end slider section -->
  </div>




<br><br><br>
  
  <script type="text/javascript" src="{{ asset('website/js/jquery-3.4.1.min.js') }}"></script>
  <!-- popper js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <!-- bootstrap js -->
  <script type="text/javascript" src="{{ asset('website/js/bootstrap.js') }}"></script>
  <!-- owl slider -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <!-- custom js -->
  <script type="text/javascript" src="{{ asset('website/js/custom.js') }}"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
  </script>
  <!-- End Google Map -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->

@livewireScripts
</body>

</html>