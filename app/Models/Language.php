<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
      public function products()

    {
 
        return $this->belongsToMany(Product::class,'languages_products','language_id', 'product_id')->withPivot('product_name','product_pseudo','meta_title','meta_description','product_url');

    }
    
    public function brands()

    {
 
        return $this->belongsToMany(Language::class,'languages_brands','language_id', 'brand_id')->withPivot('brand_name','meta_title', 'meta_description','brand_description','brand_url');

    }
}
