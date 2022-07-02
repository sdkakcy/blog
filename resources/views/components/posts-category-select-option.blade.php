<option 
    value="{{ $category->id }}"
    @if($post && $post->categories->contains('id', $category->id)) selected @endif
>
    {{ Str::repeat('—', $level) }} {{ $category->name }}
</option>

@php
    $level++;
@endphp

@foreach ($category->children as $child)
    <x-posts-category-select-option :category="$child" :level="$level" :post="$post" />
@endforeach
