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
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('tagged_user_id')->foreign('tagged_user_id')->references('id')->on('users');
            $table->bigInteger('post_id')->foreign('post_id')->references('id')->on('posts')->nullable();
            $table->bigInteger('post_comment_id')->foreign('post_comment_id')->references('id')->on('post_comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
    }
};
