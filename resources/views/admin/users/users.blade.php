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
                <a href="{{ url('admin/add-edit-user')}}" style="max-width:250px" class="btn btn-block btn-success float-right">Добавить пользователя</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="brands" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th><th>Имя</th>
                   
                    <th>Роль</th>
                     <th>Действия</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($users as $user)
                  <tr>
                    <td>{{ $user->id }}</td>
                 
                    <td>{{ $user->name }}
                    </td>
                  
                    <td>
                       @foreach($user->roles as $role )
                       {{ $role['name'] }}
                       @endforeach
                    </td>

<td>
  <a title="Редактировать" href="{{url('admin/add-edit-user-'.$user->id) }}"><i class="far fa-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                      <a title="Удалить" href="javascript:void(0)" class="confirmDelete" record="receipt"  recordid="{{ $user->id }}" name="User" 
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