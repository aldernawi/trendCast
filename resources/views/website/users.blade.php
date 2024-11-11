<!DOCTYPE html>
<html lang="en">

<head>
    <title>TrendCast</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="asset/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="asset/img/mm.png">
    <!-- Load Require CSS -->
    <link href="{{ asset('./asset/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font CSS -->
    <link href="{{ asset('./asset/css/boxicon.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">

    <!-- Load Tempalte CSS -->
    <link rel="stylesheet" href="{{ asset('./asset/css/templatemo.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('./asset/css/custom.css') }}">
<!--
    
TemplateMo 561 Purple Buzz

https://templatemo.com/tm-561-purple-buzz

-->
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
</head>

<body>
    <!-- Header -->
    <nav id="main_nav" class="navbar navbar-expand-lg navbar-light bg-white shadow">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="align-items-center  ">
            <a class="navbar-brand h1" href="index.html">
               <img src="asset/img/logo.png" alt="Logo" class="img-fluid" style="width: 150px; height: 75px;">
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
                        {{ __('مرحبا') }}
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
  
    <!-- Close Header -->


    <!-- Start Banner Hero -->
    <div id="work_single_banner" class="bg-light w-100">
        <div class="container-fluid text-light d-flex justify-content-center align-items-center border-0 rounded-0 p-0 py-5">
            <div class="banner-content col-lg-8 m-lg-auto text-center py-5 px-3">
                <h1 class="banner-heading tajawal-bold h2 pb-5 typo-space-line-center"> {{ $users->name }}</<h1>
                </h1>
                <p class="h4 tajawal-bold banner-footer light-300">
{{ $users->description }}
                </p>
                <a href="{{ route('messages.index', ['user_id' => $users->id]) }}" class="btn btn-primary">
                    التواصل مع {{ $users->name }}
                </a>
                
            </div>
        </div>
    </div>
    <!-- End Banner Hero -->

    <!-- Start Work Sigle -->
   
    <!-- End Work Sigle -->

    <!-- Start Related Post -->
     <br>
    <br>
    <br>

    <article class="container-fluid bg-light">
        <div class="container">
            <div class="worksingle-related-header row">
                <h1 class="col-md-12 text-center tajawal-bold text-secondary">الخدمات التي نقدمها</h1>
                <p class="col-md-12 text-center text-dark pb-5"> 
                    "نوفر لك مجموعة متنوعة من الخدمات المتميزة التي تلبي احتياجاتك وتفوق توقعاتك"
                </p>
                <div class="col-md-12 text-left justify-content-center">
                    <div class="row gx-5">
                        @foreach($usersServices as $service)
                        <div class="col-sm-6 col-lg-4 mb-5">
                            <div class="related-content border rounded text-decoration-none overflow-hidden h-100 shadow-lg" style="border: 2px solid #6266ea;">
                                <div class="p-3 d-flex justify-content-between align-items-center bg-light">
                                    <h3 class="text-primary mb-0 tajawal-bold">{{ $service->service->name }}</h3>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex align-items-center" id="averageRating_{{ $service->id }}">
                                            @php
                                                $averageRating = app('App\Http\Controllers\RatingController')->averageRating($service->id);
                                            @endphp
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if($i <= floor($averageRating))
                                                    <i class='bx bxs-star text-warning'></i>
                                                @elseif($i == ceil($averageRating) && $averageRating % 1 !== 0)
                                                    <i class='bx bxs-star-half text-warning'></i>
                                                @else
                                                    <i class='bx bx-star text-warning'></i>
                                                @endif
                                            @endfor
                                            <span class="ms-2 text-dark small">({{ number_format($averageRating, 1) }})</span>
                                        </div>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ratingModal{{ $service->id }}">
                                            قيم الخدمة
                                        </button>
                                        </div>
                                </div>
    
                                <!-- Rating Modal -->
                       <!-- مودال التقييم -->
                       <div class="modal fade" id="ratingModal{{ $service->id }}" tabindex="-1" role="dialog" aria-labelledby="ratingModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ratingModalLabel">قيم هذه الخدمة</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="rating flex justify-center mb-4" id="ratingStars{{ $service->id }}">
                                        <span class="star cursor-pointer text-2xl" data-value="1"><i class="bx bx-star"></i></span>
                                        <span class="star cursor-pointer text-2xl" data-value="2"><i class="bx bx-star"></i></span>
                                        <span class="star cursor-pointer text-2xl" data-value="3"><i class="bx bx-star"></i></span>
                                        <span class="star cursor-pointer text-2xl" data-value="4"><i class="bx bx-star"></i></span>
                                        <span class="star cursor-pointer text-2xl" data-value="5"><i class="bx bx-star"></i></span>
                                    </div>
                                    <form action="{{ route('rateService') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="service_id" value="{{ $service->id }}" class="modalServiceId">
                                        <input type="hidden" name="rating" class="ratingValue">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">إرسال التقييم</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            // Initialize star rating logic
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
                        
                            // Add event listeners to buttons to open modals
                            document.querySelectorAll('[data-toggle="modal"]').forEach(button => {
                                button.addEventListener('click', function() {
                                    const serviceId = this.getAttribute('data-target').replace('#ratingModal', '');
                                    initializeRatingStars(serviceId);
                                });
                            });
                        });
                        </script>
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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>                        

    
                                <div class="related-body card-body p-4">
                                    <h5 class="card-title h6 m-0 tajawal-bold text-dark">{{ $service->subService->name }}</h5>
                                    <div class="d-flex justify-content-between align-items-center"> 
                                        <p class="card-text pt-2 mb-1 light-300 text-dark w-50">
                                            {{ $service->description }}
                                        </p>
                                        <p class="card-text pt-2 mb-1 light-300 text-dark"> السعر: {{ $service->price }}  د.ل</p>
                                    </div>
                                </div>
    
                                <div class="d-flex justify-content-between align-items-center pb-3">
                                    <button class="btn btn-outline-primary btn-sm d-flex align-items-center" onclick="toggleFavorite({{ $service->id }})" style="border-radius: 50px; padding: 8px 16px; transition: background-color 0.3s, color 0.3s;">
                                        <span style="font-size: 14px;">الاضافة الى المفضلات</span>
                                        <i class="bx-fw bx bx-heart me-2" id="service-{{ $service->id }}" style="color: {{ $service->is_favorite ? '#ffd700' : '#6c757d' }}; transition: color 0.3s;"></i>
                                    </button>
                                    
                                </div>
    
                                <!-- زر الحجز -->
                                @if ($users->user_type == 'Company')
                                <div class="card-footer bg-white p-3 border-top">
                                    <button class="btn btn-primary w-100" onclick="showBookingForm({{ $service->id }}, {{ $service->user_id }})">احجز الآن</button>
                                </div>
                                @endif
                                
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </article>
    
 
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
                
                // إذا كانت الخدمة مضافة بالفعل إلى المفضلة
                if (response.status === 'exists') {
                    icon.css('color', '#ffd700'); // تغيير لون الأيقونة إلى الذهبية
                    Swal.fire({
                        icon: 'info',
                        title: 'معلومات',
                        text: 'الخدمة في المفضلة مسبقًا',
                        confirmButtonColor: '#6266ea'
                    });
                } 
                // إذا تمت الإضافة بنجاح
                else if (response.status === 'added') {
                    icon.css('color', '#ffd700'); // تغيير لون الأيقونة إلى الذهبية
                    Swal.fire({
                        icon: 'success',
                        title: 'تمت الإضافة بنجاح',
                        text: 'تمت الإضافة إلى المفضلة بنجاح',
                        confirmButtonColor: '#6266ea'
                        

                    });
                }
    
                console.log(response.message); // للتصحيح
            },
            error: function(xhr) {
                console.error(xhr.responseText); // طباعة الاستجابة عند حدوث خطأ
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
function showBookingForm(serviceId, companyId) {
    @if(auth()->check())
    Swal.fire({
        title: 'طلب الخدمة',
        html: `
            <div class="bg-white p-8 rounded-md w-96">
                <form id="bookingForm">
                    <input type="hidden" id="service_id" value="${serviceId}">
                    <input type="hidden" id="company_id" value="${companyId}">
                    <!-- Add your form fields here -->
                    <p class="text-sm">
                        شكراً لاختيارك خدماتنا نأمل منّك الإلتزام بالشروط التالية : 
                    </p>
                    <p class="text-sm text-right">
                        1.   الالتزام بالدفع بعد تأكيد الحجز
                        </p>
                        <p class="text-sm text-right">
                        2.    التقييم الخدمة بعد استلامها  
                    </p>
                    <p class="text-sm text-right">
                        3.   ⁠التعليق على المنشورات التي      تُحاكي الخدمة المُختارة.   
                    </p>
                    <button type="submit" class="btn btn-primary w-full mt-3 ">إرسال الطلب</button>
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
                            showConfirmButton: false // إخفاء زر التأكيد
                        });
                    } else {
                        console.error('Error details:', data);
                        Swal.fire({
                            icon: 'error',
                            title: 'حدث خطأ',
                            text: data.message || 'يرجى المحاولة لاحقاً.',
                            confirmButtonColor: '#04786e',
                            showConfirmButton: false // إخفاء زر التأكيد
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





    
   
    <!-- End Related Post -->
     <style>
        .related-img {
    width: 100%;
    height: 350px;
    object-fit: cover; /* يضمن ملء الصورة للمنطقة المحددة بدون تشويه */
}
    </style>
    <article class="container-fluid bg-light" dir="rtl">
        <div class="container">
            <div class="worksingle-related-header row">
                <h1 class="col-md-12 text-center tajawal-bold text-secondary py-5">المنشورات الخاصة بنا</h1>
                <div class="col-md-12 text-left justify-content-center">
                    <div class="row gx-5">
    @foreach ($posts as $post)
    <div class="col-sm-6 col-lg-4 mb-5">
        <a href="{{ route('posts.home', $post->id) }}" class="related-content card text-decoration-none overflow-hidden h-100">
            @if($post->images->isNotEmpty())
            <img class="related-img card-img-top" src="{{asset('post-images/' .$post->images->first()->path)}}" alt="Card image cap">
            @endif
            <div class="related-body card-body p-4">
                <h5 class="card-title h6 m-0 semi-bold-600 text-dark"> {{ $post->title }}</h5>
                <p class="card-text pt-2 mb-1 light-300 text-dark">
{{ $post->description }}
                </p>
                <div class="d-flex justify-content-between">
                    <span class="text-primary light-300">اقرآ المزيد</span>
                    <div class="d-flex align-items-center light-300">
                        <div class="d-flex align-items-center me-3">
                            <i class='bx-fw bx bx-error text-danger'></i>
                            <span class="ms-1">{{ $post->reports->count() }}</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class='bx-fw bx bx-chat'></i>
                            <span class="ms-1">{{ $post->comments->count() }}</span>
                        </div>
                    </div>
                    
                </div>
             
            </div>
        </a>
    </div>
    @endforeach
   
</div>
                </div>
            </div>
        </div>
    </article>


    <br>
    <br>
    <br>
    <br>
    <br>
    <!-- Start Footer -->
    <footer class="bg-secondary pt-4">
        <div class="container">
            <div class="row py-4">
                <!-- القسم الأول: معلومات الشركة (يمين) -->
                <div class="col-lg-3 col-md-4 mb-4">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <i class='bx bx-buildings bx-sm text-light'></i>
                        <span class="text-light h5">{{ $users->name }}</span>
                    </a>
                    <p class="text-light my-lg-4 my-2">
                        {{ $users->description }}
                    </p>
                    <ul class="list-inline footer-icons light-300">
                        @if($users->facebook_url)
                        <li class="list-inline-item m-0">
                            <a class="text-light" target="_blank" href="{{ $users->facebook_url }}">
                                <i class='bx bxl-facebook-square bx-md'></i>
                            </a>
                        </li>
                        @endif
                        
                        @if($users->linkedin_url)
                        <li class="list-inline-item m-0">
                            <a class="text-light" target="_blank" href="{{ $users->linkedin_url }}">
                                <i class='bx bxl-linkedin-square bx-md'></i>
                            </a>
                        </li>
                        @endif
                        
                        @if($users->instagram_url)
                        <li class="list-inline-item m-0">
                            <a class="text-light" target="_blank" href="{{ $users->instagram_url }}">
                                <i class='bx bxl-instagram bx-md'></i>
                            </a>
                        </li>
                        @endif
                        
                        @if($users->twitter_url)
                        <li class="list-inline-item m-0">
                            <a class="text-light" target="_blank" href="{{ $users->twitter_url }}">
                                <i class='bx bxl-twitter bx-md'></i>
                            </a>
                        </li>
                        @endif
                    </ul>
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
    <!-- Load jQuery require for Page Script -->
    <script src="asset/js/jquery.min.js"></script>
    <!-- Page Script -->
    <script>
        $(window).load(function() {
            // Slide
            $('.templatemo-slide-link').click(function() {
                var this_href = $(this).attr('href');
                $('#templatemo-slide-link-target img').attr('src', this_href);
                return false;
            });
            // End Slide
        });
    </script>
    <!-- Templatemo -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="{{asset('./asset/js/templatemo.js')}}"></script>
    <!-- Custom -->
    <script src="{{asset('./asset/js/custom.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>