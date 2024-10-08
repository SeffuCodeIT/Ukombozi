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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('country');
            $table->string('county');
            $table->string('constituency');
            $table->string('street_address');
            $table->string('landmark')->nullable();
            $table->string('phone');
            $table->string('email');
//            $table->text('order_notes')->nullable();
            $table->decimal('total', 10, 2);
            $table->string('shipping_method');
            $table->string('payment_status')->default('pending');
            $table->string('payment_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
