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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->longText('book_summary')->nullable();
            $table->string('author_name')->nullable();
            $table->string('s_author_name')->nullable();
            $table->date('print_date')->nullable();
            $table->decimal('book_price', 8, 2)->nullable();
            $table->string('cover_pic')->nullable();
            $table->string('publisher')->nullable();
            $table->integer('category')->nullable();
            $table->integer('stock_quantity')->nullable();
            $table->integer('status')->default(1);
            $table->string('seo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
