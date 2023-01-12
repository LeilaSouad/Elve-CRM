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
              <li class="breadcrumb-item"><a href="#">Главная</a></li>
              <li class="breadcrumb-item active">Склады</li>
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
                <h3 class="card-title">Склады</h3>
                <a href="{{ url('admin/add-edit-warehouse')}}" style="max-width:250px" class="btn btn-block btn-success float-right">Добавить склад</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="brands" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Название</th>
                      <th>Адрес</th>
                    <th>Статус</th>
                   
                    
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($warehouses as $warehouse)
                  <tr>
                    <td>{{ $warehouse->id }}</td>
                    
                    <td>{{ $warehouse->warehouse_name }}
                    </td>
                     <td>{{ $warehouse->warehouse_address }}
                    </td>
                    <td>@if($warehouse->status==1)
                      <a class="updateWarehouseStatus" id="warehouse-{{ $warehouse->id }}" warehouse_id="{{ $warehouse->id }}" href="javascript:void(0)"><i class="fas fa-toggle-on" aria-hidden="true" status="Active"></i></a>
                    @else
                      <a class="updateWarehouseStatus" id="warehouse-{{ $warehouse->id }}" warehouse_id="{{ $warehouse->id }}" href="javascript:void(0)"><i class="fas fa-toggle-off" aria-hidden="true" status="Inactive"></i></a>
                    @endif&nbsp;&nbsp;&nbsp;&nbsp;
  <a title="Редактировать" href="{{url('admin/add-edit-warehouse-'.$warehouse->id) }}"><i class="far fa-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                      <a title="Удалить" href="javascript:void(0)" class="confirmDelete" record="warehouse"  recordid="{{ $warehouse->id }}" name="Warehouse" 
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
