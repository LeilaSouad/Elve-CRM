<?php

namespace App\Http\Controllers\Admin;
use App\Models\Brands;
use Session;
use Image;
use App\Models\Language;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    public function brands(){
    	Session::put('page','brands');
    	$brands = Brands::get();
    	return view('admin.brands.brands')->with(compact('brands'));
    }
    
    
    public function updateBrandStatus(Request $request){

    	if($request->ajax()){
    		$data = $request->all();
    		//echo "<pre>";print_r($data); die;
    		if($data['status']=="Active"){
    			$status = 0;

    		}else{
    			$status = 1;
    		}
    		Brands::where('id',$data['brand_id'])->update(['status'=>$status]);

    		return response()->json(['status'=>$status, 'brand_id'=>$data['brand_id']]);

    	}
    }
    
    public function addeditBrand(Request $request,$id=null)
{
	if($id==""){
		$title="Добавить производителя";
		$brand = new Brands;
		$branddata = array();
		$message = "Производитель создан";
		
	    $languages = Language::get();
	   
	   // echo "<pre>";print_r($languages);die;
		
		



	}else {
		$title="Редактировать производителя";
		$branddata = Brands::find($id);
		
		$branddata = json_decode(json_encode($branddata),true);
		$brand = Brands::find($id);
		$languages = Language::get();
		$hasLanguage =$brand->languages()->where('language_id',)->exists();
		
		$message = "Производитель обновлен";
		
	   
	    
	

	  
	    
	    // echo "<pre>";print_r($languages);die;
	  
	  //$languages = json_decode(json_encode($languages),true);
	 
	  //echo "<pre>";print_r($lang_id);die;

	
	}
	if($request->isMethod('post')){
		$data = $request->all();
		
		//Validation of Fields
	$rules=[
			
			'image' => 'image|mimes:jpeg,bmp,png,jpg'

		];
		

		$this->validate($request, $rules);
		
		
		
		
	 
	

		if(empty($data['image'])){
		$data['image'] = "";}
		else {$data['image'] = $data['image'];}
			


		
		
	
		
		
	


//Upload Brand Image
		if($request->hasFile('image')){
			$image_tmp = $request->file('image');
			if($image_tmp->isValid()){
				//Upload Image after Resize
				//Get Image Name
				$image_name = $image_tmp->getClientOriginalName();
				//Get Image Extension
				$extension = $image_tmp->getClientOriginalExtension();
				//Generate New Image Name
				$imageName = $image_name.'-'.rand().'.'.$extension;
				//Set Paths to Large, Medium and Small Images
				$image_path = 'images/brand_images/'.$imageName;
//Upload Images
Image::make($image_tmp)->resize(null,200,function ($constraint) {
    $constraint->aspectRatio();
})->save($image_path);
//Save Image in DB
$brand->image = $imageName;
			}
		}
		
		
		
		
		
		$language_id = Language::with('brands')->find($id);
		$brandtable = [];
		foreach($request->input('language_id') as $key => $language_id){
	
		
			$brandtable[$language_id] = [
			'brand_name' => $request->input('brand_name'.$language_id) ,
			'brand_description' => $request->input('brand_description'.$language_id) ,
			'meta_title' => $request->input('meta_title'.$language_id) ,
			'meta_description' => $request->input('meta_description'.$language_id),
			'brand_url' => $request->input('brand_url'.$language_id)];
			}
				
			
	
		//echo "<pre>";print_r($brandtable);die;
		$brand->save();
		$brand->languages()->sync($brandtable);
		
		
		
		
		session::flash('success_message', $message);
		return redirect ('admin/brands');
		
	
		

	
}
return view('admin.brands.add_edit_brand')->with(compact('title', 'brand', 'branddata','languages','hasLanguage'));
}


//Delete Brand
public function deleteBrand($id){
	$brand = Brands::find($id);
	Brands::where('id',$id)->delete();
	$message = 'Поизводитель удален';
session::flash('success_message',$message);
		return redirect()->back();
}


}
