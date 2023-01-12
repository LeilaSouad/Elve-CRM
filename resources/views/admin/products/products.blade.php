@extends ('layouts.admin_layout.admin_layout')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Категории</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard') }}">Панель управления</a></li>
              <li class="breadcrumb-item active">Товары</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          	@if(Session::has('success_message'))
      <div class="alert alert-success alert-dismissible fade show" style="margin-top:10px" role="alert">
        {{ Session::get('success_message') }}
 
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
            <div class="card">
              
              <!-- /.card-header -->
            

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Товары</h3>
<div > <a href="{{ url('admin/add-edit-product')}}" style="max-width:250px" class="btn btn-block btn-success float-right">Добавить товар</a></div>
             <div class="clear"></div>

                
              </div>

            
              <!-- /.card-header -->
              <div class="card-body">
                <table id="products" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th><th>Фото</th>
                    <th>Артикул</th>
                    <th>Название</th>
                    <th>Категория</th>
                    
                     
                   
          
                     <th>Статус</th>
                     <th>Действия</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($products as $product)
                  <tr>
                    <td>{{ $product->id }}</td>
                    <td>
                      <?php $product_image_path = "images/product_images/small/".$product->product_main_image;?>
                      @if(!empty($product->product_main_image) && file_exists($product_image_path))<img style="width:50px" src="{{ asset('images/product_images/small/'.$product->product_main_image) }}">
                      @else <img style="width:50px" src="{{ asset('images/product_images/noimage.png') }}">
                      @endif
                    </td>
                    <td>{{ $product->product_code }}</td>
                    <td>{{ $product->product_name }}
                    </td>
<td>{{ $product->category->name }}</td>




                    
                    <td>@if($product->status==1)

<a class="updateProductStatus" id="product-{{ $product->id }}" product_id="{{ $product->id }}" href="javascript:void(0)"><i class='fas fa-toggle-on' aria-hidden='true' status='Active'></i></a>
                    @else
                    <a class="updateProductStatus" id="product-{{ $product->id }}" product_id="{{ $product->id }}" href="javascript:void(0)"><i class='fas fa-toggle-off' aria-hidden='true' status='Inactive'></i></a>
                    @endif


                    </td>
                    <td>

<a title="Добавить фото" href="{{url('admin/add-images-'.$product->id) }}"><i class="far fa-images"></i></a>&nbsp;&nbsp;

                      <a title="Редактировать" href="{{url('admin/add-edit-product-'.$product->id) }}"><i class="far fa-edit"></i></a>&nbsp;&nbsp;
                      <a title="Удалить" href="javascript:void(0)" class="confirmDelete" record="product"  recordid="{{ $product->id }}" name="Product" 
                       ><i class="far fa-trash-alt"></i></a>
                    </td>
                    
                  </tr>
                 @endforeach
                  </tbody>

                 
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>




@endsection