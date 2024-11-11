<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('post_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id'); // معرّف الجدول الرئيسي
            $table->string('path'); // مسار الصورة
            $table->timestamps();
        
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade'); // ربط الجدول الفرعي بالجدول الرئيسي
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_images');
    }
};
