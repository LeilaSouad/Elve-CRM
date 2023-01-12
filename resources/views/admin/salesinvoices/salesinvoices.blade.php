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
              <li class="breadcrumb-item active">Расходные накладные</li>
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
                <h1 class="card-title">Расходные накладные</h1>
                <a href="{{ url('admin/add-edit-salesinvoice')}}" style="max-width:250px" class="btn btn-block btn-success float-right">Добавить расходную накладную </a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="salesinvoices" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                     <th>Поставщик</th>
                     <th>Склад</th>
                      <th>Сумма</th>
          
                       <th>Ответственный</th>
                      <th>Дата создания</th>
                        <th>Дата изменения</th>
                    <th>Статус</th>
                   
                   
                    
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($salesinvoices as $salesinvoice)
                  <tr>
                    <td>{{ $salesinvoice->id }}</td>
                    <td> {{ $salesinvoice->customers->last_name }}&nbsp;{{ $salesinvoice->customers->first_name }}</td>
                    <td> {{ $salesinvoice->warehouses->warehouse_name }}</td>
                     <td>{{ $salesinvoice->salesinvoice_total }}</td>
                     <td> {{ $salesinvoice->admins->last_name }} &nbsp; {{ $salesinvoice->admins->first_name }}</td>
                      <td>{{ date('d.m.Y H:i', strtotime($salesinvoice->created_at ))}}</td>
                       <td>{{ date('d.m.Y H:i', strtotime($salesinvoice->updated_at)) }}</td>
                    <td>
  <a title="Редактировать" href="{{url('admin/add-edit-salesinvoice-'.$salesinvoice->id) }}"><i class="far fa-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                      <a title="Удалить" href="javascript:void(0)" class="confirmDelete" record="salesinvoice"  recordid="{{ $salesinvoice->id }}" name="Warehouse" 
                       ><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                       <a href="{{ url('admin/salesinvoice-pdf-'.$salesinvoice->id) }}"><i class="fas fa-file-pdf"></i></a>

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
