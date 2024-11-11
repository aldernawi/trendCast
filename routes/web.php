<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubServiceController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserServiceController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RatingController;
use App\Http\Livewire\Messages;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NotificationController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'main']);
Route::get('/search', [HomeController::class, 'search'])->name('search');
//allUsers
Route::get('/allUsers', [HomeController::class, 'allUsers'])->name('allUsers');
Route::get('/profile/{id}', [App\Http\Controllers\HomeController::class, 'services'])->name('profile.index');

// للتحقق من نوع مستخدم معين

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    ])->group(function () {

        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/posts/{id}', [App\Http\Controllers\HomeController::class, 'posts'])->name('posts.home');

Route::get('/general-report', [App\Http\Controllers\HomeController::class, 'reports'])->name('general-report');

//companyReport
Route::get('/company-report', [App\Http\Controllers\HomeController::class, 'companyReport'])->name('company-report');

//users
Route::get('/companies', [UserController::class, 'index'])->name('users.companies');
Route::get('/freelancers', [UserController::class, 'index1'])->name('users.freelancers');
Route::get('/clients', [UserController::class, 'index2'])->name('users.clients');
route::post('/users/store', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
Route::post('/users/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
route::delete('/users/destroy/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
Route::post('/users/{id}/activate', [UserController::class, 'activate'])->name('users.activate');
Route::patch('/users/{id}/update-status', [UserController::class, 'updateStatus']);



//services


// صفحة عرض الخدمات
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');

// صفحة عرض الخدمات الفرعية لكل خدمة
Route::get('/services/{serviceId}/sub-services', [SubServiceController::class, 'index'])->name('subServices.index');

// عرض نموذج إضافة خدمة
Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');

// إضافة خدمة جديدة
Route::post('/services', [ServiceController::class, 'store'])->name('services.store');

// عرض نموذج تعديل خدمة
Route::get('/services/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');

// تحديث بيانات خدمة
Route::put('/services/{service}', [ServiceController::class, 'update'])->name('services.update');

// حذف خدمة
Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');

// عرض نموذج إضافة خدمة فرعية
Route::get('/sub-services/create', [SubServiceController::class, 'create'])->name('subServices.create');

// إضافة خدمة فرعية جديدة
Route::post('/sub-services', [SubServiceController::class, 'store'])->name('subServices.store');

// عرض نموذج تعديل خدمة فرعية
Route::get('/sub-services/{subService}/edit', [SubServiceController::class, 'edit'])->name('subServices.edit');

// تحديث بيانات خدمة فرعية
Route::put('/sub-services/{subService}', [SubServiceController::class, 'update'])->name('subServices.update');

// حذف خدمة فرعية
Route::delete('/sub-services/{subService}', [SubServiceController::class, 'destroy'])->name('subServices.destroy');

Route::get('/user-services', [UserServiceController::class, 'index'])->name('user_services.index');
Route::get('/user-services/create', [UserServiceController::class, 'create'])->name('user_services.create');
Route::post('/user-services', [UserServiceController::class, 'store'])->name('user_services.store');
Route::get('/user-services/{userService}/edit', [UserServiceController::class, 'edit'])->name('user_services.edit');
Route::put('/user-services/{userService}', [UserServiceController::class, 'update'])->name('user_services.update');
Route::delete('/user-services/{userService}', [UserServiceController::class, 'destroy'])->name('user_services.destroy');


//posts
Route::get('/posts', [App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
Route::post('/posts/store', [App\Http\Controllers\PostController::class, 'store'])->name('posts.store');
Route::post('/posts/update/{id}', [App\Http\Controllers\PostController::class, 'update'])->name('posts.update');
route::delete('/posts/destroy/{id}', [App\Http\Controllers\PostController::class, 'destroy'])->name('posts.destroy');

//posts-freelancer
Route::get('/posts-freelancer', [App\Http\Controllers\PostController::class, 'main'])->name('posts');
Route::post('/posts-freelancer/store', [App\Http\Controllers\PostController::class, 'save'])->name('posts_freelancer.store');
Route::post('/posts-freelancer/update/{id}', [App\Http\Controllers\PostController::class, 'update2'])->name('posts_freelancer.update');
route::delete('/posts-freelancer/destroy/{id}', [App\Http\Controllers\PostController::class, 'delete'])->name('posts_freelancer.destroy');



//services-freelancer
Route::get('/services-freelancer', [App\Http\Controllers\UserServiceController::class, 'main'])->name('user_services');
Route::post('/services-freelancer/store', [App\Http\Controllers\UserServiceController::class, 'save'])->name('user_services.save');
Route::post('/services-freelancer/update/{id}', [App\Http\Controllers\UserServiceController::class, 'update2'])->name('user_services.update2');
route::delete('/services-freelancer/destroy/{id}', [App\Http\Controllers\UserServiceController::class, 'delete'])->name('user_services.delete');



//messege
Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');

Route::get('/messages/fetch', [MessageController::class, 'fetchMessages'])->name('messages.fetch');






//bookings
Route::post('/booking/create', [BookingController::class, 'createBooking'])->name('booking.create');


Route::put('/booking/{bookingId}/accept', [BookingController::class, 'acceptBooking'])->name('booking.accept');
Route::put('/booking/{bookingId}/reject', [BookingController::class, 'rejectBooking'])->name('booking.reject');

Route::post('/booking/{bookingId}/cancel', [BookingController::class, 'cancelBooking'])->name('booking.cancel');
Route::get('/my-bookings', [BookingController::class, 'showClientBookings'])->name('client.bookings');
Route::get('/pay/{id}', [BookingController::class, 'pay'])->name('booking.pay');

Route::get('/bookings', [BookingController::class, 'getBookings'])->name('bookings.index');

Route::get('/messagess', function () {
    return view('messeges.index'); // تأكد من أن هذا هو اسم العرض الخاص بك
})->name('messagesws');



Route::post('/favorites', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::delete('/favorites/{id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

    Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');


Route::post('/reports/{postId}', [ReportController::class, 'report'])->name('reports.store');

Route::get('/reports', [ReportController::class, 'getReportedPosts'])->name('reports');
Route::delete('/admin/posts/{id}', [ReportController::class, 'destroy'])->name('admin.posts.destroy');







Route::get('booking/{bookingId}/payment', [BookingController::class, 'payment'])->name('booking.payment');
Route::post('booking/{bookingId}/payment/callback', [BookingController::class, 'paymentCallback'])->name('booking.payment.callback');


// عرض التعليقات


// عرض التعليقات الخاصة بمنشور
Route::get('/posts/{postId}/comments', [CommentController::class, 'fetchComments'])->name('comments.fetch');

// إضافة تعليق جديد
Route::post('/comments/{postId}', [CommentController::class, 'store']);
Route::put('/comments/{id}', [CommentController::class, 'update']);
Route::delete('/comments/{id}', [CommentController::class, 'destroy']);







// web.php (Routes)
Route::get('/service/{serviceId}', [RatingController::class, 'showService'])->name('service.show');
Route::post('/rate-service', [RatingController::class, 'rateService'])->name('rateService');



Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');


});


