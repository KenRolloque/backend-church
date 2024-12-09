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
        Schema::create('intern', function (Blueprint $table) {
            $table->id('intern_id');
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('attendes_id');
            $table->unsignedBigInteger('leader_id');

            $table->foreign('attendes_id')->references('attendes_id')->on('attendees')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('admin_id')->references('admin_id')->on('admin')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('leader_id')->references('leader_id')->on('leader')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intern');
    }
};
