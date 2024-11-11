<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();  // Primary key
            $table->string('name');  // الاسم
            $table->string('email')->unique();  // البريد الإلكتروني
            $table->string('phone')->nullable();  // رقم الهاتف
            $table->string('address')->nullable();  // العنوان
            $table->text('description')->nullable();  // الوصف
            $table->enum ('status', ['active', 'inactive'])->default('active');
            $table->string('password');  // كلمة المرور
            $table->string('image')->nullable();  // صورة المستخدم
            $table->string('cover_image')->nullable();  // صورة الغلاف (للشركات والفريلانسر)
            $table->string('company_url')->nullable();  // رابط موقع الشركة (للشركات والفريلانسر)
            $table->string('facebook_url')->nullable();  // رابط فيسبوك
            $table->string('linkedin_url')->nullable();  // رابط لينكد إن
            $table->string('instagram_url')->nullable();  // رابط إنستغرام
            $table->string('twitter_url')->nullable();  // رابط تويتر
            $table->string('location')->nullable();  // الموقع الجغرافي
            $table->enum('user_type', ['Admin', 'Company', 'Freelancer', 'Client']);  // نوع المستخدم
            $table->timestamps();  // created_at و updated_at (يتم إنشاؤهما تلقائيًا)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
