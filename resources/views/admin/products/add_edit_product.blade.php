@extends ('layouts.admin_layout.admin_layout')
@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Менеджер товаров</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/products') }}">Товары</a></li>
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
        <form name="productForm" id="ProductForm" 
        @if(empty($productdata ['id']))
        action="{{ url('/admin/add-edit-product') }}"

@else  action="{{ url('/admin/add-edit-product-'.$productdata ['id']) }}"
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
                    <label for="product_name">Название</label>
                    <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Название товара" 

                    @if(!empty($productdata ['product_name'])) value="{{ $productdata ['product_name'] }}"
                    @else value="{{ old('product_name') }}"
                    @endif>
                  </div>

            <div class="row">
              <div class="col-md-6"><div class="form-group">
                    <label for="product_code">Артикул</label>
                    <input type="text" class="form-control" name="product_code" id="product_code" placeholder="Артикул" 

                    @if(!empty($productdata ['product_code'])) value="{{ $productdata ['product_code'] }}"
                    @else value="{{ old('product_code') }}"
                    @endif>
                  </div>
 
                   <div class="form-group">
                  <label>Статус</label>
                  <select name="status" id="status" class="form-control" style="width: 100%;">
                    <option value="0"

@if(!empty($productdata ['status'])) value="{{ $productdata ['status'] }}"
                    @else value="{{ old('status') }}"
                    @endif>Опубликовано</option> </select>
                </div>

                     </div>
          
              <!-- /.col -->
              <div class="col-md-6">
                
<div class="form-group">
                    <label for="category_id">Категория</label>
                    <select name="category_id" id="category_id" class="form-control">
                    <option>Select</option>@foreach($categories as $section)
                    <optgroup label="{{ $section['name'] }}"></optgroup>
                    @foreach ($section['categories'] as $category)
                    <option value="{{ $category['id'] }}" 
                    @if(!empty(@old('category_id')) && $category['id']== @old('category_id'))
                     selected="" @elseif(!empty($productdata['category_id'])
                      && $productdata['category_id']==$category['id'])
                      selected="" @endif> &nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;{{$category['name']}}</option>
                    @foreach($category['subcategories'] as $subcategory)
                    <option value="{{ $subcategory['id'] }}" @if(!empty(@old('category_id'))&& $subcategory['id']==@old('category_id')) selected="" @elseif(!empty($productdata['category_id']) && $productdata['category_id'] ==$subcategory['id']) selected="" @endif>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;{{$subcategory['name']}}</option>
                    @endforeach
                    @endforeach
                  @endforeach</select>
                  </div>
            

<div class="form-group">
                    <label for="brand_id"> Бренд</label>
                    <select name="brand_id" id="brand_id" class="form-control">
                    <option>Выберите бренд</option>
                  @foreach($brands as $brand)
                   
                  <option value="{{ $brand['id'] }}" @if(!empty($productdata ['brand_id']) && $productdata['brand_id']==$brand['id']) selected="" selected=""
                    @endif>
                  
                     @foreach($brand->languages as $language)
                     {{ $language->pivot->brand_name}}</option>
                     @endforeach
                     @endforeach
                   
                   </select>
                  </div>



               
                   
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->     
                  <div class="form-group">
                    <label for="description">Описание</label>
                    <textarea name="description" id="description" class="form-control" rows="5" placeholder="Описание"
                    >@if(!empty($productdata ['description'])) {{ $productdata ['description'] }}
                    @else {{ old('description') }}
                    @endif</textarea>
                  </div> 
          </div>
        </div>


 <div class="card card-default">
          <div class="card-header">
            <h2 class="card-title">СЕО</h2>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
             
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            

<div class="form-group">
                    <label for="url">Url</label>
                    <input type="text" class="form-control" id="url" name="url" placeholder="Url категории"
@if(!empty($productdata ['url'])) value="{{ $productdata ['url'] }}"
                    @else value="{{ old('url') }}"
                    @endif>
                  </div>
                  <div class="form-group">
                    <label for="meta_title">Мета тайтл</label>
                    <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Мета тайтл"
                    @if(!empty($productdata ['meta_title'])) value="{{ $productdata ['meta_title'] }}"
                    @else value="{{ old('meta_title') }}"
                    @endif>
                  </div>
                  <div class="form-group">
                    <label for="meta_description">Мета описание</label>
                    <textarea name="meta_description" id="meta_description" class="form-control" rows="3" placeholder="Мета описание"
                    >@if(!empty($productdata ['meta_description'])) {{ $productdata ['meta_description'] }}
                    @else {{ old('meta_description') }}
                    @endif</textarea>
                  </div>



 
                  
                     
                     
                </div></div>



    <div class="card card-default">
          <div class="card-header">
            <h2 class="card-title">Цена</h2>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
             
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="form-group">
                    <label for="product_quantity">Количество</label>
                    <input type="text" class="form-control" name="  product_quantity" id="  product_quantity" placeholder="Количество" 

                    @if(!empty($productdata ['product_quantity'])) value="{{ $productdata ['product_quantity'] }}"
                    @elsе value="{{ old('product_quantity') }}"
                    @endif>
                  </div> 
                  <div class="form-group">
                    <label for="product_meters">Количество кв.м.</label>
                    <input type="text" class="form-control" name="product_meters" id="  product_meters" placeholder="Количество кв.м." 

                    @if(!empty($productdata ['product_meters'])) value="{{ $productdata ['product_meters'] }}"
                    @elsе value="{{ old('product_meters') }}"
                    @endif>
                  </div> 

