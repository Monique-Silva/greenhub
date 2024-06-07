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
        Schema::create('orders_has_products', function (Blueprint $table) {
            $table->integer('quantity')->nullable();
            $table->float('unit_price')->nullable();
            $table->float('unit_price_vat')->nullable();
            $table->foreignUuid('order_id')->nullable()->constrained()->cascadeOnDelete();;
            $table->foreignUuid('product_id')->nullable()->constrained()->cascadeOnDelete();
            $table->timestamps();
        });

    /* Add an id to the table */

    Schema::table('orders_has_products', function (Blueprint $table) {
        $table->id();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_has_products');
    }
};
