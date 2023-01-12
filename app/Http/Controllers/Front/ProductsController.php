<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ProductsController extends Controller
{
    public function listing($url){
        $categoryCount = Category::where(['url'=>$url,'status'=>1])->count();
        if($categoryCount>0){
            $categoryDetails = Category::catDetails($url);
            //echo "<pre>";print_r($categoryDetails);die;
            $categoryProducts = Product::with('brand')->whereIn('category_id',$categoryDetails['catIds'])->where('status',1);

            //Check if Sort selected by User

            if(isset($_GET['sortProducts']) && !empty($_GET['sortProducts'])){
                 if($_GET['sortProducts'] == "latest"){
                   $categoryProducts->orderBy('id','Desc');
                    
                }
                
                if($_GET['sortProducts'] == "lowest_price"){
                   $categoryProducts->orderBy('sale_price','Asc');
                    
                }
                elseif($_GET['sortProducts'] == "highest_price"){
                   $categoryProducts->orderBy('sale_price','Desc');
                    
                }

            }
            else{
             $categoryProducts->orderBy('id','Desc');
            }
           
            $categoryProducts = $categoryProducts->paginate(28);
            return view('front.products.listing')->with(compact('categoryDetails','categoryProducts'));
            }
        else{
            abort(404);
        }
    }
}
