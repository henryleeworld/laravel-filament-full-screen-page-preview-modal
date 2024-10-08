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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->dateTime('published_at')->nullable();
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('content_blocks')->nullable();
            $table->text('footer_blocks')->nullable();
            $table->text('main_image_url')->nullable();
            $table->text('main_image_upload')->nullable();
            $table->foreignId('category_id')
                ->constrained('categories')
                ->restrictOnDelete();
            $table->boolean('is_featured')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
