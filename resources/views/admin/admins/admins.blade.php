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
              <li class="breadcrumb-item active">Пользователи</li>
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
                <h3 class="card-title">Пользователи</h3>
                <a href="{{ url('admin/add-admin')}}" style="max-width:250px" class="btn btn-block btn-success float-right">Добавить пользователя</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="brands" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th><th>Имя</th>
                    <th>Фамилия</th>
                     <th>Должность</th>
                      <th>Телефон</th>
                      <th>Email</th>
                   <th>Статус</th>
                   
           
                   
                   

                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($admins as $admin)
                  <tr>
                    <td>{{ $admin->id }}</td>
                 
                    <td>{{ $admin->first_name }}
                    </td>
                    <td>{{ $admin->last_name }}
                    </td>
                     <td>{{ $admin->post }}
                    </td>
                     <td>{{ $admin->mobile }}
                    </td>
                     <td>{{ $admin->email }}
                    </td>
                    <td>{{ $admin->status }}
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