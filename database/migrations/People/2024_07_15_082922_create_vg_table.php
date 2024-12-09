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
        Schema::create('vg', function (Blueprint $table) {
            $table->id('vg_id');
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('leader_id');
            $table->unsignedBigInteger('intern_id')->nullable();
           
          
            $table->integer('vg_no');
            $table->integer('vg_no_members');
            $table->string('vg_life_stage');
            $table->string('vg_status');
            $table->integer('year');

            $table->foreign('leader_id')->references('leader_id')->on('leader')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('intern_id')->references('intern_id')->on('intern')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('admin_id')->references('admin_id')->on('admin')->onUpdate('cascade')->onDelete('cascade');



         
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vg');
    }
};
