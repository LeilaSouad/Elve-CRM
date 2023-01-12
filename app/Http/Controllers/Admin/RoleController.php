<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\Role;
use App\Models\Permissions;

class RoleController extends Controller
{
    public function roles (){
    	Session::put('page','roles');
    	$roles = Role::get();
    	$permissions = Permissions::with('roles')->get();
    	return view ('admin.roles.roles')->with(compact('roles','permissions'));
}




public function addeditRole(Request $request,$id=null)
{
	if($id==""){
		$title="Добавить";
		$role = new Role;
		$roledata = array();
		$message = "Роль создана";



	}else {
		$title="Редактировать роль";
		$roledata = Role::find($id);
		$roledata = json_decode(json_encode($roledata),true);
		$role = Role::find($id);
		$message = "Роль обновлена";

	

	}
	if($request->isMethod('post')){
		$data = $request->all();
		
		//Validation of Fields
	$rules=['name' =>'required',
			

		];
	$customMessages=['name.required' => 'Имя обязательно',];

		$this->validate($request, $rules, $customMessages);

	
			


		//Save Details in Table

		
		$role->name = $data['name'];
		
		$role->slug = $data['slug'];
		$role=Role::find($id);
		foreach ($role->permissions as $permission){ 
$permission_id = $permission->id; 
$role_id = $role->id;
//echo "<pre>";print_r($permission_id);die;
		};
		
$permissionid = $request->input('permission');
$role->permissions()->sync($permissionid);
		
$role->save();
		session::flash('success_message', $message);

	
		return redirect ('admin/roles');
	}

$getpermissions = Permissions::with('roles')->get();

return view('admin.roles.add_edit_role')->with(compact('title','roledata','role','getpermissions'));
}


public function deleteRole($id){
	$role = Role::find($id);
	Role::where('id',$id)->delete();
	$message = 'Роль удалена';
session::flash('success_message',$message);
		return redirect()->back();
}
}
