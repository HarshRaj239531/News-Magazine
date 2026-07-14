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
        Schema::create('navigation_menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('navigation_menus')->onDelete('cascade');
            $table->string('title_en');
            $table->string('title_hi');
            $table->string('type'); // parent, page, directory, url
            $table->string('slug')->nullable()->unique();
            $table->string('url')->nullable();
            $table->string('directory_category')->nullable();
            $table->longText('content_en')->nullable();
            $table->longText('content_hi')->nullable();
            $table->string('layout_type')->default('standard'); // standard, grid, table
            $table->integer('sort_order')->default(0);
            $table->string('status')->default('published');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('navigation_menus');
    }
};
