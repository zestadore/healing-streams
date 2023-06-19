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
            $table->string('last_name')->nullable();
            $table->string('email_id');
            $table->string('phone_no');
            $table->json('partnership_categories');
            $table->foreignId('country_id');
            $table->foreignId('currency_id');
            $table->double('amount',10,2);
            $table->integer('choice')->default(0)->comment('0->oneoff,1->monthly automatic,2->pledge');
            $table->foreignId('payment_gateway_id');
            $table->integer('payment_status')->default(0)->coemment('0->pending,1->paid,2->umpaid');
            $table->text('reference_id')->nullable();
            $table->dateTime('payment_date')->nullable();
            $table->softDeletes();
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
