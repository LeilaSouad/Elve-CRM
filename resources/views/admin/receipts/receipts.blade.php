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
              <li class="breadcrumb-item active">Приходные накладные</li>
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
                <h3 class="card-title">Приходные накладные</h3>
                <a href="{{ url('admin/add-edit-receipt')}}" style="max-width:250px" class="btn btn-block btn-success float-right">Добавить накладную </a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="receipts" class="table table-bordered table-striped">
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
                  @foreach ($receipts as $receipt)
                  <tr>
                    <td>{{ $receipt->id }}</td>
                    <td> {{ $receipt->suppliers->supplier_name }}</td>
                    <td> {{ $receipt->warehouses->warehouse_name }}</td>
                     <td>{{ $receipt->receipt_total }}</td>
                     <td> {{ $receipt->admins->last_name }} &nbsp; {{ $receipt->admins->first_name }}</td>
                      <td>{{ date('d.m.Y H:i', strtotime($receipt->created_at ))}}</td>
                       <td>{{ date('d.m.Y H:i', strtotime($receipt->updated_at)) }}</td>
                    <td>
  <a title="Редактировать" href="{{url('admin/add-edit-receipt-'.$receipt->id) }}"><i class="far fa-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                      <a title="Удалить" href="javascript:void(0)" class="confirmDelete" record="receipt"  recordid="{{ $receipt->id }}" name="Warehouse" 
                       ><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                       <a href="{{ url('admin/receipt-pdf-'.$receipt->id) }}"><i class="fas fa-file-pdf"></i></a>

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
