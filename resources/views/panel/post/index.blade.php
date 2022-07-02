@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <div class="d-flex">
            <h4>{{ __('Tüm Yazılar') }}</h4>
        </div>
        <div class="d-flex">
            @can('create post')
                <a type="button" href="{{ route('panel.posts.create') }}" class="btn btn-primary">{{ __('Yeni Ekle') }}</a>
            @endcan
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('ID') }}</th>
                            <th>{{ __('Başlık') }}</th>
                            <th>{{ __('Oluşturan') }}</th>
                            <th>{{ __('Oluşturma') }}</th>
                            <th>{{ __('Güncelleme') }}</th>
                            <th class="text-end">{{ __('İşlemler') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->subject }}</td>
                                <td>{{ $post->user->name }}</td>
                                <td>{{ $post->created_at }}</td>
                                <td>{{ $post->updated_at }}</td>
                                <td class="text-end">
                                    @can('update post')
                                        <a href="{{ route('panel.posts.edit', ['post' => $post->id]) }}" type="button" class="btn btn-sm btn-primary">{{ __('Düzenle') }}</a>
                                    @endcan
                                    @can('delete post')
                                        <form class="d-inline-flex" action="{{ route('panel.posts.destroy', $post->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" type="submit">{{ __('Sil') }}</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
