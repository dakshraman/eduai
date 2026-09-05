<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('school_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained()->onDelete('cascade');
            $table->foreignId('subscription_plan_id')->constrained()->onDelete('cascade');
            $table->string('stripe_subscription_id')->nullable();
            $table->string('stripe_customer_id')->nullable();
            $table->enum('status', ['trial', 'active', 'past_due', 'cancelled', 'expired'])->default('trial');
            $table->enum('billing_period', ['monthly', 'yearly'])->default('monthly');
            $table->date('trial_ends_at')->nullable();
            $table->date('current_period_start')->nullable();
            $table->date('current_period_end')->nullable();
            $table->date('cancelled_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school_subscriptions');
    }
};
