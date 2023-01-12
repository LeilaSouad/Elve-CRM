@extends ('layouts.admin_layout.admin_layout')
@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Поставщики</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/suppliers') }}">Поставщики</a></li>
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
        <form name="supplierForm" id="SupplierForm" 
        @if(empty($supplierdata ['id']))
        action="{{ url('/admin/add-edit-supplier') }}"

@else  action="{{ url('/admin/add-edit-supplier-'.$supplierdata ['id']) }}"
@endif
         method="post" enctype="multipart/form-data">@csrf
        <div class="card card-default">
         
          <!-- /.card-header -->
          <div class="card-body">
                <div class="form-group">
                    <label for="supplier_name">Название</label>
                    <input type="text" class="form-control" name="supplier_name" id="supplier_name" placeholder="Название" 

                    @if(!empty($supplierdata ['supplier_name'])) value="{{ $supplierdata ['supplier_name'] }}"
                    @else value="{{ old('supplier_name') }}"
                    @endif>
                  </div>

      
            <div class="form-group">
                    <label for="supplier_address">Адрес</label>
                    <input type="text" class="form-control" name="supplier_address" id="supplier_address" placeholder="Адрес" 

                    @if(!empty($supplierdata ['supplier_address'])) value="{{ $supplierdata ['supplier_address'] }}"
                    @else value="{{ old('supplier_address') }}"
                    @endif>
                  </div>
 
       
            
         <div class="form-group">
                    <label for="supplier_tax_number">Код ЄДПРОУ</label>
                    <input type="text" class="form-control" id="supplier_tax_number" name="supplier_tax_number" placeholder="Код ЄДПРОУ"
@if(!empty($supplierdata ['supplier_tax_number'])) value="{{ $supplierdata ['supplier_tax_number'] }}"
                    @else value="{{ old('supplier_tax_number') }}"
                    @endif>
                  </div>
<div class="form-group">
                    <label for="supplier_iban">IBAN</label>
                    <input type="text" class="form-control" id="supplier_iban" name="supplier_iban" placeholder="IBAN"
@if(!empty($supplierdata ['supplier_iban'])) value="{{ $supplierdata ['supplier_iban'] }}"
                    @else value="{{ old('supplier_iban') }}"
                    @endif>
                  </div>

            <div class="form-group">
                    <label for="supplier_tax_bank">Банк</label>
                    <input type="text" class="form-control" name="supplier_tax_bank" id=" supplier_tax_bank" placeholder="Банк" 

                    @if(!empty($supplierdata ['supplier_tax_bank'])) value="{{ $supplierdata ['supplier_tax_bank'] }}"
                    @elsе value="{{ old('supplier_tax_bank') }}"
                    @endif>
                  </div> 

<div class="form-group">
                    <label for="supplier_tax_mfo">МФО банка</label>
                    <input type="text" class="form-control" name="  supplier_tax_mfo" id="supplier_tax_mfo" placeholder="Единица измерения" 

                    @if(!empty($supplierdata ['supplier_tax_mfo'])) value="{{ $supplierdata ['supplier_tax_mfo'] }}"
                    @else value="{{ old('supplier_tax_mfo') }}"
                    @endif>
                  </div> 


 
                  <div class="form-group">
                    <label for="supplier_email">Email</label>
                    <input type="text" class="form-control" name="supplier_email" id="supplier_email" placeholder="Почта" 

                    @if(!empty($supplierdata ['supplier_email'])) value="{{ $supplierdata ['supplier_email'] }}"
                    @else value="{{ old('supplier_email') }}"
                    @endif>
                  </div>
                      <div class="form-group">
                    <label for="supplier_discount_card">Дисконтная карта</label>
                    <input type="text" class="form-control" name="supplier_discount_card" id="supplier_discount_card" placeholder="Дисконтная карта" 

                    @if(!empty($supplierdata ['supplier_discount_card'])) value="{{ $supplierdata ['supplier_discount_card'] }}"
                    @else value="{{ old('supplier_discount_card') }}"
                    @endif>
                  </div>
                      <div class="form-group">
                    <label for="supplier_discount">Скидка (%)</label>
                    <input type="text" class="form-control" name="supplier_discount" id="supplier_discount" placeholder="Скидка (%)" 

                    @if(!empty($supplierdata ['supplier_discount'])) value="{{ $supplierdata ['supplier_discount'] }}"
                    @else value="{{ old('supplier_discount') }}"
                    @endif>
                  </div>
              
               
                  <div class="form-group">
                    <label for="supplier_bonus">Бонусы</label>
                    <input type="text" class="form-control" name="supplier_bonus" id="supplier_bonus"placeholder="Бонусы" 

                    @if(!empty($supplierdata ['supplier_bonus'])) value="{{ $supplierdata ['supplier_bonus'] }}"
                    @else value="{{ old('supplier_bonus') }}"
                    @endif>
                  </div>
  <div class="form-group">
                    <label for="supplier_additional_field">Дополнительное поле</label>
                    <input type="text" class="form-control" name="supplier_additional_field" id="supplier_additional_field" placeholder="Дополнительное поле" 

                    @if(!empty($suppliertdata ['supplier_additional_field'])) value="{{ $supplierdata ['supplier_additional_field'] }}"
                    @else value="{{ old('supplier_additional_field') }}"
                    @endif>
                  </div>
  <div class="form-group">
                    <label for="supplier_discount_card">Бонусная карта</label>
                    <input type="text" class="form-control" name="  supplier_discount_card" id="supplier_discount_card" placeholder="Бонусная карта" 

                    @if(!empty($supplierdata ['supplier_discount_card'])) value="{{ $supplierdata ['supplier_discount_card'] }}"
                    @else value="{{ old('supplier_discount_card') }}"
                    @endif>
                  </div>
 

                  
                    
   


 
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Сохранить</button>
          </div>
        </div>
      </form>
        <!-- /.card -->

   
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>




@endsection