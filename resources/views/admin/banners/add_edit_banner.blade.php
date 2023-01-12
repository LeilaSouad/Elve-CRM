@extends ('layouts.admin_layout.admin_layout')
@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Менеджер баннеров</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/banners') }}">Баннеры</a></li>
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
<form name="bannerForm" id="BannerForm" 
        @if(empty($banner['id']))
        action="{{ url('/admin/add-edit-banner') }}"

@else  action="{{ url('/admin/add-edit-banner-'.$banner['id']) }}"
@endif
         method="post" enctype="multipart/form-data">@csrf
<div class="card card-default">
  <div class="card-header">
            <h2 class="card-title">{{ $title }}</h2></div>
          <!-- /.card-header -->
<div class="card-body">
<div class="col-md-12">


<div class="form-group">
<label for="image">Изображение</label>
<div class="input-group">
   <div class="form-group" >  <img style="height:200px" src="{{ asset('images/banner_images/'.$banner ['image']) }}" >
 </div>
      <div class="custom-file">
          <input type="file" name="image" id="image">
               
                  </div>
                    </div>
                  <div>Рекомендованый размер 1200х600px</div>
  @if(!empty($banner ['image']))
                   
 @endif

<div class="form-group">
  <label for="title">Название</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Название" 

                    @if(!empty($banner['title'])) value="{{ $banner['title'] }}"
                    @else value="{{ old('title') }}"
                    @endif>
                  </div>     
<div class="form-group"><label for="alt">Alt</label>
                    <input type="text" class="form-control" name="alt" id="alt" placeholder="alt" 

                    @if(!empty($banner ['alt'])) value="{{ $banner ['alt'] }}"
                    @else value="{{ old('alt') }}"
                    @endif> </div>
                    <div class="form-group">
  <label for="title">Ссылка</label>
                    <input type="text" class="form-control" name="url" id="url" placeholder="URL" 

                    @if(!empty($banner ['url'])) value="{{ $banner ['url'] }}"
                    @else value="{{ old('url') }}"
                    @endif>
                  </div>               
<div class="form-group">
                    <label for="description">Описание</label>
                    <textarea name="description" id="description" class="form-control" rows="5" placeholder="Описание"
                    >@if(!empty($banner ['description'])) {{ $banner ['description'] }}
                    @else {{ old('description') }}
                    @endif</textarea>
                  </div> 

                   
             

                  
                    
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>


</div>
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