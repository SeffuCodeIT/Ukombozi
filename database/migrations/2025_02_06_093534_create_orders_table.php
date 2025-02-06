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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('country');
            $table->string('county');
            $table->string('constituency');
            $table->string('street_address');
            $table->string('landmark')->nullable();
            $table->string('phone');
            $table->string('email');
            $table->decimal('total', 10, 2); // Amount paid
            $table->unsignedBigInteger('product_id'); // To track the product bought
            $table->integer('product_qty'); // Quantity of the product
            $table->boolean('shipping_method'); // 0 = Pickup, 1 = Delivery
            $table->string('payment_status'); // Payment status description
            $table->string('payment_id'); // order_tracking_id from API
            $table->string('confirmation_code')->nullable(); // Confirmation code
            $table->string('account_no')->nullable(); // Account number used for payment
            $table->string('failure_reason')->nullable(); // Failure reason (if payment fails)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
