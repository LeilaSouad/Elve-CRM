<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\Category;
use Session;
use App\Models\Sections;
use App\Models\Section;
use Image;




class CategoryController extends Controller
{
    public function categories (){
    	Session::put('page','categories');
    	$categories = Category::with(['section','parentcategory'])->get();
    	//$categories = json_decode(json_encode($categories));
    	//echo "<pre>";print_r($categories); die;
    	return view ('admin.categories.categories')->with(compact('categories'));

    }



    public function updateCategoryStatus(Request $request){

    	if($request->ajax()){
    		$data = $request->all();
    		//echo "<pre>";print_r($data); die;
    		if($data['status']=="Active"){
    			$status = 0;

    		}else{
    			$status = 1;
    		}
    		Category::where('id',$data['category_id'])->update(['status'=>$status]);

    		return response()->json(['status'=>$status, 'category_id'=>$data['category_id']]);

    	}
    }
    public function addeditCategory(Request $request,$id=null){
    	if($id==""){
    		$title="Добавить категорию";
    		//Add Category Functionality
    		$category = new Category;
    		$categorydata = array();
    		$getCategories = array();
    		$message = 'Категория успешно добавлена';

    	}
else{
	//Edit Category Functionality
	$title="Редактировать категорию";
	$categorydata =Category::where('id',$id)->first();
	$categorydata = json_decode(json_encode($categorydata),true);
	$getCategories = Category::with('subcategories')->where(['parent_id'=>0, 'section_id'=>$categorydata['section_id']])->get();
	$getCategories = json_decode(json_encode($getCategories),true);
	$category = Category::find($id);
	$message = "Категория успешно обновлена";}

if($request->isMethod('post')){
	$data = $request->all();
//Validation of Category Fields
	$rules=[
			'name' =>'required|regex:/^[\pL\s\-]+$/u',
			'section_id' => 'required',
			'url' => 'required',
			'category_image' => 'image|mimes:jpeg,bmp,png,jpg'

		];
		$customMessages=[
'name.required' => 'Название категории обязательно',
'name.regex' => 'Правильное название категории обязательно',
'section_id.required'=>'Поле "Раздел" обязательно',
'url.required'=>'Поле "Url" обязательно',
'category_image.image'=>'Неправильный формат изображения' 
		];
		$this->validate($request, $rules, $customMessages);
if(empty($data['description'])){
		$data['description']="";
	}
if(empty($data['meta_title'])){
		$data['meta_title']="";
	}

if(empty($data['meta_description'])){
		$data['description']="";
	}
	if(empty($data['description'])){
		$data['meta_description']="";
	}
	if(empty($data['section_id'])){
		$data['section_id']="";
	}
	if(empty($data['category_discount'])){
		$data['category_discount']="";
	}
if(empty($data['url'])){
		$data['url']="";
	}
	if(empty($data['image_alt'])){
		$data['image_alt']="";
	}
	if(empty($data['category_image'])){
		$data['category_image']="";
	}

	$category->parent_id = $data['parent_id'];
	$category->section_id = $data['section_id'];
	$category->name = $data['name'];
	$category->status = $data['status'];
	$category->url = $data['url'];
	$category->category_discount = $data['category_discount'];
	$category->category_image = $data['category_image'];
	$category->image_alt = $data['image_alt'];
	
	$category->description = $data['description'];
	$category->meta_title = $data['meta_title'];
	$category->meta_description = $data['meta_description'];
	$category->status = 1;
// Upload Category Image
            if($request->hasFile('category_image')){

                $image_tmp = $request->file('category_image');

                if($image_tmp->isValid()){
                    // Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // Generate New Image Name
                    $imageName = rand(111,99999).'.'.$extension;
                    $imagePath = 'images/category_images/'.$imageName;

                    // Upload the Image
                    Image::make($image_tmp)->resize(200, 200)->save($imagePath);
                    // Save Category Image
                    $category->category_image = $imageName;
                

                }
            }


	$category->save();
	session::flash('success_message',$message);
	return redirect ('admin/categories');


}

$getSections = Section::get();

return view ('admin.categories.add_edit_category')->with(compact('title', 'getSections','categorydata', 'getCategories'));

    }
    public function appendCategoryLevel(Request $request){
    	if($request->ajax()){
    		$data  = $request->all();
    		
    		$getCategories = Category::with('subcategories')->where(['section_id'=>$data['section_id'],'parent_id'=>0,'status'=>1])->get();
    		$getCategories = json_decode(json_encode($getCategories),true);
    		//echo "<pre>";print_r($getCategories);die;
    		return view ('admin.categories.append_categories_level')->with(compact('getCategories'));

    	}
    }

public function deleteCategoryImage($id){
	//Get Category Image
	$categoryImage = Category::select('category_image')->where('id',$id)->first();

	//Get Category Image Path
	$category_image_path = 'images/category_images/';

	//Delete Category Image from foldre if exists
	if(file_exists($category_image_path.$categoryImage->category_image)){
		unlink ($category_image_path.$categoryImage->category_image);
	}
		//Delete Category Image from Category Table
		Category::where('id',$id)->update(['category_image'=>'']);

		$message = 'Category Image has been deleted successfully';
		session::flash('success_message',$message);
		return redirect()->back();
	}
public function deleteCategory($id){
//Delete category
	Category::where('id',$id)->delete();
	$message = 'Category has been deleted successfully';
session::flash('success_message',$message);
		return redirect()->back();
}

}
