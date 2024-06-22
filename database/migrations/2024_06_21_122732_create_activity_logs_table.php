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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->foreign()->references('id')->on('users');
            $table->string('action_group');
            $table->string('ip_address');
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->text('activity')->nullable();
            $table->text('comment')->nullable();
            $table->date('action_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
