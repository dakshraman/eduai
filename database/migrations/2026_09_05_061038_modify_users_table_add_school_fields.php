<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('school_id')->nullable()->constrained()->nullOnDelete();
            $table->enum('role', ['super_admin', 'admin', 'teacher', 'student', 'parent', 'accountant'])->default('student');
            $table->string('phone')->nullable();
            $table->string('avatar')->nullable();
            $table->string('address')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('blood_group')->nullable();
            $table->string('religion')->nullable();
            $table->boolean('active_status')->default(true);
            $table->boolean('is_saas')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['school_id']);
            $table->dropColumn([
                'school_id', 'role', 'phone', 'avatar', 'address',
                'date_of_birth', 'gender', 'blood_group', 'religion',
                'active_status', 'is_saas',
            ]);
        });
    }
};
