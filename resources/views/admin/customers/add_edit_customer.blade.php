@extends ('layouts.admin_layout.admin_layout')
@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Контакты</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/customers') }}">Контакты</a></li>
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
        <form name="customerForm" id="CustomerForm" 
        @if(empty($customerdata ['id']))
        action="{{ url('/admin/add-edit-customer') }}"

@else  action="{{ url('/admin/add-edit-customer-'.$customerdata ['id']) }}"
@endif
         method="post" enctype="multipart/form-data">@csrf
        <div class="card card-default">
         
          <!-- /.card-header -->
          <div class="card-body">
            <div class="form-group">
                    <label for="last_name">Фамилия</label>
                    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Фамилия" 

                    @if(!empty($customerdata ['last_name'])) value="{{ $customerdata ['last_name'] }}"
                    @else value="{{ old('last_name') }}"
                    @endif>
                  </div>
                <div class="form-group">
                    <label for="first_name">Имя</label>
                    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Имя" 

                    @if(!empty($customerdata ['first_name'])) value="{{ $customerdata ['first_name'] }}"
                    @else value="{{ old('first_name') }}"
                    @endif>
                  </div>

      
            <div class="form-group">
                    <label for="address">Адрес</label>
                    <input type="text" class="form-control" name="address" id="address" placeholder="Адрес" 

                    @if(!empty($customerdata ['address'])) value="{{ $customerdata ['address'] }}"
                    @else value="{{ old('address') }}"
                    @endif>
                  </div>
 
       
            
      

                        <div class="form-group">
                    <label for="phone">Телефон</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Телефон"
@if(!empty($customerdata ['phone'])) value="{{ $customerdata ['phone'] }}"
                    @else value="{{ old('phone') }}"                   @endif>
                  </div>
<div class="form-group">
                   
                  </div>
                    
   

   <div class="form-group">
                    <label for="messenger">Мессенджер</label>
                    <input type="text" class="form-control" id="messenger" name="messenger" placeholder="Мессенджер"
@if(!empty($customerdata ['messenger'])) value="{{ $customerdata ['messenger'] }}"
                    @else value="{{ old('messenger') }}"                   @endif>
                  </div>
<div class="form-group">
                   
                  </div>
    <div class="form-group">
                    <label for="email">Почта</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Почта"
@if(!empty($customerdata ['email'])) value="{{ $customerdata ['email'] }}"
                    @else value="{{ old('email') }}"                   @endif>
                  </div>
<div class="form-group">
                   
                  </div>
 <div class="form-group">
                    <label for="comment">Комментарий</label>
                    <textarea type="text" class="form-control" id="comment" name="comment" placeholder="Комментарий">@if(!empty($customerdata ['comment'])) {{ $customerdata ['comment'] }}
                    @else {{ old('comment') }}@endif


</textarea>

                  </div>
                     <div class="form-group">
                 <label for="customer_type">Тип клиента</label>
                    <input type="text" class="form-control" id="customer_type" name="customer_type" placeholder="Тип клиента"
@if(!empty($customerdata ['customer_type'])) value="{{ $customerdata ['customer_type'] }}"
                    @else value="{{ old('customer_type') }}"                   @endif>
                  </div>
    <div class="form-group">
                    <label for="source">Источник</label>
                    <input type="text" class="form-control" id="source" name="source" placeholder="Источник"
@if(!empty($customerdata ['source'])) value="{{ $customerdata ['source'] }}"
                    @else value="{{ old('source') }}"                   @endif>
                  </div>
    <div class="form-group">
                    <label for="utm_campaign">Utm Campaign</label>
                    <input type="text" class="form-control" id="utm_campaign" name="utm_campaign" placeholder="Utm Campaign"
@if(!empty($customerdata ['utm_campaign'])) value="{{ $customerdata ['utm_campaign'] }}"
                    @else value="{{ old('utm_campaign') }}"                   @endif>
                  </div>
<div class="form-group">
                    <label for="utm_source">Utm Source</label>
                    <input type="text" class="form-control" id="utm_source" name="utm_source" placeholder="Utm Source"
@if(!empty($customerdata ['utm_source'])) value="{{ $customerdata ['utm_source'] }}"
                    @else value="{{ old('utm_source') }}"                   @endif>
                  </div>
                  <div class="form-group">
                    <label for="utm_term">Utm Term</label>
                    <input type="text" class="form-control" id="utm_term" name="utm_term" placeholder="Utm Term"
@if(!empty($customerdata ['utm_term'])) value="{{ $customerdata ['utm_term'] }}"
                    @else value="{{ old('utm_term') }}"                   @endif>
                  </div>
                  <div class="form-group">
                    <label for="utm_medium">Utm Medium</label>
                    <input type="text" class="form-control" id="utm_medium" name="utm_medium" placeholder="Utm Medium"
@if(!empty($customerdata ['utm_medium'])) value="{{ $customerdata ['utm_medium'] }}"
                    @else value="{{ old('utm_medium') }}"                   @endif>
                  </div>
                  <div class="form-group">
                    <label for="utm_content">Utm Content</label>
                    <input type="text" class="form-control" id="utm_content" name="utm_content" placeholder="Utm Content"
@if(!empty($customerdata ['utm_content'])) value="{{ $customerdata ['utm_content'] }}"utm_content
                    @else value="{{ old('utm_content') }}"                   @endif>
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