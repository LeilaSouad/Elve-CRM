<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use DB;
use PDF;
use Auth;
use App\Models\Salesinvoice;
use App\Models\Customers;
use App\Models\Warehouse;
use App\Models\Product;
use App\Models\Admin;
use App\Models\Currency;
use Carbon\Carbon;
use NumberToWords\NumberToWords;
class SalesinvoiceController extends Controller
{
     public function salesinvoices (){
        Session::put('page','salesinvoices');
        $salesinvoices = Salesinvoice::with(['customers','warehouses','admins'])->get();
        return view('admin.salesinvoices.salesinvoices')->with(compact('salesinvoices'));
    }
public function addeditsalesinvoice(Request $request,$id=null)
{
//Get customers

$customers = Customers::get();
//Get Warehouses
$warehouses = Warehouse::get();
//Get Products
$products = Product::get();
//Get Currency
$currencies = Currency::get();

//Create New Salesinvoice
    if($id==""){
        
        $title="Добавить расходную накладную";
        $salesinvoice = new Salesinvoice;
        $salesinvoicedata = array();
        $message = "Расходная накладная успешно создана";}
//Edit Salesinvoice
    else {
        $title="Редактировать накладную";
        $salesinvoicedata = Salesinvoice::find($id);
        $salesinvoicedata = json_decode(json_encode($salesinvoicedata),true);
        $salesinvoice = Salesinvoice::find($id);
        $message = "Расходная накладная успешно обновлена";}

    if($request->isMethod('post')){
        $data = $request->all();
        //Validation of Fields
       $rules=['customer_id' =>'required','warehouse_id' =>'required'];
       $customMessages=['customer_id.required' => 'Поставщик обязателен','warehouse_id.required' => 'Склад обязателен'];
        $this->validate($request, $rules, $customMessages);

        if(empty($data['currency_id'])){
            $data['currency_id']="";
        }   
        
        if(empty($data['salesinvoice_quantity'])){
            $data['salesinvoice_quantity']="";
        }
        if(empty($data['salesinvoice_tax'])){
            $data['salesinvoice_tax']="";
        }
        if(empty($data['salesinvoice_subtotal'])){
            $data['salesinvoice_subtotal']="";
        }
        if(empty($data['salesinvoice_total'])){
            $data['salesinvoice_total']="";
        }
        if(empty($data['salesinvoice_discount'])){
            $data['salesinvoice_discount']="";
        }
        if(empty($data['salesinvoice_unit'])){
            $data['salesinvoice_unit']="";
        }
        if(empty($data['salesinvoice_note'])){
            $data['salesinvoice_note']="";
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
    $salesinvoice->customer_id = $data['customer_id'];
    $salesinvoice->warehouse_id = $data['warehouse_id']; 
    $salesinvoice->currency_id = $data['currency_id'];   
    $salesinvoice->salesinvoice_quantity = $data['salesinvoice_quantity'];
    $salesinvoice->salesinvoice_tax = $data['salesinvoice_tax'];
    $salesinvoice->salesinvoice_subtotal = $data['salesinvoice_subtotal'];
    $salesinvoice->salesinvoice_total = $data['salesinvoice_total'];
    $salesinvoice->salesinvoice_discount = $data['salesinvoice_discount'];
    $salesinvoice->salesinvoice_unit = $data['salesinvoice_unit'];
    $salesinvoice->currency_rate = $data['currency_rate'];
    $salesinvoice->salesinvoice_note = $data['salesinvoice_note'];
    $salesinvoice->paid = $data['paid'];
    $salesinvoice->paid_on = $data['paid_on'];
    $salesinvoice->created_on = $data['created_on'];
    $salesinvoice->created_by = Auth:: guard('admin')->user()->id;
    $salesinvoice->updated_at = date('Y-m-d H:i:s');
    $salesinvoice->modified_on = $data['modified_on'];
    $salesinvoice->modified_by = Auth:: guard('admin')->user()->id;
    //Save to Database
    $salesinvoice->save();
    //Insert Input Data to Pivot Table
    $product_id = Product::with('salesinvoices')->find($id);
    $salesinvoice_id = $salesinvoice->id;
    foreach ($request->input('product_id') as $key => $itemId) {
     $itemstable[$itemId] = [
    'item_quantity' => $request->input('item_quantity.'.$key) ,
    'item_discount' => $request->input('item_discount.'.$key) ,
    'item_price' => $request->input('item_price.'.$key) ,
    'item_subtotal' => $request->input('item_subtotal.'.$key),];}
 //echo "<pre>";print_r( $itemstable );die;
//изменить количество товара    
        if($id == ""){
$salesinvoices = new Salesinvoice;
  foreach ($request->input('product_id') as $key => $itemId) {
     $quantity =  $request->input('item_quantity.'.$key) ;
DB::table('products')->where('id',$itemId)->decrement('product_quantity', $quantity);

$salesinvoice->products()->sync ($itemstable);  
}
//echo "<pre>";print_r($itemId);die;
} 
else{
    $salesinvoices =Salesinvoice::find($id);
    foreach ($salesinvoices->products as $key => $product) {
        $old_quantity = $product->pivot->item_quantity;
    $current_quantity = $old_quantity - $request->input('item_quantity.'.$key);
DB::table('products')->where('id',$product->id)->increment('product_quantity', $current_quantity);
}
foreach ($request->input('product_id') as $key => $itemId) {
     $quantity =  $request->input('item_quantity.'.$key) ;
     $hasProduct = $salesinvoices->products()->where('product_id', $itemId)->exists();
     if(!$hasProduct){
DB::table('products')->where('id',$itemId)->increment('product_quantity', $quantity);
}
$salesinvoice->products()->sync ($itemstable);
} 
}
    session::flash('success_message', $message);
     return redirect ('admin/salesinvoices');
}
return view('admin.salesinvoices.add_edit_salesinvoice')->with(compact('title','salesinvoice','salesinvoicedata','customers','warehouses', 'products','currencies'));
}
// Generate PDF
    public function createPDF(Request $request,$id=null) {
      
      $salesinvoice = Salesinvoice::find($id);
      $customers = Salesinvoice::with('customers')->where('id',$id)->get();
     // echo "<pre>";print_r( $customers );die;
     
// create the number to words "manager" class
$numberToWords = new NumberToWords();
//Сумма прописью
$currencyTransformer = $numberToWords->getCurrencyTransformer('ua');
$salesinvoice_total_formatted = $currencyTransformer->toWords($salesinvoice->salesinvoice_total*100,'USD');
//echo "<pre>";print_r( $salesinvoice_total_formatted );die;
// share data to view
$pdf = PDF::loadView('admin.pdf.salesinvoices.pdf_view',compact('salesinvoice', 'salesinvoice_total_formatted','customers'));
// Show PDF file in Browser
      return $pdf->stream();}
//Delete Salesinvoice
public function deleteSalesInvoice($id){
    $salesinvoices = Salesinvoice::with('products')->find($id);
    foreach ($salesinvoices->products as $key => $product) {
DB::table('products')->where('id',$product->id)->decrement('product_quantity',  $product->pivot->item_quantity);

}
    Salesinvoice::where('id',$id)->delete();
         $salesinvoices->products()->detach();
    $message = 'Расходная накладная успешно удалена';
session::flash('success_message',$message);
        return redirect()->back();}
}


