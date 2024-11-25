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
        Schema::disableForeignKeyConstraints();

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('hsn_code', 255)->nullable();
            $table->json('images')->nullable();
            $table->json('videos')->nullable();
            $table->string('link', 500)->nullable();
            $table->string('name', 255)->nullable();
            $table->double('price', 12, 2)->nullable();
            $table->json('bulk_price')->nullable();
            $table->foreignId('brand_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('category_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('unit_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('minimum_order_quantity')->nullable();
            $table->json('attributes')->nullable();
            $table->json('badge')->nullable();
            $table->text('overview')->nullable();
            $table->text('description')->nullable();
            $table->text('faq')->nullable();
            $table->boolean('refundable')->nullable();
            $table->boolean('warranty')->nullable();
            $table->string('meta_title', 255)->nullable();
            $table->string('meta_keywords', 500)->nullable();
            $table->string('meta_description', 500)->nullable();
            $table->json('additional')->nullable();
            $table->string('status', 255)->nullable();
            $table->text('remarks')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
