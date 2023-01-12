@extends ('layouts.admin_layout.admin_layout')
@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Менеджер категорий</h1>
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
        <form name="categoryForm" id="CategoryForm" 
        @if(empty($categorydata['id']))
        action="{{ url('/admin/add-edit-category') }}"

@else  action="{{ url('/admin/add-edit-category-'.$categorydata['id']) }}"
@endif
         method="post" enctype="multipart/form-data">@csrf
        <div class="card card-default">
          <div class="card-header">
            <h2 class="card-title">{{ $title }}</h2>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Название</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Название категории" 

                    @if(!empty($categorydata['name'])) value="{{ $categorydata['name'] }}"
                    @else value="{{ old('name') }}"
                    @endif>
                  </div>
                      <div class="form-group">
                  <label>Статус категории</label>
                  <select name="status" id="status" class="form-control select2" style="width: 100%;">
                    <option value="0"

@if(!empty($categorydata['status'])) value="{{ $categorydata['status'] }}"
                    @else value="{{ old('status') }}"
                    @endif>Опубликовано</option> </select>
                </div>
              
                     <div class="form-group">
                  <label>Выбрать раздел</label>
                  <select name="section_id" id="section_id" class="form-control select2" style="width: 100%;">
                    <option value="">Выберите раздел</option>
                    @foreach($getSections as $section)
                    <option value="{{ $section->id }}"
                      @if(!empty($categorydata['section_id']) && $categorydata['section_id']==$section->id) selected
                      @endif>{{ $section->name }}</option>
                    @endforeach
            </select>
                </div>
                  <div id="appendCategoriesLevel">
                  @include('admin.categories.append_categories_level')
                </div>
                </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                    <label for="url">Url</label>
                    <input type="text" class="form-control" id="url" name="url" placeholder="Url категории"
@if(!empty($categorydata['url'])) value="{{ $categorydata['url'] }}"
                    @else value="{{ old('url') }}"
                    @endif>
                  </div>
                  <div class="form-group">
                    <label for="meta_title">Мета тайтл</label>
                    <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Мета тайтл"
                    @if(!empty($categorydata['meta_title'])) value="{{ $categorydata['meta_title'] }}"
                    @else value="{{ old('meta_title') }}"
                    @endif>
                  </div>
                  <div class="form-group">
                    <label for="meta_description">Мета описание</label>
                    <textarea name="meta_description" id="meta_description" class="form-control" rows="3" placeholder="Мета описание"
                    >@if(!empty($categorydata['meta_description'])) {{ $categorydata['meta_description'] }}
                    @else {{ old('meta_description') }}
                    @endif</textarea>
                  </div>
                   <div class="form-group">
                    <label for="category_discount">Скидка</label>
                    <input type="text" class="form-control" id="category_discount" name="category_discount" placeholder="Размер скидки"
                    @if(!empty($categorydata['category_discount'])) value="{{ $categorydata['category_discount'] }}"
                    @else value="{{ old('category_discount') }}"
                    @endif>
                  </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->   
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                        <label>Описание категории</label>
                        <textarea class="form-control" name="description" id="description" rows="3" placeholder="Описание категории"
                        >@if(!empty($categorydata['description'])) {{ $categorydata['description'] }}
                    @else {{ old('description') }}
                    @endif</textarea>
                      </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
        
            <div class="row">
              <div class="col-12">
                 <div class="form-group">
                    <label for="category_image">Изображение категории</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="category_image" id="category_image">
                        <label class="custom-file-label" for="category_image">Выбрать файл</label>
                      </div>
                    
                    </div></div>
  @if(!empty($categorydata['category_image']))
                    <div style="height:200px">  <img src="{{ asset('images/category_images/'.$categorydata['category_image']) }}"></div>
                      
                      <a href="javascript:void(0)" class="confirmDelete" record="category-image" recordid="{{ $categorydata['id'] }}" <?php /* href="{{url('admin/delete-category-image-'.$categorydata['id']) }}"*/?>>Delete Image</a>
                      @endif
                      <div class="form-group">
                    <label for="image_alt">Alt изображения</label>
                    <input type="text" class="form-control" name="image_alt" id="image_alt" placeholder="Alt изображения" @if(!empty($categorydata['image_alt'])) value="{{ $categorydata['image_alt'] }}"
                    @else value="{{ old('image_alt') }}"
                    @endif>
                  </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
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

<script>$(document).ready(function(){
  $('table tr').on('click', function(e) {
    $('table tr').removeClass('marked');
    $(this).addClass('marked');
  });
});</script>
<style>table tr.marked{
    background-color: tomato; /.здесь нужный цвет
}</style>


@endsection