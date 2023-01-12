<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Session;
use Image;
class BannerController extends Controller
{
    public function banners (){
        Session::put('page','banners');
        $banners = Banner::get()->toArray();
        return view ('admin.banners.banners')->with(compact('banners'));


    }

public function addeditBanner(Request $request, $id=null){
if($id==""){
$title = "Добавить баннер";
$banner = new Banner;
$message = "Баннер успешно создан";


}
else{
$title = "Редактировать баннер";
$banner = Banner::find($id);
$message = "Баннер успешно изменен";

}
if($request->isMethod('post')){

    $data = $request->all();
    $banner->title = $data['title'];
    $banner->url = $data['url'];
    $banner->alt = $data['alt'];
    $banner->description = $data['description'];
    $banner->status = 1;



    //Upload Product Image
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
                $banner_image_path = 'images/banner_images/'.$imageName;

//Upload Images
Image::make($image_tmp)->save($banner_image_path); // W:1040 H:1200

//Save Image in DB
$banner->image = $imageName;
    }
}   
$banner->save();
session::flash('success_message', $message);
return redirect ('admin/banners');
}
return view('admin.banners.add_edit_banner')->with(compact('title','banner'));

}
 public function updateBannerStatus(Request $request){

        if($request->ajax()){
            $data = $request->all();
            //echo "<pre>";print_r($data); die;
            if($data['status']=="Active"){
                $status = 0;

            }else{
                $status = 1;
            }
            Banner::where('id',$data['banner_id'])->update(['status'=>$status]);

            return response()->json(['status'=>$status, 'banner_id'=>$data['banner_id']]);

        }
    }


public function deleteBanner($id){
    //Get Banner
    $bannerImage = Banner::where ('id',$id)->first();
    //Get Banner Path
    $banner_image_path = 'images/banner_images/';
    //Delete Banner from Folder
    if(file_exists($banner_image_path.$bannerImage->image)){
        unlink ($banner_image_path.$bannerImage->image);
         }
         //Delete Banner from Table
        Banner::where('id',$id)->delete();
        session::flash('success_message', 'Баннер удален');
        return redirect ()->back();

   

}

}
