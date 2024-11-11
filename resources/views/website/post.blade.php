<!DOCTYPE html>
<html lang="en">

<head>
    <title>المنشور</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="asset/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="asset/img/mm.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Load Require CSS -->
    <link href="{{ asset('./asset/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font CSS -->
    <link href="{{ asset('./asset/css/boxicon.min.css') }}" rel="stylesheet">
    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">

    <!-- Load Tempalte CSS -->
    <link rel="stylesheet" href="{{ asset('./asset/css/templatemo.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('./asset/css/custom.css') }}">
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



    <!-- Start Work Sigle -->
    <section class="container py-5">

        <div class="row pt-5">
            <div class="worksingle-content col-lg-8 m-auto text-left">
                <div class="d-flex align-items-center justify-content-between">
                    <h2 class="worksingle-heading h3 pb-3 light-300 typo-space-line mb-0">{{ $posts->title }}</h2>
                    <button id="btn-report-post" class="btn btn-primary">الإبلاغ</button>
                </div>
                <p class="worksingle-footer py-3 text-muted light-300 mt-3">
                    {{ $posts->description }}
                </p>
            </div>
        </div><!-- End Blog Cover -->
        

        <div class="container mt-4">
            <div class="row justify-content-center pb-4">
                <div class="col-lg-8">
                    <!-- Main Image Display -->
                    <div class="card mb-3">
                        <img id="main-image" class="main-image img-fluid border rounded" src="{{ asset('post-images/' . $posts->images->first()->path) }}" alt="Main Image">
                    </div>
                    <!-- Thumbnails -->
                    <div class="thumbnail-container">
                        <!-- Scroll Buttons -->
                        <div class="thumbnail-wrapper">
                            @foreach($posts->images as $image)
                            <img class="thumbnail img-thumbnail border rounded" src="{{ asset('post-images/' . $image->path) }}" alt="Thumbnail Image" data-src="{{ asset('post-images/' . $image->path) }}">
                            @endforeach
                        </div>
                    </div>
                    <!-- Controls -->
                    <div class="d-flex justify-content-between mt-3">
                        <button id="prev-button" class="btn btn-secondary text-white">السابق</button>
                        <button id="next-button" class="btn btn-secondary text-white">التالي</button>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script>
            $(document).ready(function() {
                let currentIndex = 0;
                const images = $('.thumbnail');
                const mainImage = $('#main-image');
                const wrapper = $('.thumbnail-wrapper');
                const containerWidth = $('.thumbnail-container').width();
                const thumbnailWidth = images.first().outerWidth(true); // بما في ذلك الهوامش
        
                // Function to update main image
                function updateMainImage(index) {
                    const src = images.eq(index).data('src');
                    mainImage.attr('src', src);
                    images.removeClass('active-thumbnail');
                    images.eq(index).addClass('active-thumbnail');
                    currentIndex = index;
                }
        
                // Click event on thumbnails
                $('.thumbnail').click(function() {
                    const index = $(this).index();
                    updateMainImage(index);
                });
        
                // Next button
                $('#next-button').click(function() {
                    let nextIndex = (currentIndex + 1) % images.length;
                    updateMainImage(nextIndex);
                });
        
                // Previous button
                $('#prev-button').click(function() {
                    let prevIndex = (currentIndex - 1 + images.length) % images.length;
                    updateMainImage(prevIndex);
                });
        
          
            });
        </script>

        
        
  <style>
        .thumbnail {
            cursor: pointer;
            border: 2px solid transparent;
            width: 250px; /* حجم الصورة المصغرة */
            height: auto;
            margin-right: 10px; /* المسافة بين الصور المصغرة */
        }
        .thumbnail:hover {
            border-color: #007bff;
        }
        .active-thumbnail {
            border-color: #007bff;
        }
        .main-image {
            width: 100%;
            height: auto;
        }
        .thumbnail-container {
            position: relative;
            overflow: hidden; /* لإخفاء المحتوى الزائد */
            white-space: nowrap; /* منع تكسير الأسطر للصور */
        }
        .thumbnail-wrapper {
            display: inline-flex; /* استخدام inline-flex لتجنب المشاكل مع التمرير */
            transition: transform 0.5s ease; /* تأثير التحريك */
        }
        .btn {
            width: 100px;
        }
    </style>
        <!-- End Slider -->

        <!-- End Work Sigle -->

        <div class="row justify-content-center">
            <div class="worksingle-comment-heading col-8 m-auto pb-3">
                <h4 class="h5">التعليقات</h4>
            </div>
        </div>
        
        @foreach($comments as $comment)
        <div class="row pb-4">
            <div class="worksingle-comment-body col-md-8 m-auto">
                <div class="d-flex">
                    <div>
                        <img class="rounded-circle" src="{{ asset('profile-images/' . $comment->user->image) }}" style="width: 50px;">
                    </div>
                    <div class="comment-body">
                        <div class="comment-header d-flex justify-content-between ms-3">
                            <div class="header text-start">
                                <h5 class="h6">{{ $comment->user->name }}</h5>
                                <p class="text-muted light-300">{{ $comment->created_at }}</p>
                            </div>
                            <div class="header text-end">
                                @if ($comment->user_id == auth()->id())
                                    <button class="btn text-primary btn-sm btn-edit-comment px-3 pb-3" data-id="{{ $comment->id }}">تعديل</button>
                                    <button class="btn text-danger btn-sm btn-delete-comment px-3 pb-3 " data-id="{{ $comment->id }}">حذف</button>
                                @endif
                            </div>
                        </div>
                        <div class="footer">
                            <div class="card-body border ms-3 light-300">
                                {{ $comment->comment }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        
        <div class="row justify-content-center mt-4 py-0">
            <div class="col-8">
                <button id="btn-add-comment" class="btn btn-primary w-25">اضافة تعليق</button>
            </div>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function() {
                // Add comment
                $('#btn-add-comment').click(function() {
                    Swal.fire({
                        title: 'اضافة تعليق جديد',
                        input: 'textarea',
                        inputLabel: 'تعليقك',
                        inputPlaceholder: 'اكتب تعليقك...',
                        showCancelButton: true,
                        confirmButtonText: 'اضافة',
                        cancelButtonText: 'الغاء',
                        preConfirm: (comment) => {
                            if (!comment) {
                                Swal.showValidationMessage('يرجى كتابة تعليق');
                                return;
                            }
                            const postId = "{{ $posts->id }}"; // Pass the postId from Blade to JavaScript
                            return fetch(`/comments/${postId}`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                body: JSON.stringify({ comment })
                            }).then(response => {
                                if (!response.ok) {
                                    throw new Error('هناك خطأ ما');
                                }
                                return response.json();
                            }).catch(error => {
                                Swal.showValidationMessage(`Request failed: ${error.message}`);
                            });
                        }
                    }).then((result) => {
                        if (result.isConfirmed && result.value.success) {
                            Swal.fire('تم اضافة التعليق!', 'تم اضافة تعليقك بنجاح.', 'success').then(() => {
                                location.reload();
                            });
                        } else if (result.isConfirmed) {
                            Swal.fire('Error!', 'There was an error adding your comment.', 'error');
                        }
                    });
                });
        
                // Edit comment
                $('.btn-edit-comment').click(function() {
                    const commentId = $(this).data('id');
                    const commentText = $(this).closest('.comment-body').find('.card-body').text().trim();
                    Swal.fire({
                        title: 'تعديل التعليق',
                        input: 'textarea',
                        inputLabel: 'تعليقك',
                        inputPlaceholder: 'اكتب تعليقك...',
                        inputValue: commentText,
                        showCancelButton: true,
                        confirmButtonText: 'حفظ',
                        cancelButtonText: 'الغاء',
                        preConfirm: (comment) => {
                            return fetch(`/comments/${commentId}`, {
                                method: 'PUT',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                body: JSON.stringify({ comment })
                            }).then(response => {
                                if (!response.ok) {
                                    throw new Error('هناك خطأ ما');
                                }
                                return response.json();
                            }).catch(error => {
                                Swal.showValidationMessage(`Request failed: ${error.message}`);
                            });
                        }
                    }).then((result) => {
                        if (result.isConfirmed && result.value.success) {
                            Swal.fire('تم تحديث التعليق!', 'تم تحديث التعليق بنجاح.', 'success').then(() => {
                                location.reload();
                            });
                        } else if (result.isConfirmed) {
                            Swal.fire('Error!', 'There was an error updating your comment.', 'error');
                        }
                    });
                });
        
                // Delete comment
                $('.btn-delete-comment').click(function() {
                    const commentId = $(this).data('id');
                    Swal.fire({
                        title: 'هل أنت متأكد من حذف التعليق؟',
                        text: "لا يمكن التراجع عن هذا!",
                        icon: 'warning',
                        cancelButtonText: 'الغاء',
                        confirmButtonColor: '#6266ea',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'نعم, حذف التعليق',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/comments/${commentId}`, {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            }).then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            }).then(data => {
                                Swal.fire('تم الحذف!', 'تم حذف تعليقك.', 'success').then(() => {
                                    location.reload();
                                });
                            }).catch(error => {
                                Swal.fire('خطأ!', 'حدث خطأ أثناء حذف تعليقك.', 'error');
                            });
                        }
                    });
                });
            });
        </script>
        

    </section>
    <!-- End Work Sigle -->



    <!-- Start Footer -->
    <footer class="bg-secondary pt-4">
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
    <script>
        $(document).ready(function() {
            $('#btn-report-post').click(function() {
                Swal.fire({
                    title: 'الإبلاغ عن المنشور',
                    input: 'textarea',
                    inputLabel: 'سبب الإبلاغ',
                    inputPlaceholder: 'اكتب سبب الإبلاغ...',
                    showCancelButton: true,
                    confirmButtonText: 'إبلاغ',
                    cancelButtonText: 'إلغاء',
                    preConfirm: (reason) => {
                        if (!reason) {
                            Swal.showValidationMessage('يرجى كتابة سبب الإبلاغ');
                            return;
                        }
                        
                        const postId = "{{ $posts->id }}"; // تمرير معرف المنشور من Blade إلى JavaScript
                        // إرسال الطلب باستخدام AJAX
                        return fetch(`/reports/${postId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            body: new URLSearchParams({
                                'reason': reason
                            })
                        }).then(response => {
                            if (response.ok) {
                                return response.json(); // نتوقع أن نعود برد JSON
                            } else {
                                throw new Error('حدث خطأ في إرسال التقرير');
                            }
                        }).then(data => {
                            Swal.fire('تم الإبلاغ!', data.message, 'success');
                        }).catch(error => {
                            Swal.fire('خطأ!', `حدث خطأ أثناء إرسال تقريرك: ${error.message}`, 'error');
                        });
                    }
                });
            });
        });
    </script>
    <button id="btn-report-post" class="btn btn-primary">الإبلاغ</button>
    

    <!-- Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{asset('./asset/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Lightbox -->
    <script src="{{asset('./asset/js/fslightbox.js')}}"></script>
    <script>
        fsLightboxInstances['gallery'].props.loadOnlyCurrentSource = true;
    </script>
    <!-- Load jQuery require for isotope -->
    <script src="{{asset('./asset/js/jquery.min.js')}}"></script>
    <!-- Isotope -->
    <script src="{{asset('./asset/js/isotope.pkgd.js')}}"></script>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('./asset/js/templatemo.js')}}"></script>
    <!-- Custom -->
    <script src="{{asset('./asset/js/custom.js')}}"></script>

</body>

</html>