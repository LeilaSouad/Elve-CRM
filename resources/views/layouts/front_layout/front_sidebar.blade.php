 <?php 
use App\Models\Section;
$sections = Section::sections();
?>
 <div id="sidebar" class="span3">
        
        <ul id="sideManu" class="nav nav-tabs nav-stacked">
          @foreach ($sections as $section)
           @if(count($section['categories'])>0)
          <li class="subMenu"><a>{{$section['name']}}</a>
            <ul>
            <li class="divider"></li>
            @foreach ($section['categories'] as $category)
            <li class="nav-header"><a href="{{$category['url']}}"><i class="icon-chevron-right"></i><strong> {{$category['name']}}</strong></a></li>
            @foreach($category['subcategories'] as $subcategory)
            <li> <a href="{{$subcategory['url']}}">{{$subcategory['name']}}</a></li>
               @endforeach
               @endforeach
            </ul>
          </li>
           @endif
               @endforeach
            
            <ul>
              
              
        
        
      </div>