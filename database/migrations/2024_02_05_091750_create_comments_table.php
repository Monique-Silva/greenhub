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
        Schema::create('comments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('comment');
            $table->integer('rating');
            $table->foreignUuid('company_id')->constrained()->cascadeOnDelete();;
            $table->foreignUuid('blog_article_id')->constrained()->cascadeOnDelete();;
            $table->foreignUuid('author_id')->nullable()->constrained('users')->cascadeOnDelete();;
            $table->foreignUuid('product_id')->nullable()->constrained()->cascadeOnDelete();;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
