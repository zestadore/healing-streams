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
        Schema::create('monthly_automatics', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email_id');
            $table->string('phone_no');
            $table->json('partnership_categories');
            $table->foreignId('country_id');
            $table->foreignId('currency_id');
            $table->double('amount',10,2);
            $table->foreignId('payment_gateway_id');
            $table->integer('completed_installments')->default(0);
            $table->integer('choice')->default(1)->comment('0->oneoff,1->monthly automatic,2->pledge');
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
        Schema::dropIfExists('monthly_automatics');
    }
};
