<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use DB;
use PDF;
use Auth;
use App\Models\Receipts;
use App\Models\Suppliers;
use App\Models\Warehouse;
use App\Models\Product;
use App\Models\Admin;
use App\Models\Currency;
use Carbon\Carbon;
use NumberToWords\NumberToWords;
class ReceiptController extends Controller
{
     public function receipts (){
    	Session::put('page','receipts');
        $receipts = Receipts::with(['suppliers','warehouses','admins'])->get();
    	return view('admin.receipts.receipts')->with(compact('receipts'));
    }

public function addeditReceipt(Request $request,$id=null)
{
//Get Suppliers
$suppliers = Suppliers::get();
//Get Warehouses
$warehouses = Warehouse::get();
//Get Products
$products = Product::get();
//Get Currency
$currencies = Currency::get();

//Create New Receipt
	if($id==""){
		
		$title="Добавить";
		$receipt = new Receipts;
		$receiptdata = array();
		$message = "Приходная создана";}
//Edit Receipt
	else {
		$title="Редактировать накладную";
		$receiptdata = Receipts::find($id);
		$receiptdata = json_decode(json_encode($receiptdata),true);
		$receipt = Receipts::find($id);
		$message = "Накладная обновлена";}

	if($request->isMethod('post')){
		$data = $request->all();
		
		//Validation of Fields
	   $rules=['supplier_id' =>'required','warehouse_id' =>'required'];
	   $customMessages=['supplier_id.required' => 'Поставщик обязателен','warehouse_id.required' => 'Склад обязателен'];
		$this->validate($request, $rules, $customMessages);

		if(empty($data['currency_id'])){
			$data['currency_id']="";
		}	
		if(empty($data['cashorder_id'])){
			$data['cashorder_id']="";
		}
		if(empty($data['receipt_quantity'])){
			$data['receipt_quantity']="";
		}
		if(empty($data['receipt_tax'])){
			$data['receipt_tax']="";
		}
		if(empty($data['receipt_subtotal'])){
			$data['receipt_subtotal']="";
		}
		if(empty($data['receipt_total'])){
			$data['receipt_total']="";
		}
		if(empty($data['receipt_discount'])){
			$data['receipt_discount']="";
		}
		if(empty($data['receipt_unit'])){
			$data['receipt_unit']="";
		}
		if(empty($data['receipt_note'])){
			$data['receipt_note']="";
		}
		if(empty($data['currency_rate'])){
			$data['currency_rate']="";
		}
		if(empty($data['created_on'])){
			$data['created_on']="";
		}
		if(empty($data['created_by'])){
			$data['created_by']="";
		}
		if(empty($data['updated_at'])){
			$data['updated_at']="";
		}
		if(empty($data['modified_on'])){
			$data['modified_on']="";
		}
		
		if(empty($data['paid'])){
			$data['paid']="";
		}
		if(empty($data['paid_on'])){
			$data['paid_on']="";
		}
	//Save Details in Table
	$receipt->supplier_id = $data['supplier_id'];
	$receipt->warehouse_id = $data['warehouse_id'];	
	$receipt->currency_id = $data['currency_id'];	
	$receipt->cashorder_id = $data['cashorder_id'];
	$receipt->receipt_quantity = $data['receipt_quantity'];
	$receipt->receipt_tax = $data['receipt_tax'];
	$receipt->receipt_subtotal = $data['receipt_subtotal'];
	$receipt->receipt_total = $data['receipt_total'];
	$receipt->receipt_discount = $data['receipt_discount'];
	$receipt->receipt_unit = $data['receipt_unit'];
	$receipt->currency_rate = $data['currency_rate'];
	$receipt->receipt_note = $data['receipt_note'];
	$receipt->paid = $data['paid'];
	$receipt->paid_on = $data['paid_on'];
	$receipt->created_on = $data['created_on'];
	$receipt->created_by = Auth:: guard('admin')->user()->id;
	$receipt->updated_at = date('Y-m-d H:i:s');
	$receipt->modified_on = $data['modified_on'];
	$receipt->modified_by = Auth:: guard('admin')->user()->id;
    //Save to Database
    $receipt->save();
    //Insert Input Data to Pivot Table
    $product_id = Product::with('receipts')->find($id);
    $receipt_id = $receipt->id;


    foreach ($request->input('product_id') as $key => $itemId) {
  
     $itemstable[$itemId] = [
    'item_quantity' => $request->input('item_quantity.'.$key) ,
	'item_discount' => $request->input('item_discount.'.$key) ,
	'item_price' => $request->input('item_price.'.$key) ,
	'item_subtotal' => $request->input('item_subtotal.'.$key),];}
 //echo "<pre>";print_r( $itemstable );die;
//изменить количество товара    
      	if($id == ""){
$receipts = new Receipts;

  foreach ($request->input('product_id') as $key => $itemId) {
     $quantity =  $request->input('item_quantity.'.$key) ;
DB::table('products')->where('id',$itemId)->increment('product_quantity', $quantity);

$receipt->products()->sync ($itemstable);  
}
//echo "<pre>";print_r($itemId);die;


 
} 

else{
	  $receipts =Receipts::find($id);

	foreach ($receipts->products as $key => $product) {
		$old_quantity = $product->pivot->item_quantity;
	$current_quantity = $old_quantity - $request->input('item_quantity.'.$key);




	
DB::table('products')->where('id',$product->id)->decrement('product_quantity', $current_quantity);
}



foreach ($request->input('product_id') as $key => $itemId) {
     $quantity =  $request->input('item_quantity.'.$key) ;
     $hasProduct = $receipts->products()->where('product_id', $itemId)->exists();
     if(!$hasProduct){
DB::table('products')->where('id',$itemId)->increment('product_quantity', $quantity);
}
$receipt->products()->sync ($itemstable);
} 



}


      
     session::flash('success_message', $message);
	 return redirect ('admin/receipts');
}


return view('admin.receipts.add_edit_receipt')->with(compact('title','receipt','receiptdata','suppliers','warehouses', 'products','currencies'));
}
// Generate PDF
    public function createPDF(Request $request,$id=null) {
      
      $receipt = Receipts::find($id);
      $suppliers = Receipts::with('suppliers')->where('id',$id)->get();
     // echo "<pre>";print_r( $suppliers );die;
     
// create the number to words "manager" class
$numberToWords = new NumberToWords();
//Сумма прописью
$currencyTransformer = $numberToWords->getCurrencyTransformer('ua');
$receipt_total_formatted = $currencyTransformer->toWords($receipt->receipt_total*100,'USD');
//echo "<pre>";print_r( $receipt_total_formatted );die;
// share data to view
$pdf = PDF::loadView('admin.pdf.receipts.pdf_view',compact('receipt', 'receipt_total_formatted','suppliers'));
// Show PDF file in Browser
      return $pdf->stream();}
//Delete Receipt
public function deleteReceipt($id){
	$receipts = Receipts::with('products')->find($id);
	foreach ($receipts->products as $key => $product) {
DB::table('products')->where('id',$product->id)->decrement('product_quantity',  $product->pivot->item_quantity);

}
	Receipts::where('id',$id)->delete();
	     $receipts->products()->detach();
	$message = 'Накладная удалена';
session::flash('success_message',$message);
		return redirect()->back();}
}
