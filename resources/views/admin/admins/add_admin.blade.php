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
              <li class="breadcrumb-item"><a href="{{url('admin/admins') }}">Admins</a></li>
              <li class="breadcrumb-item active">Добавить пользователя</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @if ($errors->any())
    <div class="alert alert-danger" style="margin-top:10px">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  @if(Session::has('success_message'))
      <div class="alert alert-success alert-dismissible fade show" style="margin-top:10px" role="alert">
        {{ Session::get('success_message') }}
 
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
        <form name="adminForm" id="AdminForm" 
        
        action="{{ url('/admin/add-admin') }}"
method="post" enctype="multipart/form-data">@csrf
        <div class="card card-default">
          <div class="card-header">
           
  <h2 class="card-title">Добавить пользователя</h2>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
                <div class="form-group">
                    <label for="name">Уникальное имя пользователя</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Имя" >
                  </div>
                  <div class="form-group">
                    <label for="password">Пароль</label>
                    <input type="text" class="form-control" name="password" id="password" placeholder="Пароль">
                  </div>
  <div class="form-group">
           <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                  </div>
                                   <div class="form-group">
   <label for="type">Уровень доступа</label>
                    <input type="text" class="form-control" name="type" id="type" placeholder="Уровень доступа">
                  </div>
                  <div class="form-group">
           <label for="first_name">Имя</label>
                    <input type="text" class="form-control" name="first_name" id="email" placeholder="Имя">
                  </div>
                  <div class="form-group">
           <label for="last_name">Фамилия</label>
                    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Фамилия">
                  </div>
                  <div class="form-group">
           <label for="post">Должность</label>
                    <input type="text" class="form-control" name="post" id="post" placeholder="Должность">
                  </div>
 
                  <div class="form-group">
   <label for="mobile">Телефон</label>
                    <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Телефон">
                  </div>
 
  
 
       


 
 

         


              
 
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Сохранить</button>
          </div>
        </div>
      </form>
        <!-- /.card -->

   
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>




@endsection