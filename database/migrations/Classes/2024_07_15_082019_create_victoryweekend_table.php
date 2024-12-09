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
        Schema::create('victoryweekend', function (Blueprint $table) {
            $table->id('vw_id');
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('attendes_id');
            $table->string('vw_batch_no');
            $table->date('vw_date');
            $table->string('vw_day1');
            $table->string('vw_day2');
            $table->string('vw_water_baptism');
            $table->string('status');


            $table->foreign('attendes_id')->references('attendes_id')->on('attendees')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('admin_id')->references('admin_id')->on('admin')->onUpdate('cascade')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('victoryweekend');
    }
};
