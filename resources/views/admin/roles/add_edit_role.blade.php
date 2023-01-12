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
              <li class="breadcrumb-item"><a href="{{url('admin/categories') }}">Категории</a></li>
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
        <form name="roleForm" id="RoleForm" 
        @if(empty($roledata['id']))
        action="{{ url('/admin/add-edit-role') }}"

@else  action="{{ url('/admin/add-edit-role-'.$roledata['id']) }}"
@endif
         method="post" enctype="multipart/form-data">@csrf
        <div class="card card-default">
          <div class="card-header">
            <h2 class="card-title">{{ $title }}</h2>

           
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            
             
                <div class="form-group">
                    <label for="name">Название</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Название категории" 

                    @if(!empty($roledata['name'])) value="{{ $roledata['name'] }}"
                    @else value="{{ old('name') }}"
                    @endif>
                  </div>
               
                  <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug"
                    @if(!empty($roledata['slug'])) value="{{ $roledata['slug'] }}"
                    @else value="{{ old('slug') }}"
                    @endif>
                  </div>
                  
             <div class="form-group">
                    <label for="permission"> Права</label>
                    <select name="permission" id="permission" class="form-control">
                   
                 @foreach($getpermissions as $getpermission )

@foreach ($role->permissions as $permission)


                  <option value="{{ $getpermission['id'] }}"

@if(!empty($permission->id) && $permission->id == $getpermission['id']) selected
@endif> {{ $getpermission['name'] }}</option> 



                
   
      @endforeach
                  @endforeach
                   </select>
                  </div>
                  
              <!-- /.col -->
          
        
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