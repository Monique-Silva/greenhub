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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('number');
            $table->date('order_date');
            $table->date('delivery_date');
            $table->float('bill');
            $table->float('vat');
            $table->float('shipping_fee');
            $table->float('total_price');
            $table->foreignUuid('user_id')->nullable()->constrained();
            $table->foreignUuid('adress_id')->nullable()->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
