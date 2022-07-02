<ul>
    @foreach ($categories as $category)
        <li class="mb-2">
            <a href="{{ route('category', ['category' => $category->slug]) }}" class="text-dark">{{ $category->name }}</a>
        </li>

        <x-categories-list :categories="$category->children" />
    @endforeach
</ul>
