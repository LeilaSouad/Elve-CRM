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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Brands</li>
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
            <div class="card">
              
              <!-- /.card-header -->
            

            <div class="card">
              <div class="card-header">
                <h4>Brands</h4>
                <a href="{{ url('admin/add-edit-brand')}}" style="max-width:250px" class="btn btn-block btn-success float-right"> Add brand</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="brands" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th><th>Image</th>
                    <th>Name</th>
                    <th>Status</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                     
                  @foreach ($brands as $brand)
                 
                  <tr>
                    <td>{{ $brand->id }}</td>
                    <td>
                      <?php $image_path = "images/brand_images/".$brand->image;?>
                      @if(!empty($brand->image) && file_exists($image_path))<img style="width:50px" src="{{ asset('images/brand_images/'.$brand->image) }}">
                      @else <img style="width:50px" src="{{ asset('images/noimage.png') }}">
                      @endif
                    </td>
               
                <td>   @foreach($brand->languages as $brands){{ $brands->pivot->brand_name}}    @endforeach
                  
                    
                    <td>@if($brand->status==1)
                      <a class="updateBrandStatus" id="brand-{{ $brand->id }}" brand_id="{{ $brand->id }}" href="javascript:void(0)"><i class="fas fa-toggle-on" aria-hidden="true" status="Active"></i></a>
                    @else
                      <a class="updateBrandStatus" id="brand-{{ $brand->id }}" brand_id="{{ $brand->id }}" href="javascript:void(0)"><i class="fas fa-toggle-off" aria-hidden="true" status="Inactive"></i></a>
                    @endif&nbsp;&nbsp;&nbsp;&nbsp;
  <a title="Редактировать" href="{{url('admin/add-edit-brand-'.$brand->id) }}"><i class="far fa-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                      <a title="Удалить" href="javascript:void(0)" class="confirmDelete" record="brand"  recordid="{{ $brand->id }}" name="Brand" 
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
