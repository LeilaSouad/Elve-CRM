<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
use Session;
use App\Models\Admin;
use Image;

class AdminController extends Controller
{
    public function dashboard () {
    	Session::put('page','dashboard');
    	
    	return view('admin.admins.admin_dashboard');}

public function login(Request $request){
	if($request->isMethod('post')){
$data = $request ->all();
/*echo "pre"; print_r($data);die;*/
/* Валидация почты и пароля при входе в админку*/
$rules =[
'email' => 'required|email|max:255',
        'password' => 'required',

];
$customMessages =[

'email.required'=>'Ввведите email',
'email.email'=>'Введите email в формате test@test.com',
'password.required'=>'Введите пароль',

];
$this ->validate($request,$rules,$customMessages);
/* Валидация почты и пароля при входе в админку*/

if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']])){
return redirect('admin/dashboard');

}
else{
	Session::flash('error_message','Invalid Email or Password');
	return redirect ()->back();
}

	}
return view ('admin.admins.admin_login');
}
public function logout(){
Auth::guard('admin')->logout();
return redirect ('/admin');
}
public function chkCurrentPassword(Request $request)
{
	$data = $request->all();
	//echo "<pre>";print_r($data);
	
	if (Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)){

		echo "true";
	}else {
		echo "false";}
	}

public function admins (){
    	Session::put('page','admins');
    	$admins = Admin::get();
    	//echo "<pre>";print_r($categories); die;
    	
    	return view ('admin.admins.admins')->with(compact('admins'));
}
public function addAdmin(Request $request){
	if($request->isMethod('post')){
		$data = $request->all();
		//echo "<pre>";print_r($data);die;
		$adminCount =Admin::where('name', $data['name'])->count();
		if($adminCount>0){
			return redirect()->back()->with('error_message','User name already exists!');
								}
								else {
									$admin = new Admin;
									$admin->name = $data['name'];
									$admin->password = bcrypt($data['password']);

$admin->email = $data['email'];
$admin->first_name = $data['first_name'];
$admin->last_name = $data['last_name'];
$admin->post = $data['post'];
$admin->mobile = $data['mobile'];
$admin->type = $data['type'];
$admin->image = 'uuu';
$admin->status = 1;
$admin->save();
return redirect()->back()->with('success_message', 'Пользователь успешно добавлен');
	} 
}
	return view ('admin.admins.add_admin');

}

public function password (){
	Session::put('page','password');
	$adminDetails = Admin::where('email',Auth::guard('admin')->user()->email)->first();

return view ('admin.admins.admin_password')->with(compact('adminDetails'));

}

public function updateCurrentPassword(Request $request)

{
	if ($request->isMethod('post'))
	{
$data= $request->all();
//Check if current password is correct
if (Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)){
//Check if new and confirm passwords are matching
if($data['new_pwd']==$data['confirm_pwd'])
{
Admin::where('id',Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_pwd'])]);
Session::flash('success_message','Пароль обновлен');

}


else{
Session::flash('error_message','Пароли не совпадают');
	}
	}
	else{
Session::flash('error_message','Пароль неверный');
	}

return redirect ()->back();
	}
}
public function updateAdminDetails(Request $request){
	Session::put('page','admin-details');
	if ($request->isMethod('post')){
		$data=$request->all();
		//echo "<pre>";print_r($data);die;
		$rules=[
			'admin_name' =>'required|regex:/^([\pL\s\-]+$)/u',
			'admin_mobile' => 'required|numeric',
			'admin_image' => 'image'
		];
		$customMessages=[
'admin_name.required' => 'Имя обязательно',
'admin_name.alpha' => 'Правильное имя обязательно',
'admin_mobile.required'=>'Телефон обязателен',
'admin_mobile.numeric'=>'Правильный телефон обязателен',
'admin_image.image'=>'Неправильный формат изображения'];

		$this->validate($request, $rules, $customMessages);
		//Upload Image
		if ($request->hasFile('admin_image')){
			$image_tmp = $request->file('admin_image');
			if($image_tmp->isValid()){
				$extension = $image_tmp->getClientOriginalExtension();
				//Generate New Image
				$imageName = rand(111,99999).'.'.$extension;
				$imagePath = 'images/admin_images/admin_photos/'.$imageName;
				Image::make($image_tmp)->save($imagePath);

			}
			else if(!empty ($data['current_admin_image']))
			{
				$imageName = $data['current_admin_image'];
			}
			else {
				$imageName = "";
			}
		}

		//Update Admin Details
		Admin::where('email',Auth::guard('admin')->user()->email)->update(['name'=>$data['admin_name'], 'mobile'=>$data['admin_mobile'], 'image'=>$imageName]);
		session::flash('success_message', 'Данные пользователя обновлены');
		return redirect ()->back();

	}

	return view ('admin.admins.admin_details');
}
}