<div class="form-group">
                    <label for="product_unit">Единица измерения</label>
                    <input type="text" class="form-control" name="product_unit" id="  product_unit" placeholder="Единица измерения" 

                    @if(!empty($productdata ['product_unit'])) value="{{ $productdata ['product_unit'] }}"
                    @else value="{{ old('product_unit') }}"
                    @endif>
                  </div> 


 
                  <div class="form-group">
                    <label for="sale_price">Розничная цена</label>
                    <input type="text" class="form-control" name="sale_price" id="sale_price" placeholder="Розничная цена" 

                    @if(!empty($productdata ['sale_price'])) value="{{ $productdata ['sale_price'] }}"
                    @else value="{{ old('sale_price') }}"
                    @endif>
                  </div>
                      <div class="form-group">
                    <label for="wholesale_price">Оптовая цена</label>
                    <input type="text" class="form-control" name="wholesale_price" id="wholesale_price" placeholder="Оптовая цена" 

                    @if(!empty($productdata ['wholesale_price'])) value="{{ $productdata ['wholesale_price'] }}"
                    @else value="{{ old('wholesale_price') }}"
                    @endif>
                  </div>
                      <div class="form-group">
                    <label for="product_discount">Скидка (%)</label>
                    <input type="text" class="form-control" name="product_discount" id="product_discount" placeholder="Скидка (%)" 

                    @if(!empty($productdata ['product_discount'])) value="{{ $productdata ['product_discount'] }}"
                    @else value="{{ old('product_discount') }}"
                    @endif>
                  </div>
                </div></div>

               
<div class="card card-default">
          <div class="card-header">
            <h2 class="card-title">Мультимедиа</h2>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
             
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">


            <div class="row">
              <div class="col-12">
               
               
                 <div class="form-group">
                    <label for="product_main_image">Изображение</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="product_main_image" id="product_main_image">
                        <label class="custom-file-label" for="product_main_image">Выбрать файл</label>
                      </div>
                    
                    </div>
                  <div>Рекомендованый размер 1040х1200</div></div>
  @if(!empty($productdata ['product_main_image']))
                    <div class="form-group" style="height:200px">  <img src="{{ asset('images/product_images/small/'.$productdata ['product_main_image']) }}">
                      
                    </div>
                    <div class="form-group">
                      <a href="javascript:void(0)" class="confirmDelete" record="productimage" recordid="{{ $productdata ['id'] }}">Удалить</a></div>

                   
                      @endif
                      <div class="form-group">
                    <label for="image_alt">Alt изображения</label>
                    <input type="text" class="form-control" name="image_alt" id="image_alt" placeholder="Alt изображения" @if(!empty($productdata ['image_alt'])) value="{{ $productdata ['image_alt'] }}"
                    @else value="{{ old('image_alt') }}"
                    @endif>
                  </div>

                <!-- /.form-group -->
                   <div class="form-group">
                    <label for="product_video">Видео</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="product_video" id="product_video">
                        <label class="custom-file-label" for="product_video">Выбрать файл</label>
                      </div>


                    
                    </div>@if(!empty($productdata['product_video']))
                      <div><a href="{{ url('videos/product_video/'.$productdata['product_video']) }}" download>Скачать</a>
 <a href="javascript:void(0)" class="confirmDelete" record="productvideo" recordid="{{ $productdata ['id'] }}">Удалить</a>

                      </div>
                      @endif </div>
                       

 
              <!-- /.col -->
            </div>
            <!-- /.row -->
</div>
              <!-- /.col -->      
</div>
          </div>
          <div class="card card-default">
          <div class="card-header">
            <h2 class="card-title">Габариты</h2>

        <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
  <div class="card-body">

        <div class="row">
              <div class="col-12">
                  <div class="form-group">
                    <label for="product_height">Высота</label>
                    <input type="text" class="form-control" name="  product_height" id="  product_height" placeholder="Высота" 

                    @if(!empty($productdata ['product_height'])) value="{{ $productdata ['product_height'] }}"
                    @else value="{{ old('product_height') }}"
                    @endif>
                  </div>
  <div class="form-group">
                    <label for="product_length">Длина</label>
                    <input type="text" class="form-control" name="product_length" id="product_length" placeholder="Длина" 

                    @if(!empty($productdata ['product_length'])) value="{{ $productdata ['product_length'] }}"
                    @else value="{{ old('product_length') }}"
                    @endif>
                  </div>
  <div class="form-group">
                    <label for="product_width">Ширина</label>
                    <input type="text" class="form-control" name="product_width" id="product_width" placeholder="Ширина" 

                    @if(!empty($productdata ['product_width'])) value="{{ $productdata ['product_width'] }}"
                    @else value="{{ old('product_width') }}"
                    @endif>
                  </div>
  <div class="form-group">
                    <label for="product_weight">Вес</label>
                    <input type="text" class="form-control" name="product_weight" id="product_weight" placeholder="Вес" 

                    @if(!empty($productdata ['product_weight'])) value="{{ $productdata ['product_weight'] }}"
                    @else value="{{ old('product_weight') }}"
                    @endif>
                  </div> 


                  
                    
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>


