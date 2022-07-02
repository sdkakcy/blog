@forelse ($posts as $post)
    <div class="card mb-3">
        <div class="card-body">
            <div class="mb-3">
                @foreach ($post->categories as $category)
                    <a href="{{ route('category', ['category' => $category->slug]) }}" class="text-decoration-none">
                        <span class="badge bg-light text-dark">{{ $category->name }}</span>
                    </a>
                @endforeach
            </div>
            <h4 class="card-title">{{ $post->subject }}</h4>
            <p class="card-text">{{ $post->summary }}</p>
            <p class="font-italic">
                <span class="font-weight-bold">{{ $post->user->name }}</span>,
                <span class="text-muted">{{ formatDatetime($post->created_at) }}</span>
            </p>
            <a href="{{ route('post', ['post' => $post->slug]) }}" class="btn btn-primary">{{ __('Devamını oku') }}</a>
        </div>
    </div>
@empty
    {{ __('Üzgünüz, hiçbir içerik bulunmuyor') }}
@endforelse