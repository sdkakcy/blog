<ul>
    @foreach ($categories as $category)
        <li><a href="{{ route('category', ['category' => $category->slug]) }}">{{ $category->name }}</a></li>

        <x-categories-list :categories="$category->childrenRecursive" />
    @endforeach
</ul>
