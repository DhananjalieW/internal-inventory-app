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
    Schema::create('products', function (Illuminate\Database\Schema\Blueprint $t) {
        $t->id();
        $t->string('sku', 64)->unique();
        $t->string('name');
        $t->text('description')->nullable();
        $t->string('category', 64)->nullable();
        $t->string('uom', 32)->nullable();           // pcs, kg, etc.
        $t->integer('reorder_point')->default(0);
        $t->boolean('is_active')->default(true);
        $t->timestamps();

        $t->index(['name', 'category', 'uom']);
    });
}

public function down(): void
{
    Schema::dropIfExists('products');
}

};
