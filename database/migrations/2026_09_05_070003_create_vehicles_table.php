<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained()->cascadeOnDelete();
            $table->foreignId('transport_route_id')->nullable()->constrained()->nullOnDelete();
            $table->string('plate_number');
            $table->enum('vehicle_type', ['bus', 'van', 'car']);
            $table->integer('capacity');
            $table->string('driver_name')->nullable();
            $table->string('driver_phone')->nullable();
            $table->boolean('active_status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
