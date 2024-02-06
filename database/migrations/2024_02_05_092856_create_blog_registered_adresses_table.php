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
        Schema::create('blog_registered_adresses', function (Blueprint $table) {
            $table->foreignUuid('user_id')->nullable()->constrained()->cascadeOnDelete();;
            $table->foreignUuid('adress_id')->nullable()->constrained()->cascadeOnDelete();;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_registered_adresses');
    }
};
