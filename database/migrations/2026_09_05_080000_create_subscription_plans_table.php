<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('price_monthly', 10, 2);
            $table->decimal('price_yearly', 10, 2)->nullable();
            $table->json('features')->nullable();
            $table->string('stripe_price_monthly_id')->nullable();
            $table->string('stripe_price_yearly_id')->nullable();
            $table->boolean('active_status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscription_plans');
    }
};
