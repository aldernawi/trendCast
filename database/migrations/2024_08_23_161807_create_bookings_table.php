<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');  // معرف العميل
            $table->unsignedBigInteger('company_id');  // معرف الشركة
            $table->unsignedBigInteger('service_id');  // معرف الخدمة
            $table->enum('status', ['Pending', 'Accepted', 'Rejected', 'Canceled'])->default('Pending');  // حالة الحجز
            $table->timestamp('booking_date');  // تاريخ الحجز
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('user_service_details')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
