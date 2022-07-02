<div>
    <option value="{{ $category->id }}" @if($post && $post->categories->contains('id', $category->id)) selected @endif>{{ Str::repeat('—', $level) }} {{ $category->name }}</option>

    @foreach ($category->childrenRecursive as $child)
        <x-category-select-option :category="$child" :level="++$level" :post="$post" />
    @endforeach
</div>