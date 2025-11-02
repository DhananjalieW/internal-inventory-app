<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryLevel extends Model
{
    protected $fillable = ['product_id','warehouse_id','on_hand','on_order','allocated'];

}
