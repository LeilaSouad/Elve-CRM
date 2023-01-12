@extends ('layouts.admin_layout.admin_layout')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Баннеры</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Главная</a></li>
              <li class="breadcrumb-item active">Баннеры</li>
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
              
                <a href="{{ url('admin/add-edit-banner')}}" style="max-width:250px" class="btn btn-block btn-success float-right">Добавить баннер</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="banners" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th><th>Фото</th>
                    <th>Название</th>
                    <th>Статус</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($banners as $banner)
                  <tr>
                    <td>{{ $banner['id'] }}</td>
                    <td>
                      <?php $image_path = "images/banner_images/".$banner['image'];?>
                      @if(!empty($banner['image']) && file_exists($image_path))<img style="width:150px" src="{{ asset('images/banner_images/'.$banner['image']) }}">
                      @else <img style="width:150px" src="{{ asset('images/noimage.png') }}">
                      @endif
                    </td>
                    <td>{{ $banner['title'] }}
                    </td>
                    <td>@if($banner['status']==1)
                      <a class="updateBannerStatus" id="banner-{{ $banner['id'] }}" banner_id="{{ $banner['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-on" aria-hidden="true" status="Active"></i></a>
                    @else
                      <a class="updateBannerStatus" id="banner-{{ $banner['id'] }}" banner_id="{{ $banner['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-off" aria-hidden="true" status="Inactive"></i></a>
                    @endif&nbsp;&nbsp;&nbsp;&nbsp;
  <a title="Редактировать" href="{{url('admin/add-edit-banner-'.$banner['id']) }}"><i class="far fa-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                      <a title="Удалить" href="javascript:void(0)" class="confirmDelete" record="banner"  recordid="{{ $banner['id']}}" name="Banner" 
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