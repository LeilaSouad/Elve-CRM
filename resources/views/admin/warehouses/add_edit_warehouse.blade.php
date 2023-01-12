@extends ('layouts.admin_layout.admin_layout')
@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Менеджер складов</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/currency') }}">Склады</a></li>
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
        <form name="warehouseForm" id="WarehouseForm" 
        @if(empty($warehousedata ['id']))
        action="{{ url('/admin/add-edit-warehouse') }}"

@else  action="{{ url('/admin/add-edit-warehouse-'.$warehousedata ['id']) }}"
@endif
         method="post" enctype="multipart/form-data">@csrf
        <div class="card card-default">
          <div class="card-header">
            <h2 class="card-title">{{ $title }}</h2>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
                <div class="form-group">
                    <label for="name">Название</label>
                    <input type="text" class="form-control" name="warehouse_name" id="warehouse_name" placeholder="Название" 

                    @if(!empty($warehousedata ['warehouse_name'])) value="{{ $warehousedata ['warehouse_name'] }}"
                    @else value="{{ old('warehouse_name') }}"
                    @endif>
                  </div>
  <div class="form-group">
                  <label>Статус</label>
                  <select name="status" id="tatus" class="form-control" style="width: 100%;">
                    <option value="0"

@if(!empty($warehousedata ['status'])) value="{{ $warehousedata ['status'] }}"
                    @else value="{{ old('status') }}"
                    @endif>Опубликовано</option> </select>
                </div>
            <div class="form-group">
                    <label for="warehouse_address">Код</label>
                    <input type="text" class="form-control" name="warehouse_address" id="warehouse_address" placeholder="Адрес" 

                    @if(!empty($warehousedata ['warehouse_address'])) value="{{ $warehousedata ['warehouse_address'] }}"
                    @else value="{{ old('warehouse_address') }}"
                    @endif>
                  </div>
 
        
                 
                
                     
          </div>
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