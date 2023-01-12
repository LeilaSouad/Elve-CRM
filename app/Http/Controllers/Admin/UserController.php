<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Role;
use Session;
use Hash;
class UserController extends Controller
{
    
    public function users (){
    	Session::put('page','users');
    	$users = User::get();
    	//echo "<pre>";print_r($categories); die;
    	$roles = Role::with('users')->get();
    	return view ('admin.users.users')->with(compact('users','roles'));
}





    public function dashboard () {
    	Session::put('page','dashboard');
    	
    	return view('admin.users.user_dashboard');
    	
    	
}
public function settings (){
	Session::put('page','password');
	$userDetails = User::where('email',Auth::guard('admin')->user()->email)->first();

return view ('admin.users.user_settings')->with(compact('userDetails'));

}
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
return view ('admin.admin_login');
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
		echo "false";
	}




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
User::where('id',Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_pwd'])]);
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
public function updateUserDetails(Request $request){
	Session::put('page','user-details');
	if ($request->isMethod('post')){
		$data=$request->all();
		//echo "<pre>";print_r($data);die;
		$rules=[
			'user_name' =>'required|regex:/^([\pL\s\-]+$)/u',
			'user_mobile' => 'required|numeric',
			'user_image' => 'image'
		];
		$customMessages=[
'user_name.required' => 'Имя обязательно',
'user_name.alpha' => 'Правильное имя обязательно',
'user_mobile.required'=>'Телефон обязателен',
'user_mobile.numeric'=>'Правильный телефон обязателен',
'user_image.image'=>'Неправильный формат изображения' 
		];

		$this->validate($request, $rules, $customMessages);
		//Upload Image
		if ($request->hasFile('user_image')){
			$image_tmp = $request->file('user_image');
			if($image_tmp->isValid()){
				$extension = $image_tmp->getClientOriginalExtension();
				//Generate New Image
				$imageName = rand(111,99999).'.'.$extension;
				$imagePath = 'images/admin_images/admin_photos/'.$imageName;
				Image::make($image_tmp)->save($imagePath);

			}
			else if(!empty ($data['current_user_image']))
			{
				$imageName = $data['current_user_image'];
			}
			else {
				$imageName = "";
			}
		}

		//Update Admin Details
		Admin::where('email',Auth::guard('admin')->user()->email)->update(['name'=>$data['user_name'], 'mobile'=>$data['user_mobile'], 'image'=>$imageName]);
		session::flash('success_message', 'Данные пользователя обновлены');
		return redirect ()->back();

	}

	return view ('admin.users.user_details');
}



public function addeditUser(Request $request,$id=null)
{
	if($id==""){
		$title="Добавить";
		$user = new User;
		$userdata = array();
		$message = "Пользователь создан";



	}else {
		$title="Редактировать пользвователя";
		$userdata = User::find($id);
		$userdata = json_decode(json_encode($userdata),true);
		$user = User::find($id);
		$message = "Пользователь обновлен";

	

	}
	if($request->isMethod('post')){
		$data = $request->all();

	
		//Validation of Fields
	$rules=['name' =>'required', 'email' =>'required',
			

		];
	$customMessages=['name.required' => 'Имя обязательно',
	'email.required' => 'Email обязательно'
];

		$this->validate($request, $rules, $customMessages);

		//Save Details in Table

		
		$user->name = $data['name'];
		
		$user->email = $data['email'];

		$user->password = $data['password'];
		
$user = User::find($id);
foreach ($user->roles as $role){ 
$role_id = $role->id; 
$user_id = $user->id;
//echo "<pre>";print_r($role_id);die;
		};
		
$roleid = $request->input('role');
$user->roles()->sync($roleid);
		

			
		$user->save();
		session::flash('success_message', $message);
	
		return redirect ('admin/users');
	}

$getroles = Role::with('users')->get();

return view('admin.users.add_edit_user')->with(compact('title','user','userdata','getroles'));
}











public function deleteUser($id){
	$user = User::find($id);
	User::where('id',$id)->delete();
	$message = ' удален';
session::flash('success_message',$message);
		return redirect()->back();
}




}
