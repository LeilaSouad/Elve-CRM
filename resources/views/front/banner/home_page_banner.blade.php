<?php use App\Models\Banner;
$getBanners = Banner::getBanners();
?>
@if(isset($page_name)&& $page_name = "index")
<div id="carouselBlk">
  <div id="myCarousel" class="carousel slide">
    <div class="carousel-inner">
      @foreach($getBanners as $key=> $banner)
      <div class="item @if($key==0) active @endif">
        <div class="container">
          <a @if(!empty($banner['url'])) href="{{ url($banner['url']) }} @endif"><img style="width:100%" src="{{ asset('images/banner_images/'.$banner['image']) }}" alt="{{ $banner['alt'] }}"/></a>
          <div class="carousel-caption">
            <h4>{{$banner['title']}}</h4>
            <p>{{$banner['description']}}</p>
          </div>
        </div>
      </div>
  @endforeach
    </div>
  
  </div>
</div>

@endif