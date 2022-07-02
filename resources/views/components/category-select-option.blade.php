<option 
    value="{{ $category->id }}" 
    @if($categoryModel && $category->id === $categoryModel->parent_id) selected @endif
>
    {{ Str::repeat('—', $level) }} {{ $category->name }}
</option>

@php
    $level++;
@endphp


@foreach ($category->children as $child)
    <x-category-select-option :category="$child" :level="$level" :categoryModel="$categoryModel" />
@endforeach
