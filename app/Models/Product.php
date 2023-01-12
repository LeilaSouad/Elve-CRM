<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function category(){
    	return $this->belongsTo('App\Models\Category','category_id');



    }
    public function section(){
    	return $this->belongsTo('App\Models\Section','section_id');

    }
    public function brand(){
        return $this->belongsTo('App\Models\Brands','brand_id');
    }
    public function images(){
    	return $this->hasMany('App\Models\ProductsImage');
    }
    public function receipts()

    {
 
        return $this->belongsToMany(Receipts::class,'receipts_products','product_id', 'receipt_id')->withPivot('item_quantity','item_discount','item_price','item_subtotal');

    }

 public function salesinvoices()

    {
 
        return $this->belongsToMany(Salesinvoice::class,'salesinvoices_products','product_id', 'salesinvoice_id')->withPivot('item_quantity','item_discount','item_price','item_subtotal');

    }



     public function adjustments()

    {
 
        return $this->belongsToMany(Adjustments::class,'adjustments_products','product_id', 'adjustment_id')->withPivot('item_quantity','item_price','item_subtotal');

    }
    
    
     public function languages()

    {
 
        return $this->belongsToMany(Language::class,'languages_products','product_id', 'language_id')->withPivot('product_name','product_pseudo','meta_title','meta_description','product_url');

    }
}
