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
        Schema::create('attendees', function (Blueprint $table) {
            $table->id('attendes_id');
            $table->unsignedBigInteger('admin_id');
            $table->string('attendees_fname');
            $table->string('attendees_lname');
            $table->string('attendees_mname');
            $table->date('attendees_birthday');
            $table->string('attendees_facebook');
            $table->string('attendees_mobile_number');
            $table->string('attendees_life_stage');
            $table->string('attendees_sector_of_society');
            $table->string('attendees_school');
            $table->string('attendees_school_level');
            $table->string('attendees_service_commitment');
            $table->timestamps();

            $table->foreign('admin_id')->references('admin_id')->on('admin')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendees');
    }
};
