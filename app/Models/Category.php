<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public function subcategories(){
    	return $this->hasMany('App\Models\Category','parent_id')->where('status',1);
    }
    public function section(){
    	return $this->belongsTo('App\Models\Section','section_id')->select('id','name');
    }
    public function parentcategory(){
    	return $this->belongsTo('App\Models\Category','parent_id')->select('id','name');
    }

    public static function catDetails ($url){
        $catDetails = Category::select('id','name','url','description','parent_id')->with(['subcategories'=>function($query){
           $query->select('id','parent_id')->where('status',1);
        }])->where('url',$url)->first()->toArray();
        if($catDetails['parent_id']==0){
$breadcrumbs = '<a href="'.url($catDetails['url']).'">'.$catDetails['name'].'</a>';
        }
         else{
            $parentCategory = Category::select('name','url')->where('id',$catDetails['parent_id'])->first()->toArray();
$breadcrumbs = '<a href="'.url($parentCategory['url']).'">'.$parentCategory['name'].'</a>&nbsp; <span class="divider">/</span><a href="'.url($catDetails['url']).'">'.$catDetails['name'].'</a>';
         }
            $catIds = array();
          $catIds[] = $catDetails['id'];
          foreach ($catDetails['subcategories'] as $key => $subcat){
$catIds[] = $subcat['id']; 
}
    return array('catIds'=>$catIds, 'catDetails'=>$catDetails,'breadcrumbs'=>$breadcrumbs)  ;
       
        }

    
}
