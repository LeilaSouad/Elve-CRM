<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class IndexController extends Controller
{
    public function index (){
        //Get Featured Items
        $featuredProductsCount = Product::where('is_featured','Yes')->where('status', 1)->where('status',1)->count();
        $featuredProducts = Product::where('is_featured','Yes')->where('status',1)->get()->toArray();
        $featuredProductsChunk = array_chunk($featuredProducts,4);
        //Get Latest Products
        $latestProducts = Product::orderby('id','Desc')->limit(4)->where('status',1)->get()->toArray();
        $page_name = 'Index';
        return view ('front.index')->with(compact('page_name', 'featuredProductsChunk','featuredProductsCount', 'latestProducts'));

    }
}
