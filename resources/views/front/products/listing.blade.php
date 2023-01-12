@extends('layouts.front_layout.front_layout')
@section('content')
<div class="span9">
			<ul class="breadcrumb">
				<li><a href="{{url('/')}}">Главная</a> <span class="divider">/</span></li>
				<li class="active"><?php echo $categoryDetails['breadcrumbs'];?></li>
			</ul>
			<h1> {{$categoryDetails['catDetails']['name']}} <small class="pull-right"> {{count($categoryProducts)}} products are available </small></h1>
			<hr class="soft"/>
			<p>
				{{$categoryDetails['catDetails']['description']}}
			</p>
			<hr class="soft"/>
			<form name="sortProducts" class="form-horizontal span6">
				<div class="control-group">
			
					<select name="sortProducts" id="sort">
					
						<option value="latest">Новые сначала</option>
						<option value="lowest_price"  @if(isset($_GET['sortProducts']) && $_GET['sortProducts']=="lowest_price") selected="" @endif>Дешевые сначала</option>
						<option value="highest_price" @if(isset($_GET['sortProducts']) && $_GET['sortProducts']=="highest_price") selected="" @endif>Дорогие сначала</option>
					</select>
				</div>
			</form>
			
			<div id="myTab" class="pull-right">
				<a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>
				<a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
			</div>
			<br class="clr"/>
			<div class="tab-content">
				<div class="tab-pane" id="listView">
		
	@foreach($categoryProducts as $product)
					<div class="row">
<div class="span2">
	@if(isset($product['product_main_image']))
							<?php $product_image_path = '';?>

@else

@endif


@if(!empty($product['product_main_image'])&&file_exists($product_image_path))

<img src="{{asset($product_image_path)}}" alt="">
@else <img src="{{asset('images/noimage.png')}}" alt=""></a>
@endif
						</div>
						<div class="span4">
							<h3>New | Available</h3>
							<hr class="soft"/>
							<p>{{$product['product_name']}} </p>
					
							<a class="btn btn-small pull-right" href="product_details.html">View Details</a>
								<p>{{$product['brand']['name']}}</p>
							<br class="clr"/>
						</div>
						<div class="span3 alignR">
							<form class="form-horizontal qtyFrm">
								<h3> $140.00</h3>
								<label class="checkbox">
									<input type="checkbox">  Adds product to compair
								</label><br/>
								
								<a href="product_details.html" class="btn btn-large btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>
								<a href="product_details.html" class="btn btn-large"><i class="icon-zoom-in"></i></a>
								
							</form>
						</div>
					</div>
						<hr class="soft"/>
						@endforeach
				
					
					
					
				</div>
				<div class="tab-pane  active" id="blockView">
					<ul class="thumbnails">
						@foreach($categoryProducts as $product)
						<li class="span3">
							<div class="thumbnail">
								<a href="product_details.html">
									@if(isset($product['product_main_image']))
									<?php $product_image_path = 'images/product_images/small/'.$product['product_main_image'];?>

@else
	<?php $product_image_path = '';?>

@endif


@if(!empty($product['product_main_image'])&&file_exists($product_image_path))

<img src="{{asset($product_image_path)}}" alt="">
@else <img src="{{asset('images/noimage.png')}}" alt=""></a>
@endif
								<div class="caption">
									<p>{{$product['product_name']}}</p>
									<p>{{$product['brand']['name']}}</p>
							
									<h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Rs.1000</a></h4>
								</div>
							</div>
						</li>
						
						
					@endforeach
					</ul>
					<hr class="soft"/>
				</div>
			</div>
			<a href="compair.html" class="btn btn-large pull-right">Compair Product</a>
			<div class="pagination">
				@if(isset($_GET['sortProducts']) && !empty($_GET['sortProducts']))

{{ $categoryProducts->appends(['sortProducts' => $_GET['sortProducts']])->links() }}
				@else

{{ $categoryProducts->links() }}
				@endif
			</div>
			<br class="clr"/>
		</div>
@endsection