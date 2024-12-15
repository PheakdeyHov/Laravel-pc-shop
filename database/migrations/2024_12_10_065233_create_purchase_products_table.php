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
        Schema::create('purchase_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('product_name');
            $table->foreignId('product_specifications_id')->nullable()->constrained()->onDelete('cascade');
            $table->text('specs_value');
            $table->integer('qty');
            $table->decimal('purchase_price',10,2);
            $table->decimal('sale_price',10,2);
            $table->enum('status',['new','second-hand','99']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_products');
    }
};
