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
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->string('receipt');
            $table->string('email');
            $table->string('start_month');
            $table->string('end_month');
            $table->string('subtotal');
            $table->string('discount');
            $table->string('total');
            $table->string('note');
            $table->string('status');
            $table->string('total_months');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_receipt');
    }
};
