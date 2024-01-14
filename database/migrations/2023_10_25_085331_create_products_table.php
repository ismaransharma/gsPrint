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
            $table->float('total', 10, 0)->nullable()->default('0');
            $table->string('slug')->unique();
            $table->unsignedBigInteger('weight');
            $table->unsignedBigInteger('paper_weight')->nullable();
            $table->enum('paper_type',['A1', 'A2','A3','A4','A5','A6'])->nullable();
            $table->enum('print_type',['multi_colour_print', 'black_and_white_print'])->nullable();
            $table->string('thickness')->nullable();
            $table->string('colour')->nullable()->default("Null");
            $table->enum('size', ['XS', 'S', 'M', 'L', 'XL', 'XXL', 'ALL'])->nullable();
            $table->enum('sizeinc', ['sqft', 'sqm', 'cuft', 'inch', 'cm', 'mm', 'm'])->nullable();
            $table->float('sizeincnum1')->nullable();
            $table->float('sizeincnum2')->nullable();
            $table->unsignedBigInteger('qty_range1')->nullable();
            $table->unsignedBigInteger('qty_range2')->nullable();
            $table->unsignedBigInteger('qty_range3')->nullable();
            $table->unsignedBigInteger('qty_range4')->nullable();
            $table->unsignedBigInteger('qty_range5')->nullable();
            $table->unsignedBigInteger('qty_range6')->nullable();
            $table->unsignedBigInteger('qty_range7')->nullable();
            $table->unsignedBigInteger('qty_range8')->nullable();
            $table->unsignedBigInteger('qty_range9')->nullable();
            $table->unsignedBigInteger('qty_range10')->nullable();
            $table->float('nrml_price1', 10, 0)->nullable();
            $table->float('nrml_price2', 10, 0)->nullable();
            $table->float('nrml_price3', 10, 0)->nullable();
            $table->float('nrml_price4', 10, 0)->nullable();
            $table->float('nrml_price5', 10, 0)->nullable();
            $table->float('urgent_price1', 10, 0)->nullable();
            $table->float('urgent_price2', 10, 0)->nullable();
            $table->float('urgent_price3', 10, 0)->nullable();
            $table->float('urgent_price4', 10, 0)->nullable();
            $table->float('urgent_price5', 10, 0)->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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