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
            $table->id('productid');
            $table->string('pname');
            $table->unsignedBigInteger('categoryid');
            $table->bigInteger('barcode')->unsigned();
            $table->double('price', 8, 2)->unsigned();
            $table->string('description')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamp('deleted_at')->nullable();
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
