@extends ('layouts.admin_layout.admin_layout')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Валюты</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Главная</a></li>
              <li class="breadcrumb-item active">Валюты</li>
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
                <h3 class="card-title">Валюты</h3>
                <a href="{{ url('admin/add-edit-currency')}}" style="max-width:250px" class="btn btn-block btn-success float-right">Добавить валюту</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="brands" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Статус</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($currencies as $currency)
                  <tr>
                    <td>{{ $currency->id }}</td>
                    
                    <td>{{ $currency->currency_name }}
                    </td>
                    <td>@if($currency->status==1)
                      <a class="updateCurrencyStatus" id="currency-{{ $currency->id }}" currency_id="{{ $currency->id }}" href="javascript:void(0)"><i class="fas fa-toggle-on" aria-hidden="true" status="Active"></i></a>
                    @else
                      <a class="updateCurrencyStatus" id="currency-{{ $currency->id }}" currency_id="{{ $currency->id }}" href="javascript:void(0)"><i class="fas fa-toggle-off" aria-hidden="true" status="Inactive"></i></a>
                    @endif&nbsp;&nbsp;&nbsp;&nbsp;
  <a title="Редактировать" href="{{url('admin/add-edit-currency-'.$currency->id) }}"><i class="far fa-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                      <a title="Удалить" href="javascript:void(0)" class="confirmDelete" record="currency"  recordid="{{ $currency->id }}" name="Currency" 
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
