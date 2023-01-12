<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Session;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
    {
    public function warehouses (){
    	Session::put('page','warehouses');
  $warehouses = Warehouse::get();
    	return view('admin.warehouses.warehouses')->with(compact('warehouses'));
    }


public function updateWarehouseStatus(Request $request){

    	if($request->ajax()){
    		$data = $request->all();
    		//echo "<pre>";print_r($data); die;
    		if($data['status']=="Active"){
    			$status = 0;

    		}else{
    			$status = 1;
    		}
    		Warehouse::where('id',$data['warehouse_id'])->update(['status'=>$status]);

    		return response()->json(['status'=>$status, 'warehouse_id'=>$data['warehouse_id']]);

    	}
    }


public function addeditWarehouse(Request $request,$id=null)
{
	if($id==""){
		$title="Добавить склад";
		$warehouse = new Warehouse;
		$warehousedata = array();
		$message = "Склад создан";



	}else {
		$title="Редактировать склад";
		$warehousedata = Warehouse::find($id);
		$warehousedata = json_decode(json_encode($warehousedata),true);
		$warehouse = Warehouse::find($id);
		$message = "Склад обновлен";

	

	}
	if($request->isMethod('post')){
		$data = $request->all();
		
		//Validation of Fields
	$rules=[
			'warehouse_name' =>'required'];
		$customMessages=[
'warehouse_name.required' => 'Название обязательно',

		];

		$this->validate($request, $rules, $customMessages);

	
			


		//Save Brand Details in Table

		$warehouse->warehouse_name = $data['warehouse_name'];
		$warehouse->warehouse_address = $data['warehouse_address'];
	
		
		$warehouse->status = $data['status'];
	
			
		$warehouse->save();
		session::flash('success_message', $message);
		return redirect ('admin/warehouses');
		

		

	
}
return view('admin.warehouses.add_edit_warehouse')->with(compact('title','warehouse','warehousedata'));
}


public function deleteWarehouse($id){
	$warehouse = Warehouse::find($id);
	Warehouse::where('id',$id)->delete();
	$message = 'Склад удален';
session::flash('success_message',$message);
		return redirect()->back();
}



}
