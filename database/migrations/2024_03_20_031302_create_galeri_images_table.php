<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * @return
     */
    public function up(): void
    {
        Schema::create('galeri_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->string('caption');
            $table->string('category');
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * 
     * @return
     */
    public function down(): void
    {
        Schema::dropIfExists('galeri_images');
    }
};
