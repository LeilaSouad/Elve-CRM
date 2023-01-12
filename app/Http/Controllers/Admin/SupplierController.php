<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Suppliers;
use Session;

class SupplierController extends Controller
{
    public function suppliers (){
    	Session::put('page','suppliers');
    	$suppliers = Suppliers::get();
    	//$categories = json_decode(json_encode($categories));
    	//echo "<pre>";print_r($categories); die;
    	return view ('admin.suppliers.suppliers')->with(compact('suppliers'));
}
public function deleteSupplier($id){
	Suppliers::where('id',$id)->delete();
	$message = 'Поставщик удален';
session::flash('success_message',$message);
		return redirect()->back();
}


public function addEditSupplier(Request $request,$id=null)
{
	if($id==""){
		$title="Добавить";
		$supplier = new Suppliers;
		$supplierdata = array();
		$message = "Поставщик успешно создан";



	}else {
		$title="Редактировать";
		$supplierdata = Suppliers::find($id);
		$supplierdata = json_decode(json_encode($supplierdata),true);
		$supplier = Suppliers::find($id);
		$message = "Поставщик успешно обновлен";

		//echo "<pre>";print_r($productdata);die;

	}
	if($request->isMethod('post')){
		$data = $request->all();
		//echo "<pre>";print_r($data);die;
		
		//Validation of Fields
	$rules=[
			'supplier_name' =>'required'
			

		];
		$customMessages=[
'supplier_name.required' => 'Название обязательно'
		];

		$this->validate($request, $rules, $customMessages);

		//Save Supplier Details in Product Table


	if(empty($data['supplier_address'])){
			$data['supplier_address'] = "";
		}

if(empty($data['supplier_phone'])){
			$data['supplier_phone'] = "";
		}
if(empty($data['supplier_tax_number'])){
			$data['supplier_tax_number'] = "";
		}if(empty($data['supplier_iban'])){
			$data['	supplier_iban'] = "";
		}if(empty($data['supplier_tax_bank'])){
			$data['supplier_tax_bank'] = "";
		}
		if(empty($data['supplier_tax_mfo'])){
			$data['supplier_tax_mfo'] = "";
		}
	if(empty($data['supplier_email'])){
			$data['supplier_email'] = "";
		}

			if(empty($data['supplier_discount_card'])){
			$data['supplier_discount_card'] = "";
		}
			if(empty($data['supplier_price_type'])){
			$data['supplier_price_type'] = "";
		}
			if(empty($data['supplier_discount'])){
			$data['supplier_discount'] = "";
		}	if(empty($data['supplier_bonus'])){
			$data['supplier_bonus'] = "";
		}	if(empty($data['supplier_additional_field'])){
			$data['supplier_additional_field'] = "";
		}
			if(!empty($data['supplier_nds'])){
                $supplier->supplier_nds = "Yes";
            }else{
                $supplier->supplier_nds = "No";    
            }
		$supplier->supplier_name = $data['supplier_name'];
		$supplier->supplier_address = $data['supplier_address'];
		$supplier->supplier_phone = $data['supplier_phone'];
		$supplier->supplier_tax_number = $data['supplier_tax_number'];
		$supplier->supplier_iban = $data['supplier_iban'];
		$supplier->supplier_tax_bank = $data['supplier_tax_bank'];
		$supplier->supplier_tax_mfo = $data['supplier_tax_mfo'];
		$supplier->supplier_email = $data['supplier_email'];
		$supplier->supplier_discount_card = $data['supplier_discount_card'];
		$supplier->supplier_price_type = $data['supplier_price_type'];
		$supplier->supplier_discount = $data['supplier_discount'];
		$supplier->supplier_bonus = $data['supplier_bonus'];
		$supplier->save();
		session::flash('success_message', $message);
		return redirect ('admin/suppliers');

	}
	

	return view('admin.suppliers.add_edit_supplier')->with(compact('title','supplier','supplierdata'));
}


}
