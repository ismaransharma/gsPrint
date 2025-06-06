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
            $table->id();
            $table->string('cart_code')->unique();
            $table->unsignedBigInteger('user_id');
            $table->string('user_name');
            $table->string('product_name');
            $table->integer('quantity');
            $table->decimal('price');
            $table->float('total', 10, 0)->default('0');
            $table->string('upload_design')->unique();
            $table->enum('price2',['nrml_price', 'urgent_price']);
            $table->string('name');
            $table->string('mobile_number');
            $table->string('email');
            $table->string('address');
            $table->text('additional_information')->nullable();
            $table->enum('payment_method', ['online', 'cod']);
            $table->enum('payment_status', ['N', 'Y'])->default('N');
            $table->decimal('payment_amount');
            $table->enum('order_status', ['Pending', 'Shipped', 'Delivered', 'Cancelled', 'Refunded', ])->default('Pending');
            $table->timestamp('deleted_at')->nullable();
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