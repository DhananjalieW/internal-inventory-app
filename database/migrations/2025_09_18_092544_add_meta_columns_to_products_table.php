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
    Schema::table('products', function (Illuminate\Database\Schema\Blueprint $t) {
        if (!Schema::hasColumn('products', 'category'))      $t->string('category', 64)->nullable()->after('description');
        if (!Schema::hasColumn('products', 'uom'))           $t->string('uom', 32)->nullable()->after('category');
        if (!Schema::hasColumn('products', 'reorder_point')) $t->integer('reorder_point')->default(0)->after('uom');
        if (!Schema::hasColumn('products', 'is_active'))     $t->boolean('is_active')->default(true)->after('reorder_point');
    });
}

public function down(): void
{
    Schema::table('products', function (Illuminate\Database\Schema\Blueprint $t) {
        if (Schema::hasColumn('products', 'category'))      $t->dropColumn('category');
        if (Schema::hasColumn('products', 'uom'))           $t->dropColumn('uom');
        if (Schema::hasColumn('products', 'reorder_point')) $t->dropColumn('reorder_point');
        if (Schema::hasColumn('products', 'is_active'))     $t->dropColumn('is_active');
    });
}

};
