@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <div class="d-flex">
            <h4>{{ __('Tüm yazılar') }}</h4>
        </div>
        <div class="d-flex">
            <a type="button" href="{{ route('panel.posts.create') }}" class="btn btn-primary">{{ __('Yeni Ekle') }}</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('ID') }}</th>
                            <th>{{ __('Başlık') }}</th>
                            <th>{{ __('Oluşturan') }}</th>
                            <th>{{ __('Oluşturma') }}</th>
                            <th>{{ __('Güncelleme') }}</th>
                            <th>{{ __('İşlemler') }}</th>
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
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary">Düzenle</button>
                                    <button type="button" class="btn btn-sm btn-danger">Sil</button>
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
