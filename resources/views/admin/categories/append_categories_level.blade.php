<div class="form-group">
<label>Выбрать вложенность категории</label>
<select name="parent_id" id="parent_id" class="form-control select2" style="width: 100%;"><option value="0"
@if(isset($categorydata['parent_id']) && $categorydata['parent_id']==0) selected="" @endif>Главная категория</option> 
@if(!empty($getCategories))
@foreach($getCategories as $category)
<option value="{{ $category['id'] }}" @if(isset($categorydata['parent_id']) && $categorydata['parent_id']==$category['id']) selected="" @endif>{{ $category['name'] }}</option>
@if(!empty($category['subcategories']))
@foreach($category['subcategories'] as $subcategory)
<option value="{{ $subcategory['id'] }}">&nbsp;&raquo;&nbsp;{{ $subcategory['name'] }}</option>
@endforeach
@endif
@endforeach
@endif
</select>
</div>
