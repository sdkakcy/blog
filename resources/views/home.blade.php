@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <h3>{{ __('Son içerikler') }}</h3>
        </div>
        <div class="col-md-8">
            @forelse ($posts as $post)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->subject }}</h5>
                    <p class="card-text">{{ $post->summary }}</p>
                    <a href="#" class="btn btn-primary">{{ __('Devamını oku') }}</a>
                </div>
            </div>
            @empty
                {{ __('Üzgünüz, hiçbir içerik bulunmuyor') }}
            @endforelse
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ __('Kategoriler') }}</h5>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
