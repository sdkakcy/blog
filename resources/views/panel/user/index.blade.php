@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <div class="d-flex">
            <h4>{{ __('Tüm Kullanıcılar') }}</h4>
        </div>
        <div class="d-flex">
            @can('create post')
                <a type="button" href="{{ route('panel.users.create') }}" class="btn btn-primary">{{ __('Yeni Ekle') }}</a>
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
                            <th>{{ __('Adı') }}</th>
                            <th>{{ __('E-posta') }}</th>
                            <th>{{ __('Oluşturma') }}</th>
                            <th>{{ __('Güncelleme') }}</th>
                            <th class="text-end">{{ __('İşlemler') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->updated_at }}</td>
                                <td class="text-end">
                                    @can('update post')
                                        <a href="{{ route('panel.users.edit', ['user' => $user->id]) }}" type="button" class="btn btn-sm btn-primary">Düzenle</a>
                                    @endcan
                                    @can('delete post')
                                        <button type="button" class="btn btn-sm btn-danger">Sil</button>
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
