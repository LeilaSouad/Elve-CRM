 
@extends ('layouts.admin_layout.admin_layout')
@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Настройки</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Настройки администратора</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

     <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Данные пользователя </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

   @if(Session::has('error_message'))
      <div class="alert alert-danger alert-dismissible fade show" style="margin-top:10px" role="alert">
        {{ Session::get('error_message') }}
 
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
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


@if ($errors->any())
    <div class="alert alert-danger" style="margin-top:10px">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

              <form role="form" method="post" action="{{ url('/admin/user-details') }}" name="updateUserDetails" id="updateUserDetails" enctype="multipart/form-data">@csrf
                <div class="card-body">
    
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input  class="form-control" value="{{ Auth::guard('admin')->user()->email }}" readonly="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Уровень доступа</label>
                    <input  class="form-control" value="{{ Auth::guard('admin')->user()->type }}" readonly="">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Имя</label>
                    <input type="text" value="{{ Auth::guard('admin')->user()->name }}" class="form-control" id="admin_name" name="admin_name" placeholder="Введите имя" required="">
              
                  </div>
                   <div class="form-group">
                    <label for="exampleInputPassword1">Номер телефона</label>
                    <input type="text" value="{{ Auth::guard('admin')->user()->mobile }}" class="form-control" id="admin_mobile" name="admin_mobile" placeholder="Введите номер телефона" required="">
                  </div>
                   <div class="form-group">
                 

@if (!empty(Auth::guard('admin')->user()->image))
 <img src="{{ asset('images/admin_images/admin_photos/'.Auth::guard('admin')->user()->image ) }}" class="img-circle elevation-2" alt="User Image" style="width:100px;height:100px">
<input type="hidden" name="current_admin_image" value="{{ Auth::guard('admin')->user()->image }}" accept="image/*">
@endif

   
                    <input type="file" class="form-control" id="user_image" name="user_image" placeholder="Фото" >
                  </div>
                
                 <a href="{{ url('admin/password') }}" class="nav-link active">
                
                  <p>Изменить пароль</p>
                </a>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
              </form>



            </div>
          
          </div>
         
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection
#!/bin/bash
