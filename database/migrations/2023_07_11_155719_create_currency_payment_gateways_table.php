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
        Schema::create('currency_payment_gateways', function (Blueprint $table) {
            $table->id();
            $table->foreignId('currency_id');
            $table->foreignId('payment_gateway_id');
            $table->integer('is_default')->default(0);
            $table->integer('status')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currency_payment_gateways');
    }
};
