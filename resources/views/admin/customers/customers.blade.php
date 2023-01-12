@extends ('layouts.admin_layout.admin_layout')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Контакты</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard') }}">Панель управления</a></li>
              <li class="breadcrumb-item active">Контакты</li>
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
      <div class="card-header">
                <h3 class="card-title">Клиенты</h3><div > <a href="{{ url('admin/add-edit-customer')}}" style="max-width:250px" class="btn btn-block btn-success float-right">Добавить</a></div>
             <div class="clear"></div>

                
              </div>

            
              <!-- /.card-header -->
   <div class="card-body">
      <table id="categories" class="table table-bordered table-striped">
<thead>
<tr>
                    <th>ID</th>
                    <th>Фамилия</th>
                    <th>Имя</th>
                    <th>Телефон</th>
                       <th>Адрес</th>
                       <th>Комментарий</th>
                     <th>Действия</th></tr>
                   </thead>
<tbody>
                  @foreach ($customers as $customer)

                  <tr>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->last_name }}
                    </td>
 <td>{{ $customer->first_name }}
                    </td>
 <td>{{ $customer->phone }}
                    </td>
 <td>{{ $customer->address }}
                    </td>

 <td>{{ $customer->comment }}
                    </td>         
                    <td><a href="{{url('admin/add-edit-customer-'.$customer->id) }}"><i class="far fa-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                      <a href="javascript:void(0)" class="confirmDelete" record="customer"  recordid="{{ $customer->id }}" name="Customer"><i class="far fa-trash-alt"></i></a>
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