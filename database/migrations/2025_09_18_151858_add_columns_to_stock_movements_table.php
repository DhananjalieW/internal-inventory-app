<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('stock_movements', function (Blueprint $t) {
            if (!Schema::hasColumn('stock_movements','product_id'))   $t->foreignId('product_id')->after('id')->constrained()->cascadeOnDelete();
            if (!Schema::hasColumn('stock_movements','warehouse_id')) $t->foreignId('warehouse_id')->after('product_id')->constrained()->cascadeOnDelete();
            if (!Schema::hasColumn('stock_movements','type'))         $t->string('type',10)->after('warehouse_id'); // IN/OUT/ADJUST
            if (!Schema::hasColumn('stock_movements','qty'))          $t->integer('qty')->after('type');
            if (!Schema::hasColumn('stock_movements','reference'))    $t->string('reference',100)->nullable()->after('qty');
            if (!Schema::hasColumn('stock_movements','notes'))        $t->text('notes')->nullable()->after('reference');
            if (!Schema::hasColumn('stock_movements','user_id'))      $t->foreignId('user_id')->after('notes')->constrained('users');
            $t->index(['product_id','warehouse_id','type'], 'movements_prod_wh_type_idx');
        });
    }
    public function down(): void {
        Schema::table('stock_movements', function (Blueprint $t) {
            $t->dropIndex('movements_prod_wh_type_idx');
            if (Schema::hasColumn('stock_movements','user_id'))      $t->dropConstrainedForeignId('user_id');
            if (Schema::hasColumn('stock_movements','notes'))        $t->dropColumn('notes');
            if (Schema::hasColumn('stock_movements','reference'))    $t->dropColumn('reference');
            if (Schema::hasColumn('stock_movements','qty'))          $t->dropColumn('qty');
            if (Schema::hasColumn('stock_movements','type'))         $t->dropColumn('type');
            if (Schema::hasColumn('stock_movements','warehouse_id')) $t->dropConstrainedForeignId('warehouse_id');
            if (Schema::hasColumn('stock_movements','product_id'))   $t->dropConstrainedForeignId('product_id');
        });
    }
};
