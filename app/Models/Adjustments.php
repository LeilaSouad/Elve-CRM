<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adjustments extends Model
{
    use HasFactory;
    public function warehouses(){
        return $this->belongsTo('App\Models\Warehouse','warehouse_id')->select('id','warehouse_name');
    }
      public function admins(){
        return $this->belongsTo('App\Models\Admin','created_by')->select('id','first_name','last_name');
    }

    public function products()

    {
 
        return $this->belongsToMany(Product::class,'adjustments_products', 'adjustment_id', 'product_id')->withPivot('item_quantity','item_price','item_subtotal');

    }

}
