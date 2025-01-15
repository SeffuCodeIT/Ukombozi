<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->string('mpesa_receipt_number')->nullable(); // For M-Pesa receipt number
            $table->timestamp('payment_date')->nullable();      // For the payment date
            $table->string('failure_reason')->nullable();       // For the failure reason, if any
        });
    }

    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('mpesa_receipt_number');
            $table->dropColumn('payment_date');
            $table->dropColumn('failure_reason');
        });
    }

};
