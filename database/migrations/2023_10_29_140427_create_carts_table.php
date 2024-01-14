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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->string('cart_code')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->UnsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->decimal('price');
            $table->string('upload_design')->unique();
            $table->decimal('total_price');
            $table->enum('price2',['nrml_price', 'urgent_price']);
            $table->timestamps();


            $table->foreign('product_id')->on('products')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
};