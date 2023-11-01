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
            $table->id();
            $table->string('product_title');
            $table->unsignedBigInteger('category_id');
            $table->string('category_title');
            $table->string('product_image')->unique();
            $table->longText('product_description')->nullable();
            $table->float('original_price');            
            $table->float('discount_price')->nullable();
            $table->float('total', 10, 0)->nullable()->default('0');
            $table->string('slug')->unique();
            $table->unsignedBigInteger('weight');
            $table->unsignedBigInteger('paper_weight')->nullable();
            $table->enum('paper_type',['A1', 'A2','A3','A4','A5','A6'])->nullable();
            $table->enum('print_type',['multi_colour_print', 'black_and_white_print'])->nullable();
            $table->string('thickness')->nullable();
            $table->string('colour')->nullable()->default("Null");
            $table->enum('size', ['XS', 'S', 'M', 'L', 'XL', 'XXL', 'ALL'])->nullable();
            $table->enum('sizeinc', ['sqft', 'sqm', 'cuft', 'inch', 'cm', 'm'])->nullable();
            $table->float('sizeincnum1')->nullable();
            $table->float('sizeincnum2')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->unsignedInteger('stock');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->on('categories')->references('id')->onDelete('cascade');
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