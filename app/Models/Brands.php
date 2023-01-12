<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    use HasFactory;
    public function languages()

    {
 
        return $this->belongsToMany(Language::class,'languages_brands','brand_id', 'language_id')->withPivot('brand_name','meta_title', 'meta_description','brand_description','brand_url')->orderBy('language_id');

    }
}
