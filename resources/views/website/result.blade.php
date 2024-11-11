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
      
  {{-- التحقق مما إذا كانت هناك عملية بحث أم لا --}}
@php
$hasSearchResults = isset($query) && !$query->isEmpty();
@endphp

{{-- عرض قسم البحث فقط إذا كانت هناك نتائج --}}
@if($hasSearchResults)
<article class="container-fluid bg-light">
    <div class="container">
        <div class="worksingle-related-header row">
            <h1 class="col-md-12 text-center tajawal-bold text-secondary">نتائج البحث</h1>
            <p class="col-md-12 text-center text-dark pb-5"> 
                "تصفح الخدمات المتاحة بناءً على معايير البحث الخاصة بك"
            </p>
            <div class="col-md-12 text-center">
                <div class="row gx-5">
                    @foreach($query as $result)
                    <div class="col-sm-6 col-lg-4 mb-5">
                        <div class="related-content border rounded text-decoration-none overflow-hidden h-100 shadow-lg" style="border: 2px solid #6266ea;">
                            <div class="p-4 bg-light">
                                <h3 class="text-primary mb-3 tajawal-bold">{{ $result->service_name ?? 'اسم الخدمة غير متوفر' }}</h3>
                                <div class="d-flex flex-column mb-3">
                                    <p class="card-text mb-1 light-300 text-dark">
                                        <strong>مقدم الخدمة:</strong> {{ $result->name ?? 'غير متوفر' }}
                                    </p>
                                    <p class="card-text mb-1 light-300 text-dark">
                                        <strong>العنوان:</strong> {{ $result->address ?? 'غير متوفر' }}
                                    </p>
                                    <p class="card-text mb-1 light-300 text-dark">
                                        <strong>السعر:</strong> {{ $result->price ?? 'غير محدد' }} دينار ليبي
                                    </p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-primary" onclick="showBookingForm('{{ $result->user_service_detail_id }}', '{{ $result->user_id }}')">حجز الخدمة</button>
                                    <button class="btn btn-outline-primary" onclick="toggleFavorite('{{ $result->user_id }}')">
                                        <i class="bx bx-heart favorite-icon" id="service-{{ $result->user_id }}"></i> إضافة إلى المفضلة
                                    </button>
                                    <button class="btn btn-outline-primary" data-toggle="modal" data-target="#ratingModal{{ $result->user_service_detail_id }}">
                                        تقييم الخدمة
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            
            <div class="modal fade" id="ratingModal{{ $result->user_service_detail_id }}" tabindex="-1" role="dialog" aria-labelledby="ratingModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ratingModalLabel">قيم هذه الخدمة</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="rating flex justify-center mb-4" id="ratingStars{{ $result->user_service_detail_id }}">
                                <span class="star cursor-pointer text-2xl" data-value="1"><i class="bx bx-star"></i></span>
                                <span class="star cursor-pointer text-2xl" data-value="2"><i class="bx bx-star"></i></span>
                                <span class="star cursor-pointer text-2xl" data-value="3"><i class="bx bx-star"></i></span>
                                <span class="star cursor-pointer text-2xl" data-value="4"><i class="bx bx-star"></i></span>
                                <span class="star cursor-pointer text-2xl" data-value="5"><i class="bx bx-star"></i></span>
                            </div>
                            <form action="{{ route('rateService') }}" method="POST">
                                @csrf
                                <input type="hidden" name="service_id" value="{{ $result->user_service_detail_id }}" class="modalServiceId">
                                <input type="hidden" name="rating" class="ratingValue">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">إرسال التقييم</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <style>
                .star.selected {
                    color: gold;
                }
            
                .star.hover {
                    color: orange;
                }
            
                .rating .star {
                    transition: color 0.2s ease;
                }
            </style>
            <script>
                function toggleFavorite(serviceId) {
    $.ajax({
        url: '/favorites',
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            favoritable_id: serviceId,
            favoritable_type: 'App\\Models\\user_service_details'
        },
        success: function(response) {
            const icon = $(`#service-${serviceId} .favorite-icon`);
            
            if (response.status === 'exists') {
                icon.css('color', '#ffd700');
                Swal.fire({
                    icon: 'info',
                    title: 'معلومات',
                    text: 'الخدمة في المفضلة مسبقًا',
                    confirmButtonColor: '#6266ea'
                });
            } else if (response.status === 'added') {
                icon.css('color', '#ffd700');
                Swal.fire({
                    icon: 'success',
                    title: 'تمت الإضافة بنجاح',
                    text: 'تمت الإضافة إلى المفضلة بنجاح',
                    confirmButtonColor: '#6266ea'
                });
            }
        },
        error: function(xhr) {
            console.error(xhr.responseText);
            Swal.fire({
                icon: 'error',
                title: 'خطأ',
                text: 'حدث خطأ: ' + xhr.status + ' ' + xhr.statusText,
                confirmButtonColor: '#04786e'
            });
        }
    });
}
            </script>
            <script>
          function showBookingForm(serviceDetailId, companyId) {
            @if(auth()->check())
            Swal.fire({
                title: 'طلب الخدمة',
                html: `
                    <div class="bg-white p-8 rounded-md w-96">
                        <form id="bookingForm">
                            <input type="hidden" id="service_id" value="${serviceDetailId}">
                            <input type="hidden" id="company_id" value="${companyId}">
                            <p class="text-sm">
                                شكراً لاختيارك خدماتنا نأمل منك الالتزام بالشروط التالية:
                            </p>
                            <p class="text-sm text-right">
                                1. الالتزام بالدفع بعد تأكيد الحجز
                            </p>
                            <p class="text-sm text-right">
                                2. تقييم الخدمة بعد استلامها
                            </p>
                            <p class="text-sm text-right">
                                3. التعليق على المنشورات التي تُحاكي الخدمة المُختارة.
                            </p>
                            <button type="submit" class="btn btn-primary w-full mt-3">إرسال الطلب</button>
                            <button type="button" class="btn btn-outline-primary w-full mt-3" onclick="Swal.close()">إغلاق</button>
                        </form>
                    </div>
                `,
                showConfirmButton: false,
                customClass: {
                    popup: 'fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50'
                },
                didOpen: () => {
                    $('#bookingForm').on('submit', function(event) {
                        event.preventDefault();
        
                        var serviceId = $('#service_id').val();
                        var companyId = $('#company_id').val();
        
                        fetch('{{ route('booking.create') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                client_id: '{{ auth()->user()->id }}',
                                service_id: serviceId,
                                company_id: companyId
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'تم إرسال طلب الحجز بنجاح',
                                    text: 'شكراً لتقديم طلب الحجز.',
                                    confirmButtonColor: '#6266ea',
                                    showConfirmButton: false
                                });
                            } else {
                                console.error('Error details:', data);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'حدث خطأ',
                                    text: data.message || 'يرجى المحاولة لاحقاً.',
                                    confirmButtonColor: '#04786e',
                                    showConfirmButton: false
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'حدث خطأ',
                                text: error.message,
                                confirmButtonColor: '#04786e'
                            });
                        });
                    });
                }
            });
            @endif
        }
            </script>
        
            <script>
                document.addEventListener('DOMContentLoaded', () => {
    function initializeRatingStars(serviceId) {
        document.querySelectorAll(`#ratingStars${serviceId} .star`).forEach(star => {
            star.addEventListener('click', function() {
                const value = this.getAttribute('data-value');
                document.querySelectorAll(`#ratingStars${serviceId} .star`).forEach(s => {
                    if (s.getAttribute('data-value') <= value) {
                        s.classList.add('selected');
                    } else {
                        s.classList.remove('selected');
                    }
                });
                document.querySelector(`#ratingModal${serviceId} .ratingValue`).value = value;
            });

            star.addEventListener('mouseover', function() {
                const value = this.getAttribute('data-value');
                document.querySelectorAll(`#ratingStars${serviceId} .star`).forEach(s => {
                    if (s.getAttribute('data-value') <= value) {
                        s.classList.add('hover');
                    } else {
                        s.classList.remove('hover');
                    }
                });
            });

            star.addEventListener('mouseout', function() {
                document.querySelectorAll(`#ratingStars${serviceId} .star`).forEach(s => {
                    s.classList.remove('hover');
                });
            });
        });
    }

    document.querySelectorAll('[data-toggle="modal"]').forEach(button => {
        button.addEventListener('click', function() {
            const serviceId = this.getAttribute('data-target').replace('#ratingModal', '');
            initializeRatingStars(serviceId);
        });
    });
});
            </script>
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <!-- Bootstrap JS -->
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>   
            
        </div>
    </div>
</article>
@else
{{-- عرض قسم الشركات والمستقلين فقط إذا لم يكن هناك نتائج بحث --}}
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
@endif

 
    <!-- Start Footer -->
  
    <!-- End Footer -->


    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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