<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // Exemple de migration pour order_product table
public function up()
{
    Schema::create('order_product', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('order_id');
        $table->unsignedBigInteger('product_id');
        $table->integer('quantity');
        // Autres colonnes nécessaires
        $table->timestamps();

        $table->foreign('order_id')->references('id')->on('orders');
        $table->foreign('product_id')->references('id')->on('products');
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_product');
    }
};
