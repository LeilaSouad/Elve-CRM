<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Section;
use App\Models\Category;
use Session;
use App\Models\ProductsImage;
use App\Models\Brands;
use App\Models\Language;
use Image;
class ProductController extends Controller
{
    public function products(){
    	Session::put('page','products');
    	$products = Product::with(['category'=>function($query){
    		$query->select('id','name');
    	},'section'=>function($query){
    		$query->select('id','name');
    	}])->get();
    	//$products = json_decode(json_encode($products));
    	//echo "<pre>";print_r($products);die;
return view('admin.products.products')->with(compact('products'));

    }
     //Delete Product
public function deleteProduct($id){
	Product::where('id',$id)->delete();
	$message = 'Товар удален';
session::flash('success_message',$message);
		return redirect()->back();
}
public function updateProductStatus(Request $request){

    	if($request->ajax()){
    		$data = $request->all();
    		//echo "<pre>";print_r($data); die;
    		if($data['status']=="Active"){
    			$status = 0;

    		}else{
    			$status = 1;
    		}
    		Product::where('id',$data['product_id'])->update(['status'=>$status]);

    		return response()->json(['status'=>$status, 'product_id'=>$data['product_id']]);

    	}
    }
    public function updateImageStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            /*echo "<pre>"; print_r($data); die;*/
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            ProductsImage::where('id',$data['image_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'image_id'=>$data['image_id']]);
        }
    }
   
public function addEditProduct(Request $request,$id=null)
{
	if($id==""){
		$title="Добавить товар";
		$product = new Product;
		$productdata = array();
		$message = "Товар обновлен";



	}else {
		$title="Редактировать товар";
		$productdata = Product::find($id)->toArray();
		//$productdata = json_decode(json_encode($productdata),true);
		$product = Product::find($id);
		$message = "Товар обновлен";

		//echo "<pre>";print_r($productdata);die;

	}
	if($request->isMethod('post')){
		$data = $request->all();
		//echo "<pre>";print_r($data);die;
		
		//Validation of Fields
	$rules=[
			'product_name' =>'required',
			'product_code' => 'required|regex:/^[\w-]*$/',
			'url' => 'required',
			'category_id' => 'required',
			'sale_price' => 'required|numeric',
			'product_main_image' => 'image|mimes:jpeg,bmp,png,jpg'

		];
		$customMessages=[
'product_name.required' => 'Название обязательно',
'product_name.regex' => 'Правильное название обязательно',
'sale_price.required'=>'Поле Ценаобязательно',
'product_code.required'=>'Поле Артикул обязательно',
'category_id.required'=>'Поле Категория обязательно',
'url.required'=>'Поле "Url" обязательно',
'product_main_image.image'=>'Неправильный формат изображения' 
		];

		$this->validate($request, $rules, $customMessages);


		
		
		
			
//Upload Product Image
		if($request->hasFile('product_main_image')){
			$image_tmp = $request->file('product_main_image');
			if($image_tmp->isValid()){
				//Upload Image after Resize
				//Get Image Name
				$image_name = $image_tmp->getClientOriginalName();
				//Get Image Extension
				$extension = $image_tmp->getClientOriginalExtension();
				//Generate New Image Name
				$imageName = $image_name.'-'.rand().'.'.$extension;
				//Set Paths to Large, Medium and Small Images
				$large_image_path = 'images/product_images/large/'.$imageName;
$medium_image_path = 'images/product_images/medium/'.$imageName;
$small_image_path = 'images/product_images/small/'.$imageName;
//Upload Images
Image::make($image_tmp)->save($large_image_path); // W:1040 H:1200
Image::make($image_tmp)->resize(null,600,function ($constraint) {
    $constraint->aspectRatio();
})->save($medium_image_path);
Image::make($image_tmp)->resize(null,200,function ($constraint) {
    $constraint->aspectRatio();
})->save($small_image_path);
//Save Image in DB
$product->product_main_image = $imageName;
			}
		}
		//Upload Product Video
if($request->hasFile('product_video')){
	$video_tmp = $request->file('product_video');
	if($video_tmp->isValid()){
		//Upload Video
		$video_name = $video_tmp->getClientOriginalName();
		$extension = $video_tmp->getClientOriginalExtension();
		$videoName = $video_name.'-'.rand().'.'.$extension
;
$video_path = 'videos/product_video/';
$video_tmp->move($video_path,$videoName);
//Save Video in DB
$product->product_video = $videoName;	}
}

		//Save Product Details in Product Table


	if(empty($data['wholesale_price'])){
			$data['wholesale_price'] = "";
		}

if(empty($data['product_discount'])){
			$data['product_discount'] = "";
		}
if(empty($data['description'])){
			$data['description'] = "";
		}if(empty($data['meta_title'])){
			$data['meta_title'] = "";
		}if(empty($data['meta_description'])){
			$data['meta_description'] = "";
		}
		if(empty($data['product_form'])){
			$data['product_form'] = "";
		}
	if(empty($data['product_color'])){
			$data['product_color'] = "";
		}
	if(empty($data['product_type'])){
			$data['product_type'] = "";
		}
			if(empty($data['product_country'])){
			$data['product_country'] = "";
		}
			if(empty($data['product_fabric'])){
			$data['product_fabric'] = "";
		}
			if(empty($data['pile_height'])){
			$data['pile_height'] = "";
		}	if(empty($data['product_manufacturer'])){
			$data['product_manufacturer'] = "";
		}	if(empty($data['product_pile_type'])){
			$data['product_pile_type'] = "";
		}
			if(empty($data['product_pyle_density'])){
			$data['product_pyle_density'] = "";
		}
			if(empty($data['product_warp'])){
			$data['product_warp'] = "";
		}
			if(empty($data['product_width'])){
			$data['product_width'] = "";
		}
			if(empty($data['product_length'])){
			$data['product_length'] = "";
		}
			if(empty($data['product_quantity'])){
			$data['product_quantity'] = "";
		}
			if(empty($data['product_meters'])){
			$data['product_meters'] = "";
		}
		if(empty($data['product_unit'])){
			$data['product_unit'] = "";
		}if(empty($data['product_height'])){
			$data['product_height'] = "";
		}if(empty($data['product_weight'])){
			$data['product_weight'] = "";
		}
		if(!empty($data['is_featured'])){
                $product->is_featured = "Yes";
            }else{
                $product->is_featured = "No";    
            }
	if(empty($data['product_video'])){
			$data['product_video'] = "";
		}
		else {
			$data['product_video'] = $data['product_video'];
		}

if(empty($data['pseudo'])){
			$data['pseudo'] = "";
		}
		else {
			$data['pseudo'] = $data['pseudo'];
		}


			if(empty($data['product_main_image'])){
			$data['product_main_image'] = "";
		}
		else {
$data['product_main_image'] = $data['product_main_image'];
		}
	
		$categoryDetails = Category::find($data['category_id']);
		$product->section_id = $categoryDetails['section_id'];
		$product->brand_id = $data['brand_id'];
		$product->category_id = $data['category_id'];
		$product->pseudo = $data['pseudo'];
		$product->product_name = $data['product_name'];

		$product->status = $data['status'];
		$product->product_code = $data['product_code'];
		$product->sale_price = $data['sale_price'];
		$product->wholesale_price = $data['wholesale_price'];
		$product->product_discount = $data['product_discount'];
		$product->description = $data['description'];
		$product->url = $data['url'];
		$product->meta_title = $data['meta_title'];
		$product->meta_description = $data['meta_description'];
		$product->product_form = $data['product_form'];
		$product->product_color = $data['product_color'];
		$product->product_type = $data['product_type'];
		$product->product_country = $data['product_country'];
		$product->product_fabric = $data['product_fabric'];
		$product->pile_height = $data['pile_height'];
		$product->product_manufacturer = $data['product_manufacturer'];
		$product->product_pile_type = $data['product_pile_type'];
		$product->product_pyle_density = $data['product_pyle_density'];
		$product->product_warp = $data['product_warp'];
		$product->product_width = $data['product_width'];
		$product->product_length = $data['product_length'];
		$product->product_quantity = $data['product_quantity'];
		$product->product_meters = $data['product_meters'];
		$product->product_unit = $data['product_unit'];
		$product->product_height = $data['product_height'];
		$product->product_weight = $data['product_weight'];
		
		  
	if(!empty($data['is_featured'])){
		$product->is_featured = $data['is_featured'];
	}
else{
$product->is_featured = "No";
}

		$product->save();
		session::flash('success_message', $message);
		return redirect ('admin/products');

	}
	//Filter Arrays
	$product_fabricArray= array('Хлопок','Полипропилен','Полиэстер');

	//Sections with Categories and Subcategories
	$categories = Section::with('categories')->get();
	//$categories = json_decode(json_encode($categories),true);
	//echo "<pre>";print_r($categories);die;

//Get All Brands
  
	
	
	$brands = Brands::with('languages')->get();
	

	
	
	
	
	

	
//	echo "<pre>";print_r($brands);die;
	

	return view('admin.products.add_edit_product')->with(compact('title','product_fabricArray','categories','productdata','brands'));
}

public function deleteProductImage($id){
	//Get Image
	$productImage = Product::select('product_main_image')->where('id',$id)->first();

	//Get Image Path
	$small_image_path = 'images/product_images/small/';
	$medium_image_path = 'images/product_images/medium/';
	$large_image_path = 'images/product_images/large/';

	//Delete Image from folder if exists
	if(file_exists($small_image_path.$productImage->product_main_image)){
		unlink ($small_image_path.$productImage->product_main_image);
	}
	if(file_exists($medium_image_path.$productImage->product_main_image)){
		unlink ($medium_image_path.$productImage->product_main_image);
	}
	if(file_exists($large_image_path.$productImage->product_main_image)){
		unlink ($large_image_path.$productImage->product_main_image);
	}
		//Delete Image from Category Table
		Product::where('id',$id)->update(['product_main_image'=>'']);

		$message = 'Image has been deleted successfully';
		session::flash('success_message',$message);
		return redirect()->back();
	}
public function deleteProductVideo($id){
	//Get Video
	$productVideo = Product::select('product_video')->where('id',$id)->first();

	//Get Video Path
	$product_video_path = 'videos/product_video/';
	

	//Delete Video from folder if exists
	if(file_exists($product_video_path.$productVideo->product_video)){
		unlink ($product_video_path.$productVideo->product_video);
	}
	
		//Delete Video from Category Table
		Product::where('id',$id)->update(['product_video'=>'']);

		$message = 'Video has been deleted successfully';
		session::flash('success_message',$message);
		return redirect()->back();
	}
	//Add Images
	public function addImages(Request $request,$id){
		if($request->isMethod('post')){
			$data = $request->all();

			 if($request->hasFile('images')){
			 	$images = $request->file('images');
			 	foreach($images as $key=>$image){
			 		$productImage = new ProductsImage;
			 		$image_tmp = Image::make($image);
			 		$extention = $image->getClientOriginalExtension();
			 		$imageName = rand(111,999999).time().".".$extention;
			 		$large_image_path = 'images/product_images/large/'.$imageName;
$medium_image_path = 'images/product_images/medium/'.$imageName;
$small_image_path = 'images/product_images/small/'.$imageName;
//Upload Images
Image::make($image_tmp)->save($large_image_path); // W:1040 H:1200
Image::make($image_tmp)->resize(null,600,function ($constraint) {
    $constraint->aspectRatio();
})->save($medium_image_path);
Image::make($image_tmp)->resize(null,200,function ($constraint) {
    $constraint->aspectRatio();
})->save($small_image_path);
    $productImage->image = $imageName;
    $productImage->product_id = $id;
    $productImage->status = 1;
    $productImage->save();
			 	}


			 	$message = 'Фото добавлены';
		session::flash('success_message',$message);
			 return redirect()->back();

			 }
		}
		$productdata = Product::with('images')->select('id','product_name','product_code','product_main_image')->find($id);
		$productdata = json_decode(json_encode($productdata),true);
		//echo "<pre>";print_r($productdata);die;
return view('admin.products.add_images')->with(compact('productdata'));
	}

public function deleteImage($id){
        // Get Product Image
        $productImage = ProductsImage::select('image')->where('id',$id)->first();

        // Get Product Image Paths
        $small_image_path = 'images/product_images/small/';
        $medium_image_path = 'images/product_images/medium/';
        $large_image_path = 'images/product_images/large/';

        // Delete Product small image if exits in small folder
        if(file_exists($small_image_path.$productImage->image)){
            unlink($small_image_path.$productImage->image);
        } 

        // Delete Product medium image if exits in medium folder
        if(file_exists($medium_image_path.$productImage->image)){
            unlink($medium_image_path.$productImage->image);
        } 

        // Delete Product large image if exits in large folder
        if(file_exists($large_image_path.$productImage->image)){
            unlink($large_image_path.$productImage->image);
        } 

        // Delete Product Image from products_images table
        ProductsImage::where('id',$id)->delete();

        $message = 'Product image has been deleted successfully!';
        session::flash('success_message',$message);
        return redirect()->back();
        
    }
}
