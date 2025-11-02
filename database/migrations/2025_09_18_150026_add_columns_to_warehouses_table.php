<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    public function up(): void {
        Schema::table('warehouses', function (Blueprint $t) {
            if (!Schema::hasColumn('warehouses','code'))       $t->string('code',20)->unique()->after('id');
            if (!Schema::hasColumn('warehouses','name'))       $t->string('name')->after('code');
            if (!Schema::hasColumn('warehouses','location'))   $t->string('location')->nullable()->after('name');
            if (!Schema::hasColumn('warehouses','is_active'))  $t->boolean('is_active')->default(true)->after('location');
        });
    }
    public function down(): void {
        Schema::table('warehouses', function (Blueprint $t) {
            if (Schema::hasColumn('warehouses','code'))      { $t->dropUnique('warehouses_code_unique'); $t->dropColumn('code'); }
            if (Schema::hasColumn('warehouses','name'))        $t->dropColumn('name');
            if (Schema::hasColumn('warehouses','location'))    $t->dropColumn('location');
            if (Schema::hasColumn('warehouses','is_active'))   $t->dropColumn('is_active');
        });
    }
};
