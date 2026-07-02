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
        // 1. Create tags table
        Schema::create('tiengdong_tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        // 2. Create pivot table for sounds and tags
        Schema::create('tiengdong_sound_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('sound_id');
            $table->unsignedBigInteger('tag_id');

            $table->foreign('sound_id')->references('id')->on('tiengdong_sounds')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tiengdong_tags')->onDelete('cascade');

            $table->primary(['sound_id', 'tag_id']);
        });

        // 3. Add description to sounds table
        Schema::table('tiengdong_sounds', function (Blueprint $table) {
            $table->text('description')->nullable()->after('detail_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tiengdong_sounds', function (Blueprint $table) {
            $table->dropColumn('description');
        });

        Schema::dropIfExists('tiengdong_sound_tag');
        Schema::dropIfExists('tiengdong_tags');
    }
};
