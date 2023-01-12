@extends ('layouts.admin_layout.admin_layout')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/receipts') }}">Приходные накладные</a></li>
              <li class="breadcrumb-item active">{{ $title }}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @if ($errors->any())
    <div class="alert alert-danger" style="margin-top:10px">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  @if(Session::has('success_message'))
      <div class="alert alert-success alert-dismissible fade show" style="margin-top:10px" role="alert">
        {{ Session::get('success_message') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
        <form name="receiptForm" class="form" id="ReceiptForm" 
        @if(empty($receiptdata ['id']))
        action="{{ url('/admin/add-edit-receipt') }}"

@else  action="{{ url('/admin/add-edit-receipt-'.$receiptdata ['id']) }}"
@endif
         method="post" enctype="multipart/form-data">@csrf
        <div class="card card-default">
          <div class="card-body">
              <div class="row mb-2">  
<div class="col-sm-6">
          <div class="form-group">
                    <label for="id">Номер документа</label>
                    <input type="text" class="form-control" id="id" name="id" disabled placeholder="Номер документа"
@if(!empty($receiptdata ['id'])) value="{{ $receiptdata ['id'] }}"
                    @else value="{{ old('id') }}"
                    @endif>
                  </div>

<div class="form-group">
                    <label for="supplier_id"> Поставщик</label>
                    <select name="supplier_id" id="supplier_id" class="form-control">
              
                  @foreach($suppliers as $supplier)
                  <option value="{{ $supplier['id'] }}" @if(!empty($receiptdata ['supplier_id']) && $receiptdata['supplier_id']==$supplier['id']) selected="" selected=""
                    @endif>{{ $supplier['supplier_name'] }}</option>
                  @endforeach
                   </select>
                  </div>
                  

                  <div class="form-group">
                    <label for="warehouse_id"> Зачислить на склад</label>
                    <select name="warehouse_id" id="warehouse_id" class="form-control">
                 
                  @foreach($warehouses as $warehouse)
                  <option value="{{ $warehouse['id'] }}" @if(!empty($receiptdata ['warehouse_id']) && $receiptdata['warehouse_id']==$warehouse['id']) selected="" selected=""
                    @endif>{{ $warehouse['warehouse_name'] }}</option>
                  @endforeach
                   </select>
                  </div>
</div>
<div class="col-sm-6">
                  <div class="form-group">
                    <label for="paid">Оплачено</label>
                    <input type="text" class="form-control" id="paid" name="paid" placeholder="Оплачено"
@if(!empty($receiptdata ['paid'])) value="{{ $receiptdata ['paid'] }}"
                    @else value="{{ old('paid') }}"
                    @endif>
                  </div>
 
<div class="form-group">
                    <label for="paid">Борг</label>
                    <input readonly type="text" class="form-control" id="debt" name="debt" placeholder="Борг"
 value="0">
                  </div>
                   
                  
                       
                    


                   
                  <!-- /.input group -->
              
                  
</div></div>
<div class="form-group">
  <table id="productsTable" class="table table-bordered table-striped" width="100%"><thead><tr>
  <th><i class="fas fa-bars"></i></th>
  <th>Id</th>
  <th>Артикул</th>
  <th>Наименование</th>
  <th>Количество</th>
  <th>Приходная цена</th>
  <th>Оптовая цена</th>
  <th>Расходная цена</th>
  <th>Скидка (%)</th>
</tr></thead>
 <tbody>
@foreach($products as $product)
<tr class="rows">
<td id="add-item-{{ $product['id'] }}"><i class="fas fa-plus"></i></td>
<td id="product_id-{{ $product['id'] }}">{{ $product['id'] }}</td>
<td id="product_code-{{ $product['id'] }}">{{ $product['product_code'] }}</td>
<td id="product_name-{{ $product['id'] }}">{{ $product['product_name'] }}</td>
<td id="product_quantity-{{ $product['id'] }}" >{{ $product['product_quantity'] }}</td>
<td id ="product_purchase_price-{{ $product['id'] }}">{{ $product['purchase_price'] }}</td>
<td id ="product_wholesale_price-{{ $product['id'] }}">{{ $product['wholesale_price'] }}</td>
<td id ="product_sale_price-{{ $product['id'] }}">{{ $product['sale_price'] }}</td>
<td id ="product_discount-{{ $product['id'] }}">{{ $product['product_discount'] }}</td>


  </tr>

 @push('scripts')

<script>


$('#productsTable').each(function() {
var item_id = "{{ $product['id'] }}";

	

$("#add-item-" + item_id + "").on('click', function() {

	
	var product_id = document.getElementById("product_id-"+ item_id +"").innerHTML;
	var product_code = document.getElementById("product_code-"+ item_id +"").innerHTML;
	var product_name = document.getElementById("product_name-"+ item_id +"").innerHTML;
	var product_quantity = 1;
	var product_purchase_price = document.getElementById("product_purchase_price-"+ item_id +"").innerHTML;
	var product_discount = document.getElementById("product_discount-"+ item_id +"").innerHTML;
	var item_subtotal = product_quantity * product_purchase_price;

var i = $(".itemsTabletr").length;
i++;

	
	$('#itemsTable tbody').append(
	"<tr class='itemsTabletr'>" +
	"<td><a id='DeleteButton'><i class='far fa-trash-alt'></i></a></td>" +
	"<td><input name='count[]' readonly value="+ +i+"></td>" +
	"<td><input id='product_id" + i +"'"+" name='product_id["+i+"]' readonly value="+ product_id +"></td>" +
	"<td>"+ product_code +"</td>" +
	"<td>"+ product_name +"</td>" +
	"<td><input id='item_quantity" + i +"'"+" type='text' name='item_quantity["+i+"]' class='quantity dynamic-input' value="+1+"></td>" +
	"<td><input id='item_price" + i +"'"+" type='text' name='item_price["+i+"]' class='price dynamic-input' value=" + product_purchase_price +"></td>" +
	"<td>кв.м.</td>" +
	"<td><input id='item_discount" + i +"'"+" type='text' name='item_discount["+i+"]' class='discount dynamic-input' value="+product_discount+"></td>" +
	"<td><input id='discountbynumber" + i +"'"+" type='text' name='discountbynumber["+i+"]' class='discountbynumber dynamic-input' value="+product_discount+"></td>" +
	"<td><input id='item_subtotal" + i +"'"+" class='subtotal dynamic-input' name='item_subtotal["+i+"]' type='text' value="+item_subtotal+"></td>" +
	"</tr>");
	
 
  });
		
 
  });

	</script>

@endpush
  
@endforeach


</tbody> </table>




 <style>
   input { 
   width:100%;
   }
  </style>
</div>

<div class="form-group">


  <table class="product-table table table-bordered" id="itemsTable" width="100%" ><thead><tr>
 <th><i class="fas fa-bars"></i></th>
  <th>№</th>
  <th>ID</th>
  <th>Артикул</th>
  <th>назва</th>
  <th>Кол-во</th>
  <th>Ціна</th>
<th>Од.вим.</th>
<th>Знижка %</th>
<th>Знижка, грн</th>
<th>Сума</th>
</tr></thead>
<tbody>
 @foreach($receipt->products as $key => $item)
 <tr class="itemsTabletr">
<td><a id='DeleteButton'><i class="far fa-trash-alt"></i></a></td>
 <td  id="count-number{{ $key + 1 }}"> <input type="'text" readonly name="count[]" value="{{ $loop->iteration }}"></td>
 <td> 
 <input type="text" style="width:40px" class="dynamic-input" readonly id="product_id{{ $key + 1 }}" name="product_id[]" value="{{ $item['id']}}"  >
</td>
 <td>{{ $item['product_code']}}</td>
 <td>{{ $item['product_name']}}</td>
 <td><input type="text" class="quantity dynamic-input" id="item_quantity{{ $key + 1 }}" name="item_quantity[{{ $key }}]"  value="{{ number_format($item->pivot->item_quantity,2) }}" ></td>
 <td><input type="text" class="dynamic-input price" id="item_price{{ $key + 1 }}" name="item_price[{{ $key }}]" value="{{ number_format( $item->pivot->item_price,2 ) }}" ></td>
 <td>кв.м.</td>
 <td><input type="text" class="dynamic-input discount" id="item_discount{{ $key + 1 }}" name="item_discount[{{ $key }}]" value="{{ number_format($item->pivot->item_discount,2) }}"></td>
 <td><input type="text" class="discountbynumber dynamic-input" name="discountbynumber[{{ $key }}]" value="0"></td>
 <td><input type="text" class="subtotal dynamic-input" id="item_subtotal{{ $key + 1 }}" name="item_subtotal[{{ $key }}]" value="{{ number_format($item->pivot->item_subtotal,2) }}"></td>
 </tr>
  @endforeach 
</tbody>
 <tfoot>
 <tr>
 <td colspan="10">ПДВ</td>
 <td></td>
 </tr>
 <tr>
 <td colspan="10">Знижка, грн</td>
 <td>
 <input id="discountnumber" type="text" name="discount"  value="0"></td>
 </td>
 </tr>
 </tr>
 <tr>
 <td colspan="10">Усього</td>
 <td > <input id="total" type="text" name="receipt_total"  
 	@if(!empty($receiptdata ['paid'])) value="{{ $receiptdata ['receipt_total'] }}"
                    @else value="{{ old('receipt_total') }}"
                    @endif></td>
 </tr>
 </tfoot> </table>

</div>
 <div class="form-group">
                  <label>Время создания</label>
                   
                        <div  id="created_at" name="created_at">
@if(empty($receiptdata ['created_on'])) {{ date('d.m.y H:i') }}
                    @else {{ date('d.m.Y H:i', strtotime($receiptdata ['created_at'])) }}
                    @endif   </div>                                 
                    <label>Время изменения</label>
<div id="updated_at" name="updated_at">
@if(empty($receiptdata ['updated_at'])) {{ date('d.m.y H:i') }}
                    @else {{ date('d.m.Y H:i', strtotime($receiptdata ['updated_at'])) }}
                    @endif </div>
                    <label>Время оплаты</label>
                    <div id="paid_on" name="paid_on" placeholder="Время оплаты">
@if(!empty($receiptdata ['paid_on'])) 
                    @else {{ old('paid_on') }}
                    @endif</div>
                    <label for="created_by">Создатель</label>
                    <div id="created_by" name="created_by" >
@if(empty($receiptdata ['created_by'])) {{ Auth:: guard('admin')->user()->last_name }}&nbsp;{{ Auth:: guard('admin')->user()->first_name }}
                    @else  {{ $receipt->admins->last_name }}&nbsp;{{ $receipt->admins->first_name }}
                    @endif</div></div>
 
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-primary" id="submit" disabled>Сохранить</button>
          </div>
        </div>
      </form>
        <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
 

	@endsection