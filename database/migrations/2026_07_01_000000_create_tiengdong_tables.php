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
        Schema::create('tiengdong_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('url');
            $table->timestamps();
        });

        Schema::create('tiengdong_sounds', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary(); // post_id from tiengdong.com
            $table->foreignId('category_id')->constrained('tiengdong_categories')->onDelete('cascade');
            $table->string('title');
            $table->string('slug');
            $table->string('mp3_url', 1000);
            $table->string('local_path', 1000)->nullable();
            $table->string('detail_url', 1000);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tiengdong_sounds');
        Schema::dropIfExists('tiengdong_categories');
    }
};