</div>

          </div>
 <div class="card card-default">
          <div class="card-header">
            <h2 class="card-title">Атрибуты</h2>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">

        <div class="row">
              <div class="col-12">

      <div class="form-group">
                    <label for="product_manufacturer">Производитель</label>
                    <input type="text" class="form-control" name="  product_manufacturer" id="  product_manufacturer" placeholder="Производитель" 

                    @if(!empty($productdata ['  product_manufacturer'])) value="{{ $productdata ['product_manufacturer'] }}"
                    @else value="{{ old('product_manufacturer') }}"
                    @endif>
                  </div>
                   <div class="form-group">
                    <label for="product_manufacturer">Псевдо</label>
                    <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Псевдоним" 

                    @if(!empty($productdata ['pseudo'])) value="{{ $productdata ['pseudo'] }}"
                    @else value="{{ old('pseudo') }}"
                    @endif>
                  </div>
                <div class="form-group">
                    <label for="product_form">Форма</label>
                    <input type="text" class="form-control" name="  product_form" id="  product_form" placeholder="Форма" 

                    @if(!empty($productdata ['  product_form'])) value="{{ $productdata ['  product_form'] }}"
                    @else value="{{ old(' product_form') }}"
                    @endif>
                  </div>
 <div class="form-group">
                    <label for="product_pyle_density">Плотность ворса</label>
                    <input type="text" class="form-control" name="  product_pyle_density" id="  product_pyle_density" placeholder="Плотность ворса" 

                    @if(!empty($productdata ['  product_pyle_density'])) value="{{ $productdata ['  product_pyle_density'] }}"
                    @else value="{{ old(' product_pyle_density') }}"
                    @endif>
                  </div>
 <div class="form-group">
                    <label for="product_pile_type">Тип ворса</label>
                    <input type="text" class="form-control" name="  product_pile_type" id="  product_pile_type" placeholder="Тип ворса" 

                    @if(!empty($productdata ['  product_pile_type'])) value="{{ $productdata ['  product_pile_type'] }}"
                    @else value="{{ old(' product_pile_type') }}"
                    @endif>
                  </div> 
  <div class="form-group">
                    <label for="  pile_height">Высота ворса</label>
                    <input type="text" class="form-control" name="    pile_height" id="   pile_height" placeholder="Высота ворса" 

                    @if(!empty($productdata ['    pile_height'])) value="{{ $productdata ['   pile_height'] }}"
                    @else value="{{ old('   pile_height') }}"
                    @endif>
                  </div>
 <div class="form-group">
                    <label for="product_fabric"> Материал</label>
                    <select name="product_fabric" id="product_fabric" class="form-control">
                    <option>Выберите материал</option>
                  @foreach($product_fabricArray as $product_fabric)
                  <option value="{{ $product_fabric }}" @if(!empty($productdata ['product_fabric']) && $productdata['product_fabric']==$product_fabric) selected="" selected=""
                    @endif>{{ $product_fabric }}</option>
                  @endforeach
                   </select>
                  </div>
                   <div class="form-group">
                    <label for="product_country">Страна</label>
                    <input type="text" class="form-control" name="  product_country" id="  product_country" placeholder="Страна" 

                    @if(!empty($productdata ['  product_country'])) value="{{ $productdata ['  product_country'] }}"
                    @else value="{{ old(' product_country') }}"
                    @endif>
                  </div> 
                       <div class="form-group">
                    <label for="product_type">Тип изделия</label>
                    <input type="text" class="form-control" name="  product_type" id="  product_type" placeholder="Тип изделия" 

                    @if(!empty($productdata ['  product_type'])) value="{{ $productdata ['  product_type'] }}"
                    @else value="{{ old(' product_type') }}"
                    @endif>
                  </div> 
                          <div class="form-group">
                    <label for="product_color">Цвет</label>
                    <input type="text" class="form-control" name="  product_color" id="  product_color" placeholder="Цвет" 

                    @if(!empty($productdata ['  product_color'])) value="{{ $productdata ['  product_color'] }}"
                    @else value="{{ old(' product_color') }}"
                    @endif>
                  </div> 
                            <div class="form-group">
                    <label for="product_warp">Основа</label>
                    <input type="text" class="form-control" name="  product_warp" id="  product_warp" placeholder="Основа" 

                    @if(!empty($productdata ['  product_warp'])) value="{{ $productdata ['  product_warp'] }}"
                    @elspe value="{{ old(' product_warp') }}"
                    @endif>
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
