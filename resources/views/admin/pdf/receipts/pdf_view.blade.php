
<!DOCTYPE html>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Прибуткова накладна №</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<style type="text/css">
    
    body{font-family: DejaVu Sans, sans-serif; 
        
    }
  
    .section{
        margin-top:30px;
        padding:50px;
        background:#fff;
    }
    .pdf-btn{
        margin-top:30px;
    }
</style>    
<body>
    <div class="container">
       
                    <p >Прибуткова накладна № {{$receipt->id}} від {{ $receipt->created_at }} </p>
                </div>
                <div class="panel-body">
                    <div class="main-div">
                          <table>
                            <tr>
                                  <td>Продавець</td>
                                  
                               @foreach ($suppliers as $supplier)
                            <td>
                           <p> {{$supplier->suppliers->supplier_name}}</p>
                           <p> {{$supplier->suppliers->supplier_phone}}</p>
                            <p>{{$supplier->suppliers->supplier_address}}</p>
                          <p>  {{$supplier->suppliers->supplier_tax_number}}</p>
                            <p>{{$supplier->suppliers->supplier_iban}}</p>
                            <p>{{$supplier->suppliers->supplier_tax_bank}}</p>
                          <p>  {{$supplier->suppliers->supplier_tax_mfo}}</p></td> @endforeach
                          
                            </tr>

                            <tr>  <td>Покупець</td>
                            <td></td></tr>

                          <tr>  <td>На підставі</td>
                            <td></td></tr></table>


<table border="1" width="100%"><thead><tr><th>
    №
</th>
<th>
    Артикул
</th>
<th>
    Код ДК
</th>
<th>
    Назва
</th>
<th>
    К-сть
</th>
<th>
    Од. вим.
</th>
<th>
    Ціна, грн
</th>
<th>
    Сума, грн
</th>
</tr></thead>
<tbody>
@foreach ($receipt->products  as $key => $item)
<tr>
    <td>{{ $key + 1 }}</td>
     <td>{{$item->product_code}}</td>
        <td>39532000-6</td>
      <td>{{$item->pseudo}}
</td>
 <td>{{$item->pivot->item_quantity * $item->meters}}</td>
  <td>кв.м.</td>
   <td>{{number_format($item->pivot->item_price/$item->meters,2)}}</td>
    <td>{{number_format($item->pivot->item_subtotal,2)}}</td>
</tr>@endforeach</tbody>
<tfoot><tr>
    <td colspan="7">ПДВ</td><td></td></tr><tr>
     <td colspan="7">Усього</td><td>{{number_format($receipt->receipt_total,2)}}</td>
</tr>
<tr>
     <td colspan="8"><strong>Сума прописом:{{$receipt_total_formatted}}</strong></td>
</tr></tfoot></table>
<table width="100%"><tr>
    <td>Відвантажив:</td>
<td>Отримав:</td></tr>
<tr><td><br><br>Підпис__________________</td><td><br><br>Підпис____________________</td></tr></table>




                            <div>
                                <p>*) Кількість та якість Товару засвідчується підписом Покупця під час отримання Товару.</p>
<p>**) Претензії та рекламації за Товаром здійснюються протягом 3 робочих днів.</p>
                            </div>
                        </div>
                </div>
       
</body>
</html>