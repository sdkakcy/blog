@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3>{{ $category->name }}</h3>

            <x-posts-list :posts="$posts" />
        </div>
        <div class="col-md-4">
            <x-categories :categories="$categories" />
        </div>
    </div>
</div>
@endsection
