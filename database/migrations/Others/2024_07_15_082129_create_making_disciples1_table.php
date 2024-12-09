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
        Schema::create('making_disciples1', function (Blueprint $table) {
            $table->id('md1_id');
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('attendes_id');
            $table->date('date');
            $table->string('status');

            $table->foreign('admin_id')->references('admin_id')->on('admin')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('attendes_id')->references('attendes_id')->on('attendees')->onUpdate('cascade')->onDelete('cascade');
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('making_disciples1');
    }
};
