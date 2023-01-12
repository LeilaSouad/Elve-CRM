<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customers;
use Session;

class CustomerController extends Controller
{
    public function customers (){
    	Session::put('page','customers');
    	$customers = Customers::get();
    	//$categories = json_decode(json_encode($categories));
    	//echo "<pre>";print_r($categories); die;
    	return view ('admin.customers.customers')->with(compact('customers'));
}
public function deleteCustomer($id){
	Customers::where('id',$id)->delete();
	$message = 'Клиент удален';
session::flash('success_message',$message);
		return redirect()->back();
}


public function addEditCustomer(Request $request,$id=null)
{
	if($id==""){
		$title="Добавить";
		$customer = new Customers;
		$customerdata = array();
		$message = "Информация о контакте обновлена";



	}else {
		$title="Редактировать";
		$customerdata = Customers::find($id);
		$customerdata = json_decode(json_encode($customerdata),true);
		$customer = Customers::find($id);
		$message = "Информация о контакте обновлена";

		//echo "<pre>";print_r($productdata);die;

	}
	if($request->isMethod('post')){
		$data = $request->all();
		//echo "<pre>";print_r($data);die;
		
		//Validation of Fields
	$rules=[
			
			

		];
		$customMessages=[

		];

		$this->validate($request, $rules, $customMessages);

		//Save Supplier Details in Product Table
if(empty($data['first_name'])){
			$data['first_name'] = "";
		}
		if(empty($data['last_name'])){
			$data['	last_name'] = "";
		}

	if(empty($data['address'])){
			$data['address'] = "";
		}

if(empty($data['phone'])){
			$data['phone'] = "";
		}

		if(empty($data['email'])){
			$data['email'] = "";
		}
		if(empty($data['utm_content'])){
			$data['utm_content'] = "";
		}
	if(empty($data['utm_source'])){
			$data['utm_source'] = "";
		}

			if(empty($data['messenger'])){
			$data['messenger'] = "";
		}
			if(empty($data['source'])){
			$data['source'] = "";
		}
			if(empty($data['utm_medium'])){
			$data['utm_medium'] = "";
		}	if(empty($data['utm_term'])){
			$data['utm_term'] = "";
		}	if(empty($data['comment'])){
			$data['comment'] = "";
		}
		if(empty($data['customer_type'])){
			$data['customer_type'] = "";
		}if(empty($data['messenger'])){
			$data['messenger'] = "";
		}
		
		
		$customer->last_name = $data['last_name'];
		$customer->first_name = $data['first_name'];
		$customer->phone = $data['phone'];
		$customer->address = $data['address'];
		$customer->email = $data['email'];
		$customer->utm_content = $data['utm_content'];
		$customer->utm_term = $data['utm_term'];
		$customer->utm_medium = $data['utm_medium'];
		$customer->comment = $data['comment'];
		$customer->customer_type = $data['customer_type'];
		$customer->messenger = $data['messenger'];
		$customer->source = $data['source'];
		$customer->utm_source = $data['utm_source'];
		$customer->save();
		session::flash('success_message', $message);
		return redirect ('admin/customers');

	}
	

	return view('admin.customers.add_edit_customer')->with(compact('title','customer','customerdata'));
}


}
