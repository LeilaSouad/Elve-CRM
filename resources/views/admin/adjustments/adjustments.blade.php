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
              <li class="breadcrumb-item active">Списание остатков</li>
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
              <div class="card-header">
                <h1 class="card-title">Списание остатков</h1>
                <a href="{{ url('admin/add-edit-adjustment')}}" style="max-width:250px" class="btn btn-block btn-success float-right">Добавить документ </a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="adjustments" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                     <th>Склад</th>
                      <th>Сумма</th>
          
                       <th>Ответственный</th>
                      <th>Дата</th>
                        
                    <th>Статус</th>
                   
                   
                    
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($adjustments as $adjustment)
                  <tr>
                    <td>{{ $adjustment->id }}</td>
                    <td> {{ $adjustment->warehouses->warehouse_name }}</td>
                     <td>{{ $adjustment->total }}</td>
                     <td> {{ $adjustment->admins->last_name }} &nbsp; {{ $adjustment->admins->first_name }}</td>
                      <td>{{ date('d.m.Y H:i', strtotime($adjustment->created_on ))}}</td>
                      
                    <td>
  <a title="Редактировать" href="{{url('admin/add-edit-adjustment-'.$adjustment->id) }}"><i class="far fa-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                      <a title="Удалить" href="javascript:void(0)" class="confirmDelete" record="adjustment"  recordid="{{ $adjustment->id }}" name="Warehouse" 
                       ><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                       <a href="{{ url('admin/adjustment-pdf-'.$adjustment->id) }}"><i class="fas fa-file-pdf"></i></a>

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
