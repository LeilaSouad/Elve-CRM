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
              <li class="breadcrumb-item"><a href="{{url('admin/brands') }}">Пользователи</a></li>
              <li class="breadcrumb-item active">{{ $title }}</li>
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
        <form name="userForm" id="UserForm" 
        @if(empty($userdata ['id']))
        action="{{ url('/admin/add-edit-user') }}"

@else  action="{{ url('/admin/add-edit-user-'.$userdata ['id']) }}"
@endif
         method="post" enctype="multipart/form-data">@csrf
        <div class="card card-default">
          <div class="card-header">
            <h2 class="card-title">{{ $title }}</h2>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
                <div class="form-group">
                    <label for="name">Имя</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Имя" 

                    @if(!empty($user ['name'])) value="{{ $user ['name'] }}"
                    @else value="{{ old('name') }}"
                    @endif>
                  </div>
  
            <div class="form-group">
                    <label for="url">Email</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="Email" 

                    @if(!empty($user ['email'])) value="{{ $user ['email'] }}"
                    @else value="{{ old('email') }}"
                    @endif>
                  </div>
 
       


 <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="Password" 

                    @if(!empty($user ['password'])) value="{{ $user ['password'] }}"
                    @else value="{{ old('password') }}"
                    @endif>
                  </div>
 
 
               
 <div class="form-group">
                    <label for="role"> Roles</label>
                    <select name="role" id="role" class="form-control">
                   
                 @foreach($getroles as $getrole )

@foreach ($user->roles as $role)


<option value="{{ $getrole['id'] }}"

@if(!empty($role->id) && $role->id == $getrole['id']) selected
@endif> {{ $getrole['name'] }}</option> 



                   @endforeach
     
                  @endforeach
                   </select>
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