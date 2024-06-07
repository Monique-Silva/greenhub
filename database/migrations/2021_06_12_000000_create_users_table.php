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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('user_name');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', array('client', 'company', 'administrator'))->default('client');
            $table->rememberToken();
            $table->timestamps();
            $table->foreignUuid('company_id')->nullable()->constrained()->cascadeOnDelete();;
            $table->foreignUuid('image_id')->nullable()->constrained()->cascadeOnDelete();;
            $table->foreignUuid('address_id')->nullable()->constrained()->cascadeOnDelete();;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
