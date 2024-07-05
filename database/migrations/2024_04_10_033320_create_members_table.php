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
        // Drop the table if it exists
        Schema::dropIfExists('members');

        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('member_name');
            $table->string('slug')->unique();
            $table->unsignedBigInteger('member_position_id');
            $table->string('member_position_title');
            $table->string('member_image')->nullable();
            $table->string('member_number');
            $table->string('member_facebook')->nullable();
            $table->string('member_email')->unique();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('member_position_id')->references('id')->on('positions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};