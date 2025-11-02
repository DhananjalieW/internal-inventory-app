<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    'sku','name','description','category','uom','reorder_point','is_active',
    // keep cost_price/sale_price if you already have them
];

}
