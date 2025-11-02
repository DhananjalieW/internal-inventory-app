<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('inventory_levels', function (Blueprint $t) {
            if (!Schema::hasColumn('inventory_levels','product_id'))   $t->foreignId('product_id')->after('id')->constrained()->cascadeOnDelete();
            if (!Schema::hasColumn('inventory_levels','warehouse_id')) $t->foreignId('warehouse_id')->after('product_id')->constrained()->cascadeOnDelete();
            if (!Schema::hasColumn('inventory_levels','on_hand'))      $t->integer('on_hand')->default(0)->after('warehouse_id');
            if (!Schema::hasColumn('inventory_levels','on_order'))     $t->integer('on_order')->default(0)->after('on_hand');
            if (!Schema::hasColumn('inventory_levels','allocated'))    $t->integer('allocated')->default(0)->after('on_order');
            // unique pair
            $t->unique(['product_id','warehouse_id'], 'inv_levels_prod_wh_unique');
        });
    }
    public function down(): void {
        Schema::table('inventory_levels', function (Blueprint $t) {
            if (Schema::hasColumn('inventory_levels','allocated'))  $t->dropColumn('allocated');
            if (Schema::hasColumn('inventory_levels','on_order'))   $t->dropColumn('on_order');
            if (Schema::hasColumn('inventory_levels','on_hand'))    $t->dropColumn('on_hand');
            if (Schema::hasColumn('inventory_levels','warehouse_id')) $t->dropConstrainedForeignId('warehouse_id');
            if (Schema::hasColumn('inventory_levels','product_id'))   $t->dropConstrainedForeignId('product_id');
            $t->dropUnique('inv_levels_prod_wh_unique');
        });
    }
};
