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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->float('price');
            $table->float('vat_rate');
            $table->integer('stock');
            $table->string('description');
            $table->integer('environmental_impact');
            $table->string('origin');
            $table->string('measuring_unit');
            $table->integer('measure');
            $table->foreignUuid('discount_id')->nullable()->constrained()->cascadeOnDelete();;
            $table->foreignUuid('brand_id')->nullable()->constrained()->cascadeOnDelete();;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
