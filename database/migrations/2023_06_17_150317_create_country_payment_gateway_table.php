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
        Schema::create('country_payment_gateway', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id');
            $table->foreignId('payment_gateway_id');
            $table->integer('default')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('country_payment_gateway');
    }
};
