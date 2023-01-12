<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salesinvoice extends Model
{
    use HasFactory;
    public function customers(){
        return $this->belongsTo('App\Models\Customers','customer_id')->select('id','first_name', 'last_name');
    }
    public function warehouses(){
        return $this->belongsTo('App\Models\Warehouse','warehouse_id')->select('id','warehouse_name');
    }
    public function admins(){
        return $this->belongsTo('App\Models\Admin','created_by')->select('id','first_name','last_name');
    }


     public function products()

    {
 
        return $this->belongsToMany(Product::class,'salesinvoices_products', 'salesinvoice_id', 'product_id')->withPivot('item_quantity','item_discount','item_price','item_subtotal');

    }
}
