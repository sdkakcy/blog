<div>
    <option value="{{ $category->id }}">{{ Str::repeat('—', $level) }} {{ $category->name }}</option>

    @foreach ($category->childrenRecursive as $child)
        <x-category-select-option :category="$child" :level="++$level" />
    @endforeach
</div>