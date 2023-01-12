<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use DB;
use PDF;
use Auth;
use App\Models\Adjustments;
use App\Models\Warehouse;
use App\Models\Product;
use App\Models\Admin;
use App\Models\Currency;
use Carbon\Carbon;
use NumberToWords\NumberToWords;
class AdjustmentController extends Controller
{
     public function adjustments (){
        Session::put('page','adjustments');
        $adjustments = Adjustments::with(['warehouses','admins'])->get();
        return view('admin.adjustments.adjustments')->with(compact('adjustments'));
    }
public function addeditAdjustment(Request $request,$id=null)
{
//Get customers

//Get Warehouses
$warehouses = Warehouse::get();
//Get Products
$products = Product::get();
//Get Currency
$currencies = Currency::get();

//Create New Adjustment
    if($id==""){
        
        $title="Добавить документ";
        $adjustment = new Adjustments;
        $adjustmentdata = array();
        $message = "Списание остатков успешно создано";}
//Edit Adjustment
    else {
        $title="Редактировать";
        $adjustmentdata = Adjustments::find($id);
        $adjustmentdata = json_decode(json_encode($adjustmentdata),true);
        $adjustment = Adjustments::find($id);
        $message = "Списание остатков успешно обновлено";}

    if($request->isMethod('post')){
        $data = $request->all();
        //Validation of Fields
       $rules=['warehouse_id' =>'required'];
       $customMessages=['warehouse_id.required' => 'Склад обязателен'];
        $this->validate($request, $rules, $customMessages);

        if(empty($data['currency_id'])){
            $data['currency_id']="";
        }   
        
        
        if(empty($data['subtotal'])){
            $data['subtotal']="";
        }
        if(empty($data['total'])){
            $data['total']="";
        }
       
       
        if(empty($data['note'])){
            $data['note']="";
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
        
       
    //Save Details in Table
  
    $adjustment->warehouse_id = $data['warehouse_id']; 
    $adjustment->currency_id = $data['currency_id'];   
    $adjustment->subtotal = $data['subtotal'];
    $adjustment->total = $data['total'];
    $adjustment->currency_rate = $data['currency_rate'];
    $adjustment->note = $data['note'];
    $adjustment->created_on = $data['created_on'];
    $adjustment->created_by = Auth:: guard('admin')->user()->id;
    $adjustment->updated_at = date('Y-m-d H:i:s');
    $adjustment->modified_on = $data['modified_on'];
    $adjustment->modified_by = Auth:: guard('admin')->user()->id;
    //Save to Database
    $adjustment->save();
    //Insert Input Data to Pivot Table
    $product_id = Product::with('adjustments')->find($id);
    $adjustment_id = $adjustment->id;
    foreach ($request->input('product_id') as $key => $itemId) {
     $itemstable[$itemId] = [
    'item_quantity' => $request->input('item_quantity.'.$key) ,
    'item_price' => $request->input('item_price.'.$key) ,
    'item_subtotal' => $request->input('item_subtotal.'.$key),];}
 //echo "<pre>";print_r( $itemstable );die;

//изменить количество товара в новом документе
        if($id == ""){
$adjustments = new Adjustments;
  foreach ($request->input('product_id') as $key => $itemId) {
     $new_quantity =  $request->input('item_quantity.'.$key) ;
DB::table('products')->where('id',$itemId)->decrement('product_quantity', $new_quantity);

$adjustment->products()->sync ($itemstable);  
}
//echo "<pre>";print_r($itemId);die;
} 
else{
    $adjustments =Adjustments::find($id);
    foreach ($adjustments->products as $key => $product) {
        $old_quantity = $product->pivot->item_quantity;
    $current_quantity = $old_quantity - $request->input('item_quantity.'.$key);
DB::table('products')->where('id',$product->id)->increment('product_quantity', $current_quantity);
}
 
foreach ($request->input('product_id') as $key => $itemrow) {
     $quantity =  $request->input('item_quantity.'.$key) ;
 

DB::table('products')->where('id',$itemrow)->whereNull('adjustments_products.product_id')->decrement('product_quantity', $quantity);


$adjustment->products()->sync ($itemstable);
} 
}
    session::flash('success_message', $message);
     return redirect ('admin/adjustments');
}
return view('admin.adjustments.add_edit_adjustment')->with(compact('title','adjustment','adjustmentdata','warehouses', 'products','currencies'));
}
// Generate PDF
    public function createPDF(Request $request,$id=null) {
      
      $adjustment = Adjustments::find($id);
     
     // echo "<pre>";print_r( $customers );die;
     
// create the number to words "manager" class
$numberToWords = new NumberToWords();
//Сумма прописью
$currencyTransformer = $numberToWords->getCurrencyTransformer('ua');
$total_formatted = $currencyTransformer->toWords($adjustment->total*100,'USD');
//echo "<pre>";print_r( $salesinvoice_total_formatted );die;
// share data to view
$pdf = PDF::loadView('admin.pdf.adjustments.pdf_view',compact('adjustment', 'total_formatted'));
// Show PDF file in Browser
      return $pdf->stream();}
//Delete Salesinvoice
public function deleteAdjustment($id){
    $adjustments = Adjustments::with('products')->find($id);
    foreach ($adjustments->products as $key => $product) {
DB::table('products')->where('id',$product->id)->increment('product_quantity',  $product->pivot->item_quantity);

}
    Adjustments::where('id',$id)->delete();
         $adjustments->products()->detach();
    $message = 'Документ успешно удален';
session::flash('success_message',$message);
        return redirect()->back();}
}


