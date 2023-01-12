 @extends ('layouts.front_layout.front_layout')
 @section ('content')
 <div class="span9">
        <div class="well well-small">
          <h4>Featured Products <small class="pull-right">200+ featured products</small></h4>
          <div class="row-fluid">
            <div id="featured" class="carousel slide">
              <div class="carousel-inner">
                @foreach ($featuredProductsChunk as $key=>$featuredProduct)
                <div class="item @if($key=1) active @endif">
                  <ul class="thumbnails">
                      @foreach ($featuredProduct as $item)
                    <li class="span3">
                      <div class="thumbnail">
                        <i class="tag"></i>

                        <a href="product_details.html">

<?php $product_image_path = 'images/product_images/small/'.$item['product_main_image'];?>
@if(!empty($item['product_main_image'])&&file_exists($product_image_path))

<img src="{{asset($product_image_path)}}" alt="">
@else <img src="{{asset('images/noimage.png')}}" alt=""></a>
@endif
                        <div class="caption">
                          <p>{{$item['product_name']}}</p>
                          <h4><a class="btn" href="product_details.html">Купить</a> <span class="pull-right">{{$item['sale_price']}}</span></h4>
                        </div>
                      </div>
                    </li>
                     @endforeach
                  </ul>
                </div>
                  @endforeach
               </div>
            </div>
          </div>
        </div>
        <h4>Latest Products </h4>
        <ul class="thumbnails">
          @foreach ($latestProducts as $item)
          <li class="span3">
            <div class="thumbnail">
              
<?php $product_image_path = 'images/product_images/small/'.$item['product_main_image'];?>
@if(!empty($item['product_main_image'])&&file_exists($product_image_path))

<img src="{{asset($product_image_path)}}" alt="">
@else <img src="{{asset('images/noimage.png')}}" alt=""></a>
@endif
              <div class="caption">
                <p>{{$item['product_name']}}</p>
                
                
                <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Купить <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">{{$item['sale_price']}}</a></h4>
              </div>
            </div>
          </li>
          @endforeach
        </ul>
      </div>
      @endsection