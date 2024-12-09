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
        Schema::create('attendance', function (Blueprint $table) {
            $table->id('attendance_id');
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('service_id');
            $table->date('attendance_date');
            $table->integer('attendance_kids');
            $table->integer('attendance_adults');
            $table->integer('attendance_foreigner');
            $table->integer('attendance_toddlers');
            $table->integer('attendance_total');
            $table->timestamps();


            $table->foreign('admin_id')->references('admin_id')->on('admin')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('service_id')->references('service_id')->on('service')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance');
    }
};
