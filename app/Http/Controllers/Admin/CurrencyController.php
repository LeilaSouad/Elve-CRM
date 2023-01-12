<?php

namespace App\Http\Controllers\Admin;
use App\Models\Currency;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class CurrencyController extends Controller
{
    public function currency (){
    	Session::put('page','currency');
  $currencies = Currency::get();
    	return view('admin.currency.currency')->with(compact('currencies'));
    }



public function updateCurrencyStatus(Request $request){

    	if($request->ajax()){
    		$data = $request->all();
    		//echo "<pre>";print_r($data); die;
    		if($data['status']=="Active"){
    			$status = 0;

    		}else{
    			$status = 1;
    		}
    		Currency::where('id',$data['currency_id'])->update(['status'=>$status]);

    		return response()->json(['status'=>$status, 'currency_id'=>$data['currency_id']]);

    	}
    }


public function addeditCurrency(Request $request,$id=null)
{
	if($id==""){
		$title="Добавить валюту";
		$currency = new Currency;
		$currencydata = array();
		$message = "Валюта создана";}
		else {
		$title="Редактировать валюту";
		$currencydata = Currency::find($id);
		$currencydata = json_decode(json_encode($currencydata),true);
		$currency = Currency::find($id);
		$message = "Валюта обновлена";}
	if($request->isMethod('post')){
		$data = $request->all();
		
		//Validation of Fields
	$rules=[
			'currency_name' =>'required'];
		$customMessages=[
'currency_name.required' => 'Название обязательно',

		];

		$this->validate($request, $rules, $customMessages);

	
			


		//Save Brand Details in Table

		$currency->currency_name = $data['currency_name'];
		$currency->currency_symbol = $data['currency_symbol'];
		
		$currency->currency_iso = $data['currency_iso'];
		
		$currency->currency_rate = $data['currency_rate'];
		$currency->status = $data['status'];
	
			
		$currency->save();
		session::flash('success_message', $message);
		return redirect ('admin/currency');
		

		

	
}
return view('admin.currency.add_edit_currency')->with(compact('title','currency','currencydata'));
}


public function deleteCurrency($id){
	$currency = Currency::find($id);
	Currency::where('id',$id)->delete();
	$message = 'Валюта удалена';
session::flash('success_message',$message);
		return redirect()->back();
}



}