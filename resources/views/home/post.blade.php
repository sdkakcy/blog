@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3>{{ $post->subject }}</h3>
            <div class="d-flex justify-content-between mb-1">
                <div class="float-left">
                    <span class="font-weight-bold">{!! $post->user->name !!}</span>,
                    <span class="text-muted">{!! formatDatetime($post->created_at) !!} </span>
                </div>
                <div class="float-right">
                    <span class="text-muted">{!! __('Güncelleme: :updated_at', ['updated_at' => formatDatetime($post->updated_at)]) !!} </span>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="card-text">{!! $post->content !!}</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <x-categories :categories="$categories" />
        </div>
    </div>
</div>
@endsection
