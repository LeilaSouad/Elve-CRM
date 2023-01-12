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
              <li class="breadcrumb-item"><a href="{{url('admin/brands') }}">Brands</a></li>
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
        <form name="brandForm" id="BrandForm" 
        @if(empty($branddata ['id']))
        action="{{ url('/admin/add-edit-brand') }}"

@else  action="{{ url('/admin/add-edit-brand-'.$branddata ['id']) }}"
@endif
         method="post" enctype="multipart/form-data">@csrf
        <div class="card card-default">
          <div class="card-header">
            <h4>{{ $title }}</h4>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="form-group">
                  <label>Product Id</label>
                <input type="text" class="form-control" name="brand_id" id="brand_id" placeholder="Id" 

                    @if(!empty($branddata ['id'] )) value="{{ $branddata ['id']}} "
                    @else value="{{ old('id') }}"
                    @endif>
                </div>
                
                        <ul class="nav nav-tabs">
                         
                        
                           @foreach($languages as $index => $language)   
                          
                        
                         
  <li class="{{ $index == 0 ? 'active' : '' }}">
    <a data-toggle="tab" href="#{{$language->id}}">{{$language->language_name}}</a>
  </li>
  
 
   @endforeach
   
 
 
</ul>
       
    
                <div class="tab-content">
                  
           
                @foreach($brand->languages as $index => $brand)        
                 <div class="tab-pane {{ $index == 0 ? 'active in' : '' }}" id="{{$brand->pivot->language_id}}">
                
           
              
   
                       <div class="form-group">
               
                    <input type="text" class="form-control" name="language_id[]" id="language_id{{$brand->pivot->language_id}}" placeholder="Language" 

                    @if(!empty($brand->pivot->language_id) )
                    
                    
              
                    
                    
                    
                     value="{{ $brand->pivot->language_id}} "
                    @else value="{{ old('language_id') }}"
                   
                    @endif>
                
                
                </div>
                
                 
                 <div class="form-group">
                    <label for="brand_name">Name</label>
                    <input type="text" class="form-control" name="brand_name{{$brand->pivot->language_id}}" id="brand_name{{$brand->pivot->language_id}}" placeholder="Название товара" 

                    @if(!empty($brand->pivot->brand_name)) 
                    
                  
                    
                    
                    
                    value="{{ $brand->pivot->brand_name}} "
                    
                    
                    @else value="{{ old('brand_name') }}"
                    @endif>
                  </div>
  <div class="form-group">
                  <label>Status</label>
                  <select name="status{{$brand->pivot->language_id}}" id="status{{$brand->pivot->language_id}}" class="form-control" style="width: 100%;">
                    <option value="1"

@if(!empty($branddata ['status'])) value="{{ $branddata ['status'] }}"
                    @else value="{{ old('status') }}"
                    @endif>Published</option>
                    <option value="0"

@if(!empty($branddata ['status'])) value="{{ $branddata ['status'] }}"
                    @else value="{{ old('status') }}"
                    @endif>Unpublished</option> </select>
                </div>
            <div class="form-group">
                    <label for="brand_url">URL</label>
                    <input type="text" class="form-control" name="brand_url{{$brand->pivot->language_id}}" id="brand_url{{$brand->pivot->language_id}}" placeholder="URL" 

                    @if(!empty($brand->pivot->brand_url)) value="{{ $brand->pivot->brand_url}}"
                    @else value="{{ old('brand_url') }}"
                    @endif>
                  </div>
 
        <div class="form-group">
                    <label for="meta_title">Meta Title</label>
                    <input type="text" class="form-control" name="meta_title{{$brand->pivot->language_id}}" id="meta_title{{$brand->pivot->language_id}}" placeholder="Meta Title" 

                    @if(!empty($brand->pivot->meta_title)) value="{{ $brand->pivot->meta_title}}"
                    @else value="{{ old('meta_title') }}"
                    @endif>
                  </div>  

     <div class="form-group">
                    <label for="meta_description">Meta Description</label>
                    <input type="text" class="form-control" name="meta_description{{$brand->pivot->language_id}}" id="meta_description{{$brand->pivot->language_id}}" placeholder="Meta Description" 

                    @if(!empty($brand->pivot->meta_description)) value="{{ $brand->pivot->meta_description }}"
                    @else value="{{ old('meta_description') }}"
                    @endif>
                  </div>   
             
                  <div class="form-group">
                    <label for="brand_description"> Description</label>
                    <textarea name="brand_description{{$brand->pivot->language_id}}" id="brand_description{{$brand->pivot->language_id}}" class="form-control" rows="5" placeholder="Description"
                    >@if(!empty($brand->pivot->brand_description)) {{ $brand->pivot->brand_description }}
                    @else {{ old('brand_description') }}
                    @endif</textarea>
                  </div> 
                  
                 </div>
           
                  @endforeach
                
                 
                  </div>
                
                 
                  </div>
                    <div class="form-group">
                    <label for="image">Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="image" id="image">
                        <label class="custom-file-label" for="image">Choose</label>
                      </div>
                    
                    </div>
                  <div>Recommended 1040х1200</div></div>
  @if(!empty($branddata['image']))
                    <div class="form-group" style="height:200px">  <img src="{{ asset('images/brand_images/'.$branddata ['image']) }}">
                      
                    </div>
                    <div class="form-group">
                      <a href="javascript:void(0)" class="confirmDelete" record="brandimage" recordid="{{ $branddata ['id'] }}">Delete</a></div>

                   
                      @endif
                    
          </div>
        </div>


 
               

         


 
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </div>
      </form>
        <!-- /.card -->

   
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>




@endsection
